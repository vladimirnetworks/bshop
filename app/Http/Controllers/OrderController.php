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


        $mliteauth = new liteauth();
        $me = $mliteauth->me();

        dd( $me->first()->orders());

        return view('myorders',['pageTitle'=>"سفارشات من","orders"=>[]]);


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
        

        $ret = Order::Create(["data"=>json_encode($request->data),"price"=>369]);
        return ["zz"=> $ret];
       
    }



    public function store2(Request $request)
    {
       


        

       $mliteauth = new liteauth();
      
       $me = $mliteauth->me()->get();

        $ret = Order::Create(["data"=>json_encode([json_decode($request->data)]),"liteauth_id"=>$me[0]['id']]);
   



        $tg = new TG();
        $sendt = $tg->sendTextToGroup("new order -> ".$request->me);
        Notif::Create(["data"=>json_encode( $sendt),"status"=> $sendt['ok']]);

        return ["zz"=> $ret];
       
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
