<?php

namespace App\Http\Controllers;

use App\Helpers\MailHelper;
use App\Helpers\ResponseHelper;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class WebManagementController extends Controller
{
    public function home()
    {
        return "welcome but there is nothing for you here";
    }

    public function mailAdmin(Request $request)
    {
        $validate = $this->validateMail($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }
        $title = $request->title ? $request->title : '';
        $sendMail = MailHelper::mailAdmin($title, $request->body, $request->from, $request->phone, $request->name);
        return ResponseHelper::success('Operation successful');
    }


    public function adminNotifications()
    {
        $adminEmail = Config::get('constants.WEBSITE_DETAILS.email');
        $notifications = User::where('email', $adminEmail)->first()->notifications;
        $notifications->markAsRead();
        return ResponseHelper::success('Operation successful', $notifications);
    }

    public function adminLandingPageProducts()
    {
        $limit = 5;
        $products = [];
        $orderCount = Order::count();
        $products['avgSales'] = round(OrderDetail::sum('amount') / $orderCount);
        $products['recentNotifs'] = Auth::user()->notifications;
        $products['recentOrders'] = Order::with('address', 'user')->orderBy('updated_at', 'desc')->limit($limit)->get();
        $products['recentUsers'] = User::orderBy('updated_at', 'desc')->limit($limit)->get();
        $products['recentProducts'] = Product::orderBy('updated_at', 'desc')->limit($limit)->get();
        $products['recentBrands'] = Brand::orderBy('updated_at', 'desc')->limit($limit)->get();
        $products['ordersCount'] = Order::count();
        $products['productsCount'] = Product::count();
        $products['brandCount'] = Brand::count();
        $products['categoryCount'] = Category::count();
        $products['usersCount'] = User::count();
        $products['ordersCount'] = $orderCount;
        return ResponseHelper::success('Operation successful', $products);
    }


    private function validateMail($request)
    {
        return Validator::make($request, [
            'title' => "string",
            'body' => "required|string",
            'from' => "required|email",
            'phone' => "required|string",
            'name' => "required|string",
        ]);
    }
}
