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
           
            $phot = json_decode($item->photos,true);

           
          //  $item->photo = $phot[0]['medium'];

            $item->photo = 'test';


        });





       return view('index',['pageTitle'=>"بهکیانا - فروشگاه محصولات بهداشتی","products"=>$prods]);
    }
}
