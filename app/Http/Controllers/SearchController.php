<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {

      
       // $prods = Product::orderBy('id', 'DESC')->paginate(10, ['*'], 'page', $request->page);


        $searchTerms = explode(' ', $request->q);
        $query = Product::query();
        


        $query->where('searchkey','like','%'.$searchTerms[0].'%');
        foreach($searchTerms as $k=>$searchTerm){
          
            if ($k>0) {
             $query->orWhere('searchkey','like','%'.$searchTerms[0].'%');
            }

        }

        dd($query);
        $results = $query->get();


        return  $results;

       /* return ["data"=>

            ["notfound"=>true]

        ];
        */
    }
}
