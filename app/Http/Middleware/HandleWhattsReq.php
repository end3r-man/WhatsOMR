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
    public function handle(Request $request, Closure $next)
    {
        $token = $this->getToken();

        if ($request->has('token') && $request->input('token') === $token) {
            return $next($request);
        }

        return response()->json(['error' => 'Invalid token'], 401);
    }

    /**
     * Get the token.
     *
     * @return string
     */
    protected function getToken()
    {
        
        return "$2y$12$7sqhPngJx97sQkNKv7YyMe6RqOJuIX12TcsAncG2iCICe3Xx.NkNO";
    }

}
