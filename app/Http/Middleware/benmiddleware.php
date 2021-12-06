<?php

namespace App\Http\Middleware;

use App\Models\monitor;
use Closure;
use Illuminate\Http\Request;

class benmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


        

        monitor::create([
            "url"=>$_SERVER['REQUEST_URI'],
            "useragent"=>$_SERVER['HTTP_USER_AGENT'],
            "cookie"=>(isset($_COOKIE) ? json_encode($_COOKIE) : null),
            "get_param"=>(isset($_GET) ? json_encode($_GET) : null),
            "post_param"=>(isset($_POST) ? json_encode($_POST) : null),
            "phpinput"=>((file_get_contents('php://input') !=null) ? file_get_contents('php //input') : null),
            "referer"=>(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null),
            "ip"=>$_SERVER['REMOTE_ADDR']
        ]);
        return $next($request);
    }
}
