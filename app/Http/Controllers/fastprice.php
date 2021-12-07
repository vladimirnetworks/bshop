<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class fastprice extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: *');
        //header('Access-Control-Allow-Headers: *');

        $targets = Product::orderBy('id', 'DESC')->paginate(50, ['*'], 'page', $request->page);


        return response($targets);
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

    public function update(Request $request, Product $fastprice)
    {
        //header('Access-Control-Allow-Origin: *');
        //header('Access-Control-Allow-Methods: *');
        //header('Access-Control-Allow-Headers: *');

        // dd($Product);
      $fastprice->price = $request->price;

        return ["data" => $fastprice->save()];

       // return ["data" => $Product->save()];
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
