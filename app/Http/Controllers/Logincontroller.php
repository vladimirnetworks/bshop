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

        if ($request->user == 'enamad' && $request->pass == '1qaz!QAZ') {

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
