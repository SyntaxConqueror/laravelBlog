<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class Registration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|max:30|min:5',
            'email' => 'required|email|unique:users',
            'password'=>'required|min:6|max:12',
            'repeated__pwd' => 'required|same:password'
        ]);
        if ($v->fails()) {
            // Flash errors to the session
            $request->session()->flash('errors', $v->errors());
        }

        return $next($request);
    }
}
