<?php

namespace App\Http\Controllers;

use App\Helpers\MailHelper;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebManagementController extends Controller
{
    public function mailAdmin(Request $request)
    {
        $validate = $this->validateMail($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }
        $sendMail = MailHelper::mailAdmin($request->title, $request->body, $request->from, $request->phone, $request->name);
        return ResponseHelper::success('Operation successful');
    }

    private function validateMail($request)
    {
        return Validator::make($request, [
            'title' => "required|string",
            'body' => "required|string",
            'from' => "required|email",
            'phone' => "required|string",
            'name' => "required|string",
        ]);
    }
}
