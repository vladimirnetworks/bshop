<?php

namespace App\Http\Controllers;

use App\Models\monitor;
use Illuminate\Http\Request;

class monitorController extends Controller
{
     public function LatestUsers(Request $request)
     {
       
      $latest = monitor::where("liteauth_id",">","0")->orderBy('liteauth_id', 'DESC')->paginate(20, ['*'], 'page', $request->page);

      dd($latest);

     }
}
