<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public static function create(Request $request) {
        $hashedPassword = Hash::make($request->get('password'));

        $user = new User();

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $hashedPassword;
        $user->role = "User";

        return $user;
    }

    protected static function delete($id) {
        $user = User::query()->find($id);
        return ($user != null) ? $user->delete() : false;
    }

    public static function update(array $newUser, $id){
        $user = User::query()->find($id);
        try {
            return $user->update($newUser);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
