<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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

        $targets = Product::orderBy('id', 'DESC')->paginate(10, ['*'], 'page', $request->page);
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
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');

        $newprod = Product::create([
            'title' => $request['title'], 'price' => $request['price'],
        ]);

        return ["data" => $newprod];


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view("singleProduct",["pageTitle"=>$product->title,"product"=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $Product)
    {
        //header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');

        $Product->title = $request->title;
        $Product->price = $request->price;
        $Product->caption = $request->caption;

        return ["data" => $Product->save()];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $Product)
    {
        return ["data" => $Product->delete()];
    }
}
