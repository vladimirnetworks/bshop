<?php

namespace App\Http\Controllers;

use App\Models\liteauth;
use App\Models\Userdata;
use Illuminate\Http\Request;

class UserdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function setuserdata(Request $request)
     {
        $newuserdata = new Userdata();

        $newuserdata->type = $request->data['type'];
        $newuserdata->data = $request->data['data'];

        if (isset($request->data['orderid'])) {
            $newuserdata->order_id = decode_id($request->data['orderid']);
        }

        liteauth::me()->userdatas()->save($newuserdata);

     }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Userdata  $userdata
     * @return \Illuminate\Http\Response
     */
    public function show(Userdata $userdata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Userdata  $userdata
     * @return \Illuminate\Http\Response
     */
    public function edit(Userdata $userdata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Userdata  $userdata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Userdata $userdata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Userdata  $userdata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userdata $userdata)
    {
        //
    }
}
