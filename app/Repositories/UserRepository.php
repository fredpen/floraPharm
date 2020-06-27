<?php


namespace App\Repositories;


use App\ForgetPasswordToken;
use App\Interfaces\UserInterface;
use App\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    protected $user;
    protected $address;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function registerUser($request)
    {
        // TODO: Implement registerUser() method.
        $this->user->email = $request->get('email');
        $this->user->first_name = $request->get('first_name');
        $this->user->last_name = $request->get('last_name');
        $this->user->phone_number = $request->get('phone_number');
        $this->user->password = Hash::make($request->get('password'));
        if ($this->user->save()) {
            return 'saved';
        } else {
            return 'not saved';
        }
    }

    public function authUser($request)
    {
        // TODO: Implement authUser() method.
        $user = Auth::user();
        if ($user->status) {
            $tokenResult = $user->createToken('Personal Access Token');


            $token = $tokenResult->accessToken;

            return response()->json([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        }
    }

    public function saveAddress($request)
    {
        // TODO: Implement saveAddress() method.
        $addresses = UserAddress::where('user_id', Auth::id())->get();
        if (count($addresses) > 0) {
            foreach ($addresses as $address) {
                if ($request->default_status && $address->default_status) {
                    $address->default_status = 0;
                    $address->save();
                    return $this->saveUserAddress($request, 'create', null);
                }
            }
        }
            return $this->saveUserAddress($request, 'create', null);
    }

    public function saveUserAddress($request, $type, $id) {


        if ($type === 'create') {
            $this->address = new UserAddress();
        } else {
            $this->address = UserAddress::where('id', $id)->first();
        }
        $this->address->address = $request->address;
        $this->address->city = $request->city;
        $this->address->state = $request->state;
        $this->address->country = $request->country;
        $this->address->post_code = $request->post_code;
        $this->address->default_status = $request->default_status;
        $this->address->user_id = Auth::id();
        if ($this->address->save()) {
            return $this->address;
        }
    }

    public function getAddressById()
    {
        // TODO: Implement getAddressById() method.
        return UserAddress::where('user_id', Auth::id())->get();
    }

    public function getSingleAddressById($request)
    {
        // TODO: Implement getSingleAddressById() method.
        return UserAddress::where('id', $request)->first();
    }

    public function updateUserAddressById($request, $id)
    {
        // TODO: Implement updateUserAddressById() method.
        $userAddresses = UserAddress::where('user_id', Auth::id())->get();
        if (count($userAddresses) > 0) {
            foreach ($userAddresses as $userAddress) {
                if ($request->default_status && $userAddress->default_status) {
                    $userAddress->default_status = 0;
                    $userAddress->save();
                    return $this->saveUserAddress($request, 'update', $id);
                }
            }
        }
        return $this->saveUserAddress($request, 'update', $id);

    }

    public function destroyAddress($request)
    {
        // TODO: Implement destroyAddress() method.
        $userAddress = UserAddress::where('id', $request)->first();
        if (isset($userAddress)) {
            if ($userAddress->delete()) {
                return 'deleted';
            }
        }
    }

    public function userDetail()
    {
        // TODO: Implement userDetail() method.
        return $this->user->with('userAddress')->get();
    }

    public function findUserByEmail($request)
    {
        // TODO: Implement findUserByEmail() method.
        return $this->user->where('email', $request->email)->first();
    }

    public function saveForgotPassword($user, $token)
    {
        // TODO: Implement saveForgotPassword() method.

        $tokenData = new ForgetPasswordToken();
        $tokenData->user_id = $user->id;
        $tokenData->token = $token;
        if ($tokenData->save()){
            return 'saved';
        }

    }

    public function updateUserToken($token) {
       $token =  ForgetPasswordToken::where('token', $token)->first();
       $token->status = 1;
       $token->save();
    }

    public function findUserByToken($request)
    {
        // TODO: Implement findUserByToken() method.
        $token =  ForgetPasswordToken::where('token', $request->token)->where('status', 0)->first();
       if ($token) {
           $user = $token->user()->first();
           $user->password = Hash::make($request->password);
           if ($user->save()) {
               $this->updateUserToken($request->token);
               return 'password changed';
           }
       }

       return 'token not usable';

    }

    public function allUsers()
    {
        $users =  User::where('type', 2);
        return $users->count() ? $users->with(['userAddress', 'order'])->orderby('created_at', 'Desc')->paginate(20) : false;
    }
}

