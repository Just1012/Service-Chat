<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Traits\HelperApi;
use App\Models\User;



class checkUser
{
        use HelperApi;


    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user=User::where('id','=',auth()->id())->first();
        if($user){
        return $next($request);
            
        }else{
                   return $this->onError(401, 'Token is invalid');

        }

    }
}
