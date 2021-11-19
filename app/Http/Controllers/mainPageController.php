<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class mainPageController extends Controller
{
    public function index(Request $request)
    {

      
        $prods = Product::orderBy('id', 'DESC')->paginate(10, ['*'], 'page', $request->page);

       return view('index',['pageTitle'=>"bshop","products"=>$prods]);
    }
}
