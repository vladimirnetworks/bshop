<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use App\Models\Order;
use App\Models\TG;
use App\Models\liteauth;
use Illuminate\Http\Request;
use Telegram;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function onlinepayment()
    {
        $data = array(
            "merchant_id" => "14b79a43-cb9b-44eb-b4d0-e8b37343278d",
            "amount" => 99999999,
            "callback_url" => "https://www.behkiana.ir/zainpalverify",
            "description" => "خرید تست",
            "metadata" => ["email" => "info@email.com", "mobile" => "09332806144"],
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
            echo "cURL Error #:" . $err;
        } else {
            if (empty($result['errors'])) {
                if ($result['data']['code'] == 100) {

                 

                  return redirect('https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
                }
            } else {
                echo 'Error Code: ' . $result['errors']['code'];
                echo 'message: ' .  $result['errors']['message'];
            }
        }
    }

    public function index()
    {


        $orders = liteauth::me()->orders;


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
            ];
        }




        return view('myorders', ['pageTitle' => "سفارشات من", "orders" => $ords]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    public static function shipping()
    {

        $ship[] = ["text" => "امروز قبل از ظهر", "cost" => 0];
        $ship[] = ["text" => "امروز بعد از ظهر", "cost" => 0];
        // $ship[] = ["text"=>"همین الان (۴۰۰۰+ تومان هزینه)","cost"=>4000];
        return $ship;
    }


    public function store2(Request $request)
    {





        $me = liteauth::me();



        
        foreach ($request->data as $hitdata) {
            $cartx[] = $hitdata;
        }

        $xshiping = $this::shipping();

        $ret = Order::Create(["data" => json_encode($cartx), "liteauth_id" => $me->id, "shipping" => json_encode($xshiping)]);




        $tg = new TG();
        $sendt = $tg->sendTextToGroup("new order -> " . $request->me);
        Notif::Create(["data" => json_encode($sendt), "status" => $sendt['ok']]);


        return ["data" => ["id" => encode_id($ret->id), "shipping" => $xshiping]];
    }


    public function setshipping($orderid)
    {

     //   $me = liteauth::me();
     // $order = Order::where(["id","=",encode_id($orderid)])->first();
  //dd(decode_id($orderid));

  $xwhere = ["id","=",decode_id($orderid)];
  
    $order = liteauth::me()->orders()->where($xwhere)->get();;
     dd($order);


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
