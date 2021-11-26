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

        

        foreach ($targets as $target) {

            $phot = json_decode($target->photos,true);
            $target->$photo = $phot[0]['medium'];
    

        }



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
       # header('Access-Control-Allow-Methods: *');
       # header('Access-Control-Allow-Headers: *');

        $newprod = Product::create([
            'title' => $request['title'], 'price' => $request['price'], 'photos' => $request['photos'],
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
        $photo  = json_decode($product->photos,true);
        $photo = $photo[0]['medium'];
        return view("singleProduct",["pageTitle"=>$product->title,"product"=>$product,"photo"=> $photo]);
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
        //header('Access-Control-Allow-Methods: *');
        //header('Access-Control-Allow-Headers: *');

        $Product->title = $request->title;
        $Product->price = $request->price;
        $Product->caption = $request->caption;
       

        $sgal = [];
        foreach ($request->gal as $gal) {

              if ( strtolower(substr($gal['small'],0,10)) == 'data:image') {

                do {

                    $fname = "photos/".rand(0,99999999).'.jpg';

                } while(file_exists($fname));
             
         

                $ifp = fopen( $fname, 'wb' ); 

                $data = explode( ',', $gal['small'] );
                fwrite( $ifp, base64_decode( $data[ 1 ] ) );
                fclose( $ifp ); 


                $sgal[]=[
                    "big"=>$fname,
                    "medium"=>$fname,
                    "small"=>$fname
                ];
              } else {

                $sgal[]=$gal;
              }

        }

        $Product->photos = json_encode($sgal);

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
