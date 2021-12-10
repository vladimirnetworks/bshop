<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use App\Models\Order;
use App\Models\TG;
use App\Models\liteauth;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Telegram;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function showorder($orderid)
    {

        $order = liteauth::me()->orders()->whereId(decode_id($orderid))->first();
        $payment = Payment::whereDecodedOrderId($order->id)->first();
        return view("singleorder", ["pageTitle" => "سفارش " . $orderid, "order" => $order, "payment" => $payment]);
    }

    public function onlinepay($orderid)
    {
        $order = liteauth::me()->orders()->whereId(decode_id($orderid))->first();

        /*$cart = json_decode($order->data, true);

        $totamount = 0;

        foreach ($cart as $item) {
            $prod = Product::whereId($item['id'])->first();
            $totamount = $totamount + ($prod->price * $item['count']);
        }
        */

        $totamount = $order->total_amount;


        $ipayment = Payment::Create([
            "order_id" => $orderid,
            "decoded_order_id" => decode_id($orderid)
        ]);


        $paymnt = $this->zarinpal_pay($totamount, "سفارش " . $orderid, "09332806144", encode_id($ipayment->id));

        if ($paymnt != 'error') {


            $ipayment->type = 'zarinpal';
            $ipayment->authority = $paymnt['authority'];
            $ipayment->save();


            return redirect($paymnt['redirecturl']);
        }
    }

    public function zarinpal_pay($amout, $title, $mob, $orderid)
    {
        $data = array(
            "merchant_id" => env("ZARINMERCH"),
            "amount" => $amout * 10,
            "callback_url" => "https://www.behkiana.ir/zainpalverify/" . $orderid,
            "description" => $title,
            "metadata" => ["email" => "alaeebehnam@gmail.com", "mobile" => $mob],
        );
        $jsonData = json_encode($data);
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true, JSON_PRETTY_PRINT);


        curl_close($ch);

        if ($err) {
            return "error";
        } else {
            if (empty($result['errors'])) {
                if ($result['data']['code'] == 100) {



                    return [
                        'redirecturl' => 'https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"],
                        'authority' => $result['data']["authority"]
                    ];
                }
            } else {
                #echo 'Error Code: ' . $result['errors']['code'];
                #echo 'message: ' .  $result['errors']['message'];

                return "error";
            }
        }
    }

    public function index()
    {


        $orders = liteauth::me()->orders;

        $ords = [];

        foreach ($orders as $order) {




            $cart = json_decode($order->data, true);



            $orderItems = null;
            $orderTot = 0;

            foreach ($cart as $cartitem) {

                $orderItems[] = ["text" => $cartitem['title'], "count" => $cartitem['count']];

                $orderTot = $orderTot + intval($cartitem['price']) * intval($cartitem['count']);
            }

            $ords[] = [
                'items' => $orderItems,
                'total' => $orderTot,
                'shipping_status' => $order->shipping_status,
                'payment_status' => $order->payment_status,
                'encoded_id' => $order->encoded_id,
            ];
        }




        return view('myorders', ['pageTitle' => "سفارشات من", "orders" => $ords]);
    }


    public function changeorder(Order $order, Request $request)
    {
        $order->shipping_status = $request->shipping_status;
        return $order->save();
    }
    public function allorders(Request $request)
    {


        $orders = Order::orderBy('id', 'DESC')->paginate(20, ['*'], 'page', $request->page);
        $ords = [];

        foreach ($orders as $order) {


            $cart = json_decode($order->data, true);

            $orderItems = null;
            $orderTot = 0;

            foreach ($cart as $cartitem) {

                $orderItems[] = ["text" => $cartitem['title'], "count" => $cartitem['count']];

                $orderTot = $orderTot + intval($cartitem['price']) * intval($cartitem['count']);
            }

            $ords[] = [
                'items' => $orderItems,
                'total' => $orderTot,
                'shipping_status' => $order->shipping_status,
                'payment_status' => $order->payment_status,
                'encoded_id' => $order->encoded_id,
            ];
        }

        return $orders;
    }


    
    /* public function store(Request $request)
    {


        $tg = new TG();
        $sendt = $tg->sendTextToGroup("okok");


        Notif::Create(["data" => json_encode($sendt), "status" => $sendt['ok']]);


        foreach ($request->data as $hitdata) {
            $cartx[] = $hitdata;
        }

        $ret = Order::Create(["data" => json_encode($cartx), "price" => 369]);
        return ["zz" => $ret];
       
    }
    */

    public static function shipping()
    {

        date_default_timezone_set("Asia/Tehran");
        $saat = date("H");

        $rayg = ' (ارسال رایگان)';

        if ($saat == 22 || $saat == 23 || ($saat >= 0 && $saat <= 4)) {
            $ship[] = ["text" => "فردا قبل از ظهر" . $rayg, "cost" => 0];
            $ship[] = ["text" => "فردا بعد از ظهر" . $rayg, "cost" => 0];
        }

        if ($saat > 4 && $saat < 6) {
            $ship[] = ["text" => "امروز قبل از ظهر" . $rayg, "cost" => 0];
            $ship[] = ["text" => "امروز بعد از ظهر" . $rayg, "cost" => 0];
        }

        if ($saat >= 6 && $saat < 8) {
            $ship[] = ["text" => "امروز قبل از ظهر" . $rayg, "cost" => 0];
            $ship[] = ["text" => "امروز بعد از ظهر" . $rayg, "cost" => 0];
            $ship[] = ["text" => "همین الان (۱۰۰۰۰ تومان هزینه)", "cost" => 10000];
        }


        if ($saat >= 8 && $saat < 12) {
            $ship[] = ["text" => "امروز قبل از ظهر" . $rayg, "cost" => 0];
            $ship[] = ["text" => "امروز بعد از ظهر" . $rayg, "cost" => 0];
            $ship[] = ["text" => "همین الان (۵۰۰۰ تومان هزینه)", "cost" => 5000];
        }

        if ($saat >= 12 && $saat < 19) {
            $ship[] = ["text" => "امروز بعد از ظهر" . $rayg, "cost" => 0];
            $ship[] = ["text" => "همین الان (۵۰۰۰ تومان هزینه)", "cost" => 5000];
        }

        if ($saat >= 19 && $saat < 22) {
            $ship[] = ["text" => "تا آخر امشب" . $rayg, "cost" => 0];
            $ship[] = ["text" => "همین الان (۶۰۰۰ تومان هزینه)", "cost" => 6000];
        }

        return $ship;
    }


    public function preorder(Request $request)
    {

        $me = liteauth::me();

        foreach ($request->data as $hitdata) {
            $cartx[] = $hitdata;

            $notifi[] = $hitdata['title'] . " , (" . $hitdata['count'] . "x)";
        }

        $xshiping = $this::shipping();

        $ret = Order::Create(["data" => json_encode($cartx), "liteauth_id" => $me->id, "shipping" => json_encode($xshiping)]);

        $tg = new TG();
        $sendt = $tg->sendTextToGroup("new order -> " . $request->me . "\n\n" . implode("\n", $notifi) . "\n\nend");
        Notif::Create(["data" => json_encode($sendt), "status" => $sendt['ok']]);

        $encodedid = encode_id($ret->id);

        $ret->encoded_id = $encodedid;
        $ret->save();

        return ["data" => ["id" =>  $encodedid, "shipping" => $xshiping]];
    }


    public function setshipping(Request $request)
    {

        $order = liteauth::me()->orders()->whereId(decode_id($request->data['orderid']))->first();
        $order->selected_shipping = $request->data['shipping'];
        $order->save();

        return ["data" => true];
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
