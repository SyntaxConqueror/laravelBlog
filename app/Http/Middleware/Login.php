<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'password'=>'required',

        ]);
        if ($v->fails()) {
            // Flash errors to the session
            $request->session()->flash('errors', $v->errors());
        }

        return $next($request);
    }
}
