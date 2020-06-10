<?php


namespace App\Repositories;

use App\Interfaces\WishListInterface;
use App\Models\WishList;

class WishListRepository implements WishListInterface
{
    protected $wishList;

    public function __construct(WishList $wishList)
    {
        $this->wishList = $wishList;
    }

    public function add($userId, $productId)
    {
       return $this->wishList->firstOrCreate([
           'user_id' => $userId,
            'product_id' => $productId
        ]);
    }

    public function  remove($userId, $productId)
    {
        return $this->wishList->where([
            'user_id' => $userId,
            'product_id' => $productId
        ])->delete();
    }

    public function clear($userId)
    {
        return $this->wishList->where('user_id', $userId)->delete();
    }

    public function all($userId)
    {
        $wishLists = $this->wishList->where('user_id', $userId);
        return $wishLists->count() ? $wishLists->with(['user', 'product'])->paginate(20) : false;
    }
}
