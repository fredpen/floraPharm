<?php


namespace App\Repositories;


use App\Interfaces\OrderInterface;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderRepository implements OrderInterface
{
    protected $order;
    protected $order_detail;
    protected $random_number;
    protected $total_amount;
    protected $save_status = false;
    protected $products = [];
    protected $a;

    public function __construct(Order $order)
    {
        $this->order = $order;
      //  $this->order_detail = $order_detail;
    }


    public function makeOrder($request)
    {
        // TODO: Implement makeOrder() method.
        $this->random_number = 'HC-' . Str::random(10);
        $this->order->order_num = $this->random_number;
        $this->order->promo_code = $request->promoCode;
        $this->order->address_id = $request->addressId;
        $this->order->user_id = Auth::id();
        foreach ($request->orders as $re) {
           $product = Product::where('id', $re['productId'])->first();
            if($product) {
                 $this->checkProductValidity($re, $product);

            }
        }


        if ($this->save_status) {
            $this->order->total_amount = $this->total_amount;
            $this->order->save();
            foreach($this->products as $product) {
                $this->order->orderDetail()->save($product);
            }
            return $this->order;
        } else {
            return 'Error Processing';
        }



    }

    public function checkProductValidity($request, $product) {

        $this->order_detail = new OrderDetail ();

        if ($product->discount_in_whole_number !== 0.00 || $product->discount_in_whole_number) {
              if ( (double) $request['amount'] === (double) $product->discount_in_whole_number) {
                   $this->saveOrder($product, $request);

              }
        } else {
            if ((double) $request['amount'] === (double) $product->price) {
                 $this->saveOrder($product, $request);
            }
        }

    }


    public function saveOrder($product, $request) {

        $this->order_detail->product_id = $request['productId'];
        $this->order_detail->product_name = $product->name;
        $this->order_detail->quantity = $request['quantity'] > 1 ? $request['quantity'] : 1;
        $this->order_detail->amount = $request['amount'];
        $this->order_detail->total_amount = $request['amount'] * $this->order_detail->quantity;
        $this->total_amount = $this->total_amount + $this->order_detail->total_amount;
        $this->save_status = true;
        array_push($this->products, $this->order_detail);
    }

    public function saveReferenceNo($order, $reference)
    {
        // TODO: Implement saveReferenceNo() method.
        $order = $this->order->where('id', $order->id)->first();
        $order->reference_no = $reference['data']['reference'];
        if($order->save()) {
            return 'saved';
        }

    }

    public function verifyTransaction($reference)
    {
        // TODO: Implement verifyTransaction() method.
        $verifyTransaction = $this->order->where('reference_no', $reference['data']['reference'])->first();
        $verifyTransaction->payment_status = 1;
        if ($verifyTransaction->save()) {
            return 'successful';
        }

    }
}