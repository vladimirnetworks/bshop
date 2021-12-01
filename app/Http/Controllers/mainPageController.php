<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class mainPageController extends Controller
{
    public function index(Request $request)
    {


        $prods = Product::orderBy('id', 'DESC')->paginate(10, ['*'], 'page', $request->page);


        $prods->each(function ($item) {

            $phot = json_decode($item->photos, true);


            if (isset($phot[0])) {
                $item->photo = $phot[0]['medium'];
            }
        });



        return view('index', ['pageTitle' => "بهکیانا - فروشگاه محصولات بهداشتی", "products" => $prods]);
    }


    public function index2(Request $request)
    {


        $prods = Product::orderBy('id', 'DESC')->paginate(10, ['*'], 'page', $request->page);


        $prods->each(function ($item) {

            $phot = json_decode($item->photos, true);


            if (isset($phot[0])) {
                $item->photo = $phot[0]['medium'];
            }


            $item->jsondata = str_replace('','',json_encode([

                "id"=>$item->id,
                "title"=>$item->title,
                "tinytitle"=>$item->tinytitle,
                "price"=>$item->price,
                "caption"=>lize($item->caption),
                "photos"=>$phot,
                

            ]));

        });



        


        return view('index2', ['pageTitle' => "بهکیانا - فروشگاه محصولات بهداشتی", "products" => $prods]);

        

    }


    public function index3(Request $request)
    {


      
      
        $prods = Product::orderBy('id', 'DESC')->paginate(10, ['*'], 'page', $request->page);


        $prods->each(function ($item) {

            $phot = json_decode($item->photos, true);


            if (isset($phot[0])) {
                $item->photo = $phot[0]['medium'];
            }


            $item->jsondata = str_replace('','',json_encode([

                "id"=>$item->id,
                "title"=>$item->title,
                "tinytitle"=>$item->tinytitle,
                "price"=>$item->price,
                "caption"=>lize($item->caption),
                "photos"=>$phot,
                

            ]));

        });



        


        return view('index3', ['pageTitle' => "بهکیانا - فروشگاه محصولات بهداشتی", "products" => $prods]);

        

    }


}
