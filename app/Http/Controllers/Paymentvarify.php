<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class Paymentvarify extends Controller
{
    public function zarinpal($paymentid): void
    {



        $payment = Payment::whereId(decode_id($paymentid))->first();

        $ordi =  Order::whereId(decode_id($payment->order_id))->first();

        

        $Authority = $payment->authority; //$_GET['Authority'];
        $amount = $ordi->total_amount;

       
        $data = array("merchant_id" => "14b79a43-cb9b-44eb-b4d0-e8b37343278d", "authority" => $Authority, "amount" => $amount);
        
 
        print_r($data);

        $jsonData = json_encode($data);
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);

        print_r($result );exit;

        if ($result['data']['code'] == 100) {
            echo 'Transation success. RefID:' . $result['data']['ref_id'];
        } else {
            echo 'code: ' . $result['errors']['code'];
            echo 'message: ' .  $result['errors']['message'];
        }
    }
}
