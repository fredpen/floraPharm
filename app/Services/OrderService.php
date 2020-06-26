<?php


namespace App\Services;


use App\Interfaces\OrderInterface;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    protected $orderInterface;

    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    }

    public function initializePayment($request) {

        $order = $this->orderInterface->makeOrder($request);

        if($order === 'Error Processing') {
            return $order;
        }

        if (isset($order)) {
            $curl = curl_init();
            $email = Auth::user()->email;
            $amount = $order->total_amount * 100;


            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode([
                    'amount'=>$amount,
                    'email'=>$email,
                    'order_num' => '455tjjt'
                ]),
                CURLOPT_HTTPHEADER => [
                    "authorization: Bearer sk_test_f61579dffc5a203331f69241a5adbf1ee6d4ec2d", //replace this with your own test key
                    "content-type: application/json",
                    "cache-control: no-cache"
                ],
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            if($err){
                // there was an error contacting the Paystack API
                die('Curl returned error: ' . $err);
            }

            $tranx = json_decode($response, true);

            if(!$tranx['status']){
                // there was an error from the API
                print_r('API returned error: ' . $tranx['message']);
            }

           $data = $this->orderInterface->saveReferenceNo($order, $tranx);
            if ($data === 'saved') {
                return $tranx;
            }

        }
    }


    public function verifyTransaction($request) {
        $curl = curl_init();
        //$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
        $reference = $request->reference;

        if(!$reference){
            die('No reference supplied');
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer sk_test_f61579dffc5a203331f69241a5adbf1ee6d4ec2d",
                "cache-control: no-cache"
            ],
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){
            die('Curl returned error: ' . $err);
        }

        $tranx = json_decode($response, true);


        if(!$tranx['status']){
            return $tranx['message'];
        }




        if('success' == $tranx['data']['status']){
            return $this->orderInterface->verifyTransaction($tranx);
        }
    }

    public function getOrderByUserId(){
        return $this->orderInterface->getOrder();
    }

     public function getSingleOrder($orderId)
    {
         return $this->orderInterface->getSingleOrder($orderId);
    }

    public function allOrder(){
        return $this->orderInterface->allOrdersForAdmin();
    }
}
