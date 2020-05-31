<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */


    use SendsPasswordResetEmails;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function forgotPassword(Request $request){
        $password = $this->userService->forgotUserPassword($request);
        if (is_array($password)) {
            return ResponseHelper::responseDisplay(400, 'Bad request', $password);
        }
        return ResponseHelper::responseDisplay(200, 'Mail sent', $password);
    }

    public function changePassword(Request $request) {
        $password = $this->userService->changeUserPassword($request);

        if (is_array($password)) {
            return ResponseHelper::responseDisplay(400, 'Bad request', $password);
        } else if ($password === 'token not usable') {
            return ResponseHelper::responseDisplay(404, 'Token not found', $password);

        }
          return ResponseHelper::responseDisplay(200, 'Password changed', $password);

    }
}
