<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    protected $orderService;


    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }


    public function makePayment(Request $request) {
        $transaction = $this->orderService->initializePayment($request);
        if ($transaction) {

            if ($transaction === 'Error Processing') {
                return ResponseHelper::responseDisplay(400, 'Operation failed', $transaction);

            }else if ($transaction['status']) {

              return ResponseHelper::responseDisplay(200, 'Operation successful', $transaction);
            }
            return ResponseHelper::responseDisplay(400, 'Operation failed', $transaction);

        }
        return ResponseHelper::responseDisplay(400, 'Operation failed', $transaction);

    }

    public function verifyTransaction(Request $request) {
        $verifyTransaction = $this->orderService->verifyTransaction($request);
        if ($verifyTransaction === 'successful') {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $verifyTransaction);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed', $verifyTransaction);

    }


    public function getUserOrder(){
        $orders = $this->orderService->getOrderByUserId();

        if ($orders) {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $orders);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed', $orders);

    }

    public function allOrder(){
        $orders = $this->orderService->allOrder();
        if ($orders) {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $orders);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed', $orders);
    }

}
