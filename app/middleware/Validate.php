<?php
namespace app\middleware;
use think\facade\Session;



class Validate
{
    public function handle($request, \Closure $next){
        $response = $next($request);

        if (!Session::has('id')) {
    		return redirect('/index.php/Login/login');
    	}

        return $response;
    }
}