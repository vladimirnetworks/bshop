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
        });



        return view('index2', ['pageTitle' => "بهکیانا - فروشگاه محصولات بهداشتی", "products" => $prods]);
    }

}
