<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        //AJAX
        $mail_check = $request->input('mail_check');
        $query = User::all();
        if(!is_null($mail_check)) {

            $query = User::where('email','like', "$mail_check")->get();

            return response()->json([
                'data' => $query
            ]);
        }

        else {
            return view('register.create');
        }
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


            $user = User::create($user_data);

            session()->flash('user_created', 'Twoje konto zostalo zalozone.');

            auth()->login($user);

            return redirect('/');
        }




}
