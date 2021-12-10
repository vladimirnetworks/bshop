<?php

namespace App\Http\Controllers;

use App\Models\monitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class monitorController extends Controller
{
     public function LatestUsers(Request $request)
     {
       
      //$latest = monitor::where("liteauth_id",">","0")->orderBy('liteauth_id', 'DESC')->paginate(20, ['*'], 'page', $request->page);

      $latest = DB::select("SELECT * FROM monitor");

       return  $latest ;

     }
}
