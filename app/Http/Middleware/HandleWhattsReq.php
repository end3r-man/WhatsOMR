<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\CheckController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleWhattsReq
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = CheckController::getToken();
        dd($token);
        if (isset($request->token) && $request->token !== '' && $request->token == $token) {
            return $next($request);
        }
        // return response()->json(['error' => 'Invalid token'], 401);
    }

}
