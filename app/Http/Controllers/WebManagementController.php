<?php

namespace App\Http\Controllers;

use App\Helpers\MailHelper;
use App\Helpers\ResponseHelper;
use App\Models\Order;
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


    public function adminLandingPageProducts() {
        return $recentOrders = Order::with('address', 'user')->orderBy('updated_at', 'desc')->limit(10)->get();
        $products = [];
        // $products['bestSeller'] = $this->fetchWithLimit('best_seller');
        $products['new'] = $this->fetchWithLimit('new');
        $products['landingPage'] = $this->fetchWithLimit('landing_page');
        $products['hot'] = $this->fetchWithLimit('hot');
        $products['featured'] = $this->fetchWithLimit('featured');
        return $products;
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
