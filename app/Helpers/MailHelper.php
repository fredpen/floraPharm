<?php

namespace App\Helpers;

use App\Mail\OrderShipped;
use App\Models\Order;
use App\Notifications\MailToAdmin;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class MailHelper
{
    public static function mailAdmin($title, $body, $from, $phone, $name)
    {
        $adminEmail = Config::get('constants.WEBSITE_DETAILS.email');
        $admin = User::where('email', $adminEmail)->first();
        return $admin->notify(new MailToAdmin($title, $body, $from, $phone, $name));
    }

    public static function orderNotification($orderId)
    {
        $order = Order::where('id', $orderId)->with('user')->first();
        $adminEmail = Config::get('constants.WEBSITE_DETAILS.email');
        $from = $order->user ? $order->user->email : $order->user_detail->email;

        Mail::to($from)
            ->bcc($adminEmail)
            ->send(new OrderShipped($order));
    }
}
