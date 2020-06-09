<?php


namespace App\Services;


use App\Interfaces\UserInterface;
use App\Mail\ForgetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserService
{
    protected $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function create($request){
        $validateData = Validator::make($request->all(), [
            'email' => 'required|email|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6|same:password',
        ]);

        if ($validateData->fails()) {
            return $validateData->messages()->all();
        }
       return $this->userInterface->registerUser($request);
    }

    public function auth($request) {

        $validateData = Validator::make($request->all(), [
            'email' => 'required|email|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validateData->fails()) {
            return $validateData->messages()->all();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            return $this->userInterface->authUser($request);
        } else {
            return 'Unauthorized';
        }


    }

    public function saveAddress($request){
        $validateData = $this->validateRequestData($request);

        if ($validateData->fails()) {
            return $validateData->messages()->all();
        }
        return $this->userInterface->saveAddress($request);
    }

    public function getAddress(){
        return $this->userInterface->getAddressById();
    }

    public function validateRequestData($request) {
        return Validator::make($request->all(), [
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'default_status' => 'integer'
        ]);
    }

    public function getAddressById($request){
        return $this->userInterface->getSingleAddressById($request);
    }

    public function updateAddress($request, $userAddress){

        $validateData = $this->validateRequestData($request);

        if ($validateData->fails()) {
            return $validateData->messages()->all();
        }

        return  $this->userInterface->updateUserAddressById($request, $userAddress);
    }

    public function deleteAddress($request){
        return $this->userInterface->destroyAddress($request);
    }

    public function getUserDetail(){
        return $this->userInterface->userDetail();
    }

    public function forgotUserPassword($request){
        $validateData = Validator::make($request->all(), [
            'email' => 'required|email|string',
        ]);

        if ($validateData->fails()) {
            return $validateData->messages()->all();
        }

        $user = $this->userInterface->findUserByEmail($request);

        if($user) {
            $random = Str::random(80);
            $res = $this->userInterface->saveForgotPassword($user, $random);
            if ($res === 'saved') {
                Mail::to($user->email)->send(new ForgetPassword($user, $random));
                return 'mail sent';
            }
        }
        return 'false';
    }

    public function changeUserPassword($request) {
        $validateData = Validator::make($request->all(), [
            'email' => 'required|email|string',
            'token' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6|same:password',
        ]);

        if ($validateData->fails()) {
            return $validateData->messages()->all();
        }

        return $this->userInterface->findUserByToken($request);


    }
}
