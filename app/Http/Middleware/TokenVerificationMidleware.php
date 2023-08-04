<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerificationMidleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $token=$request->cookie('token');

        if($token === null) {
          return redirect('/userLogin');
        }
        else{
          $result = JWTToken::VerifyToken($token);
          if($result=="unauthorized"){

             return redirect('/userLogin');
              
              return response()->json([
                  'status' => 'failed',
                  'message' => 'unauthorized'
              ],200);
        }
           else{
        $request->headers->set('email',$result->userEmail);
        $request->headers->set('id',$result->userID);

        return $next($request);

      }

       
    }
}
}
