<?php

namespace App\Helpers;

use App\Mail\OrderShipped;
use App\Models\Order;
use App\Notifications\MailToAdmin;
use App\Notifications\OrderPlaced;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class MailHelper
{
    private static function admin()
    {
        $adminEmail = Config::get('constants.WEBSITE_DETAILS.email');
        return User::where('email', $adminEmail)->first();
    }

    public static function mailAdmin($title, $body, $customerEmail, $phone, $name)
    {
        return Self::admin()->notify(new MailToAdmin($title, $body, $customerEmail, $phone, $name));
    }

    public static function orderNotification($order)
    {
        $customerEmail = $order->user ? $order->user['email'] : $order->user_detail['email'];
        Mail::to($customerEmail)->send(new OrderShipped($order));
        return Self::admin()->notify(new OrderPlaced($order));
    }
}
