<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart =  $cart;
    }

    public function update(Request $request)
    {
        $validate = $this->validateRequest($request);
        if ($validate->fails()) {
            return ResponseHelper::badRequest($validate->errors()->first());
        }

        $update = $this->actionOnCart($request->quantity, $request->product_id);
        return $update ? ResponseHelper::success('Operation successful') : ResponseHelper::serverError('Could not update cart');
    }

    public function clear()
    {
        $clear = $this->cart->where('user_id', Auth::id())->delete();
        return $clear ? ResponseHelper::success('Operation successful') : ResponseHelper::serverError('Could not clear cart');
    }

    public function fetch()
    {
        $cart = $this->cart->where('user_id', Auth::id())->with('product')->get();
        return $cart->count() ? ResponseHelper::success('Operation successful', $cart) : ResponseHelper::serverError('Cart is empty');
    }

    public function all()
    {
        $cart = $this->cart->with('product', 'user')->get();
        return $cart->count() ? ResponseHelper::success('Operation successful', $cart) : ResponseHelper::serverError('Cart is empty');
    }

    private function actionOnCart($quantity, $productId)
    {
        if ($quantity == 0) {
            return $this->cart->where(['user_id' => Auth::id(), 'product_id' => $productId])->delete();
        }

        return $this->cart->updateOrCreate(
            [ 'user_id' => Auth::id(), 'product_id' => $productId ],
            [ 'quantity' => $quantity ]
        );
    }

    private function validateRequest($request)
    {
        return Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'quantity' => 'required|integer'
        ]);
    }

}
