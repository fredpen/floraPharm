<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class OrderShipped extends Mailable
{
    use  SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = Config::get('constants.url');
        $floraxAddress = Config::get('constants.WEBSITE_DETAILS.address_top') . Config::get('constants.WEBSITE_DETAILS.adress_down');
        $clientAddress = $this->order->address ? $this->order->address->address . ', ' . $this->order->address->city : $this->order->user_detail->address . $this->order->user_detail->city;
        $orderNum = $this->order['reference_no'];
        return $this->view('emails.orders.shipped')
            ->with([
                'orderNum' => $orderNum,


                'url' => "$url/orders/$orderNum/order-details",
                'deliveryLocation' => $this->order->deliveryLocation,
                'loggedInUser' => $this->order->user_id,
                'email' => $this->order->user ? $this->order->user['email'] : $this->order->user_detail['email'],
                'phone' => $this->order->user ? $this->order->user['phone_number'] : $this->order->user_detail['phone_number'],
                'name' => $this->order->user ? $this->order->user['first_name'] . " " .  $this->order->user['last_name'] : $this->order->user_detail['name'],
                'address' => $this->order->delivery_type == 1 ? $clientAddress : $floraxAddress

            ]);
    }
}
