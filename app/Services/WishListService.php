<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Interfaces\WishListInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class WishListService
{
    protected $wishListInterface;

    public function __construct(WishListInterface $wishListInterface)
    {
        $this->wishListInterface = $wishListInterface;
    }

    public function add($request)
    {
        $validate = $this->validateCreateRequest($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }

        $wishList = $this->wishListInterface->add(Auth::id(), $request->product_id);
        return $wishList ? ResponseHelper::reply(true, $wishList) : ResponseHelper::reply(false, "could not execute request");
    }

    public function remove($productId)
    {
        $wishList = $this->wishListInterface->remove(Auth::id(), $productId);
        return $wishList ? ResponseHelper::reply(true, $wishList) : ResponseHelper::reply(false, "could not execute request - invalid brand ID");
    }

    public function clear()
    {
        $wishList = $this->wishListInterface->clear(Auth::id());
        return $wishList ? ResponseHelper::reply(true, $wishList) : ResponseHelper::reply(false, "could not execute request");
    }

    public function all()
    {
        $wishList = $this->wishListInterface->all(Auth::id());
        return $wishList ? ResponseHelper::reply(true, $wishList) : ResponseHelper::reply(false, "could not execute request");
    }

    private function validateCreateRequest($request)
    {
        return Validator::make($request, [
            'product_id' => "required|integer|exists:product,id"
        ]);
    }
}
