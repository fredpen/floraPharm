<?php


namespace App\Interfaces;


interface OrderInterface
{
    public function makeOrder($request);

    public function saveReferenceNo($order, $reference);

    public function verifyTransaction($reference);

    public function getOrder();

    public function allOrdersForAdmin();

     public function getSingleOrder($orderId);

}
