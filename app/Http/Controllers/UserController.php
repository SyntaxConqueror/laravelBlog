<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public static function create(Request $request) {
        $hashedPassword = Hash::make($request->input('password'));

        $userData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $hashedPassword,
            'role' => $request->get('selectedRole__createForm')
        ];

        User::create($userData);

        return redirect(session()->previousUrl());
    }

    protected static function delete(Request $request) {
        $user = User::find($request->get('selectedUserId__deleteForm'));
        $user->delete();
        return redirect(session()->previousUrl());
    }

    public static function update(Request $request){
        $user = User::find($request->get('selectedUserId__updateForm'));
        try {
            $hashedPassword = Hash::make($request->input('passwordU'));
            $userData = [
                'name' => $request->input('nameU'),
                'email' => $request->input('emailU'),
                'password' => $hashedPassword,
                'role' => $request->get('selectedRole__updateForm')
            ];
            $user->update($userData);
            return redirect(session()->previousUrl());
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getUserById(Request $request){
        return User::find($request->userId);
    }
}
