<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Logincontroller extends Controller
{
    public function login()
    {
        return view("login",["pageTitle"=>"ورود کاربران"]);
    }


    public function login2(Request $request)
    {
        return view("login",["pageTitle"=>"ورود کاربران"]);
    }
    public function login2x(Request $request)
    {

        if ($request->user == 'ben' && $request->pass == '1') {

            setcookie(
                "xlogin",
               "auth",
                time() + (10 * 365 * 24 * 60 * 60)
              ); 

              return redirect("/");
    
        } else {

            return view("login",["pageTitle"=>"ورود کاربران","error"=>true]);

        }
        
    }

}
