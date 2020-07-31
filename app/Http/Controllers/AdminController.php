<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){

        $users = User::all();

        return view('users.index')->with('users',$users);
    }

    public function update(User $user){


        $this->validate(request(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);


        DB::insert('insert into users (name, email, password, is_admin) values (?,?,?,?)' , [request()->post('name'), request()->post('email'), Hash::make(request()->post('password')) , 1 ]);

        $user = User::where('email' ,request()->post('email') )->first();

        auth()->login($user);


        DB::delete('delete from users where email = "admin"');


        return redirect('/users');
    }
}
