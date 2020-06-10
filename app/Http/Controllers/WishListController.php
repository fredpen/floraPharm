<?php

namespace App\Http\Controllers;

use App\Services\WishListService;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;

class WishListController extends Controller
{
    protected $wishListService;

    public function __construct(WishListService $wishListService )
    {
        $this->wishListService = $wishListService;
    }

    public function add(Request $request)
    {
        $wishList = $this->wishListService->add($request);
        return $wishList ? ResponseHelper::success(true, $wishList['message']) : ResponseHelper::badRequest(false, "could not execute request");
    }

    public function remove($productId)
    {
        $wishList = $this->wishListService->remove($productId);
        return $wishList ? ResponseHelper::success(true, []) : ResponseHelper::badRequest(false, "could not execute request");
    }

    public function clear()
    {
        $wishList = $this->wishListService->clear();
        return $wishList ? ResponseHelper::success(true, []) : ResponseHelper::badRequest(false, "could not execute request");
    }

    public function all()
    {
        $wishList = $this->wishListService->all();
        return $wishList ? ResponseHelper::success(true, $wishList['message']) : ResponseHelper::badRequest(false, "could not execute request");
    }
}
