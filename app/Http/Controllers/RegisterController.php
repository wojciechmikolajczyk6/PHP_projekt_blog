<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }
    public function store()
    {
        //create user
        request() ->validate([
            '_answer'   => 'required|simple_captcha'

        ]);
        $user_data = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255'
        ]);

//        $user_data['password'] = bcrypt($user_data['password']);


        $user = User::create($user_data);

        session()->flash('user_created', 'Twoje konto zostalo zalozone.');

        auth()->login($user);

        return redirect('/');
    }



}
