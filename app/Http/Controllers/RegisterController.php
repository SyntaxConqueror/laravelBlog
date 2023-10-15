<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use \App\Http\Controllers\UserController;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    protected function index(){
        return view('register');
    }

    protected function register(Request $request) {

        $errors = $request->session()->get('errors');

        if ($errors) {
            return redirect()
                ->route('registration.index')
                ->withErrors($errors)
                ->withInput();
        }

        $user = UserController::create($request);

        $user->save();
        return redirect()->route('login.index');
    }

}
