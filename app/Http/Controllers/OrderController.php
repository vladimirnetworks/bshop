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
    public function index()
    {


        $orders = liteauth::me()->orders;


        foreach ($orders as $order) {

          


            $cart = json_decode($order->data,true);

          

            $orderItems = null;
            $orderTot = 0;
         
            foreach ($cart as $cartitem) {

              $orderItems[] = ["text"=>$cartitem['title'],"count"=>$cartitem['count']];
            
                $orderTot = $orderTot+intval($cartitem['price'])*intval($cartitem['count']);
            }

            $ords[] = [
                'items'=>$orderItems,
                'total'=>$orderTot,
                'shipping_status'=>$order->shipping_status,
                'payment_status'=>$order->payment_status,
            ];
        }
    
    
       

        return view('myorders',['pageTitle'=>"سفارشات من","orders"=>$ords]);


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


        Notif::Create(["data"=>json_encode( $sendt),"status"=> $sendt['ok']]);
        

        foreach ($request->data as $hitdata) {
          $cartx[] = $hitdata;
        }

        $ret = Order::Create(["data"=>json_encode($cartx),"price"=>369]);
        return ["zz"=> $ret];
       
    }



    public function store2(Request $request)
    {
       


        

        $me = liteauth::me();

        foreach (json_decode($request->data,true) as $hitdata) {
            $cartx[] = $hitdata;
          }

        $ret = Order::Create(["data"=>json_encode($cartx),"liteauth_id"=>$me->id]);
   



        $tg = new TG();
        $sendt = $tg->sendTextToGroup("new order -> ".$request->me);
        Notif::Create(["data"=>json_encode( $sendt),"status"=> $sendt['ok']]);

        return ["data"=> $ret->id];
       
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
