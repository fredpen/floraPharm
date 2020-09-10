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
        $orderNum = $this->order['reference_no'];
        $orderDetailsUrl = "$url/orders/$orderNum/order-details";

        $name = $this->order->user ? $this->order->user['first_name'] . " " .  $this->order->user['last_name'] : $this->order->user_detail['name'];

        return $this->markdown('emails.orders.shipped')
            ->with([
                'name' => $name,
                'url' => $orderDetailsUrl,
            ]);
    }
}
