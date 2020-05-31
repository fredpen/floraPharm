<?php


namespace App\Interfaces;


interface WishListInterface
{
   public function add($userId, $productId);

   public function remove($userId, $productId);

   public function clear($userId);

   public function all($userId);

}
