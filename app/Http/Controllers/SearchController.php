<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {

      
        $prods = Product::orderBy('id', 'DESC')->paginate(10, ['*'], 'page', $request->page);



        return  $prods;

       /* return ["data"=>

            ["notfound"=>true]

        ];
        */
    }
}
