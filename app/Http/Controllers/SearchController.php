<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
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


   


        return  $prods;

       /* return ["data"=>

            ["notfound"=>true]

        ];
        */
    }
}
