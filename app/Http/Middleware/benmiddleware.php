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
            "cookie"=>json_encode($_COOKIE),
            "get_param"=>json_encode($_GET),
            "post_param"=>json_encode($_POST),
            "referer"=>$_SERVER['HTTP_REFERER'],
            "ip"=>$_SERVER['REMOTE_ADDR']
        ]);
        return $next($request);
    }
}
