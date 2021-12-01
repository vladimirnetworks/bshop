<?php

namespace App\Http\Middleware;

use App\Models\liteauth;
use Closure;
use Illuminate\Http\Request;

class tokin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     public function makeme()
     {
        $hash = md5(str_shuffle("abcdefghijklmnopqrstuvwxyz123456789!@#$%^&*"));
        $tokin =  liteauth::create(['hash'=>$hash]);  

        $id =  base_convert($tokin->id,10,33);
       


        setcookie(
            "x_address",
            $hash,
            time() + (10 * 365 * 24 * 60 * 60)
          ); 

          setcookie(
            "base_address",
            $id ,
            time() + (10 * 365 * 24 * 60 * 60)
          );
     }

    public function handle(Request $request, Closure $next)
    {

        if (!isset($_COOKIE['x_address']) || !isset($_COOKIE['base_address'])) {
              $this->makeme();              
        } else {
            
            $id =  base_convert($_COOKIE['base_address'],33,10);

          
            $whoiam = liteauth::where([["id",'=',$id],['hash','=',$_COOKIE['x_address']]]);

            if (!isset($whoiam->get()[0]['id'])) {
                 $this->makeme();
            } 

        }

        return $next($request);
    }
}
