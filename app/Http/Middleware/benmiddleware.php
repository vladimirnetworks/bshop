<?php

namespace App\Http\Middleware;

use App\Models\monitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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



if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == 'https://gadmin.behkiana.ir/') {

} else {

        monitor::create([
            "url" => $_SERVER['REQUEST_URI'],
            "useragent" => $_SERVER['HTTP_USER_AGENT'],
            "cookie" => (isset($_COOKIE) ? json_encode($_COOKIE) : null),
            "get_param" => (isset($_GET) ? json_encode($_GET) : null),
            "post_param" => (isset($_POST) ? json_encode($_POST) : null),
            "phpinput" => file_get_contents('php://input'),
            "referer" => (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null),
            "ip" => real_ip()
        ]);
    }
        return $next($request);
    }


    public function terminate($request, $response)
    {


        if (preg_match("!500 Internal Server Error!", $response) || preg_match("!404 Not Found!", $response)) {



            monitor::create([
                "url" => $_SERVER['REQUEST_URI'],
                "useragent" => $_SERVER['HTTP_USER_AGENT'],
                "cookie" => (isset($_COOKIE) ? json_encode($_COOKIE) : null),
                "get_param" => (isset($_GET) ? json_encode($_GET) : null),
                "post_param" => (isset($_POST) ? json_encode($_POST) : null),
                "phpinput" => file_get_contents('php://input'),
                "referer" => (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null),
                "ip" => real_ip(),
                "terminate_response" => $response."\n\n".json_encode($_SERVER)
            ]);
        }
    }
}
