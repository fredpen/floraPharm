<?php


namespace App\Repositories;


use App\Interfaces\OrderInterface;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
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
    protected $shippingFee;

    public function __construct(Order $order)
    {
        $this->order = $order;
      //  $this->order_detail = $order_detail;
    }


    public function showWithRef($ref)
    {
        $order = $this->order->where('reference_no', $ref)->first();
        if (!$order) {
           return false;
        }
        return $order->user_id ? $this->order->where('reference_no', $ref)->with(['user', 'orderDetail', "address", "deliveryLocation"])->first() : $this->order->where('reference_no', $ref)->with(['user', 'orderDetail', "deliveryLocation"])->first();
    }


    public function makeOrder($request)
    {
        // TODO: Implement makeOrder() method.
        $this->random_number = 'HC-' . Str::random(10);
        $this->order->order_num = $this->random_number;
        $this->order->promo_code = $request->promoCode;
        $this->order->address_id = $request->addressId;
        $this->order->delivery_type = $request->delivery_type;
        $this->order->user_detail = $request->user_detail;
        $this->order->delivery_location_id = $request->delivery_location_id;
        $this->order->user_id = Auth::id();
        foreach ($request->orders as $re) {
           $product = Product::where('id', $re['productId'])->first();
            if($product) {
                 $this->checkProductValidity($re, $product);

            }
        }

        if ($this->order->deliveryLocation) {
            $this->shippingFee = $this->order->deliveryLocation->price;
        } else {
            $this->shippingFee = 0;
        }


        if ($this->save_status) {
            $this->order->total_amount = $this->total_amount + $this->shippingFee;
            $this->order->save();
            foreach($this->products as $product) {
                $this->order->orderDetail()->save($product);
            }
            return $this->order;
        } else {
            return 'Error Processing (product/amount may not exist)';
        }



    }

    public function checkProductValidity($request, $product) {

        $this->order_detail = new OrderDetail ();

        if ($product->discount_price !== 0.00 || $product->discount_price) {
              if ( (double) $request['amount'] === (double) $product->discount_price) {
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

    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return $this->order->where('user_id', Auth::id())->paginate(50);
    }

    public function allOrdersForAdmin()
    {
        // TODO: Implement allOrdersForAdmin() method.
        return $this->order->with('address', 'user')->paginate(30);
    }

     public function getSingleOrder($orderId)
    {
        return $this->order->with('orderDetail.product', 'address', 'user', 'deliveryLocation')->where('id', $orderId)->first();
    }


    public function searchOrder($request)
    {
        // TODO: Implement searchOrder() method.

        return $this->order->whereHas('orderDetail', function (Builder $query) use ($request) {
             $query->where('product_name', 'like', '%'.$request->value.'%');
        })->with('orderDetail')->orWhere('order_num', 'LIKE','%'.$request->value.'%')->orWhere('reference_no', 'LIKE','%'.$request->value.'%')->get();
    }
}
