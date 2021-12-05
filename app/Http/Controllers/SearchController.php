<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {


        // $prods = Product::orderBy('id', 'DESC')->paginate(10, ['*'], 'page', $request->page);


        $searchTerms = explode(' ', arabicToPersian($request->q));
        $query = Product::query();


        foreach ($searchTerms as $k => $searchTerm) {
              $whre[] = ['searchkey', 'like', '%' . $searchTerm . '%'];
        }

        $query->where($whre);

       /* $query->where('searchkey', 'like', '%' . $searchTerms[0] . '%');
        foreach ($searchTerms as $k => $searchTerm) {

            if ($k > 0) {
                $query->where('searchkey', 'like', '%' . $searchTerms[0] . '%');
            }
        }
       */



        $results = $query->get();



        if (count($results)) {

            return [
                "data" =>$results,
                "q" =>$whre

            ];
        } else {

            return [
                "data" =>

                ["notfound" => true]

            ];
        }
    }
}
