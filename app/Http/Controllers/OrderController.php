<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    protected $orderService;


    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function makePayment(Request $request)
    {
           $transaction = $this->orderService->initializePayment($request);
        if ($transaction) {

            if ($transaction === 'Error Processing (product/amount may not exist)') {
                return ResponseHelper::responseDisplay(400, 'Operation failed', $transaction);
            } else if ($transaction['status']) {

                return ResponseHelper::responseDisplay(200, 'Operation successful', $transaction['data']);
            } else if ($transaction['mobile']) {
                return ResponseHelper::responseDisplay(200, 'Operation successful', $transaction);
            }
            return ResponseHelper::responseDisplay(400, 'Operation failed', $transaction);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed', $transaction);
    }

    public function saveTransactionRef(Request $request) {
        $order = $this->orderService->saveUserOrderTransactionRef($request, null);
        if ($order) {
            return ResponseHelper::responseDisplay(200, 'operation successful', $order);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed');
    }

    public function saveTransactionRefForAuthUser(Request $request) {
        $order = $this->orderService->saveUserOrderTransactionRef($request, Auth::id());
        if ($order) {
            return ResponseHelper::responseDisplay(200, 'operation successful', $order);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed');
    }

    public function verifyTransaction(Request $request)
    {
        $verifyTransaction = $this->orderService->verifyTransaction($request);
        if ($verifyTransaction === 'successful') {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $verifyTransaction);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed', $verifyTransaction);
    }


    public function getUserOrder()
    {
        $orders = $this->orderService->getOrderByUserId();

        if ($orders) {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $orders);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed', $orders);
    }

    public function getSingleOrder($orderId)
    {
        $orders = $this->orderService->getSingleOrder($orderId);

        if ($orders === 'Unauthorized') {
            return ResponseHelper::responseDisplay(400, 'You are not authorized to view this resource', $orders);
        } else if ($orders === 'Not found') {
            return ResponseHelper::responseDisplay(404, 'Order id not found', $orders);
        }
        return ResponseHelper::responseDisplay(200, 'Operation successful', $orders);
    }


     public function showWithRef($ref)
    {
        $orders = $this->orderService->showWithRef($ref);
       if ($orders) {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $orders);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed', $orders);
    }

    public function allOrder()
    {
        $orders = $this->orderService->allOrder();
        if ($orders) {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $orders);
        }
        return ResponseHelper::responseDisplay(400, 'Operation failed', $orders);
    }

    public function searchOrder(Request $request)
    {
        $orders  = $this->orderService->searchForOrder($request);
        if (count($orders) > 0) {
            return ResponseHelper::responseDisplay(200, 'Operation successful', $orders);
        }
        return ResponseHelper::responseDisplay(200, 'Order Not Found', $orders);

    }
}
