<?php

namespace App\Http\Controllers;

use App\Models\monitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class monitorController extends Controller
{
     public function LatestUsers(Request $request)
     {
       
      $latest = monitor::where("liteauth_id",">","0")->groupBy("liteauth_id")->orderBy('liteauth_id', 'DESC')->paginate(20, ['*'], 'page', $request->page);

     // $latest = DB::select("SELECT useragent FROM monitor where `liteauth_id` > 0 GROUP BY `liteauth_id` ORDER BY `liteauth_id` DESC limit 50");
      return  $latest ;


     }
}
