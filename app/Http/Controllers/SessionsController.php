<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{

    public function start()
    {
        return view('login.start');
    }

    public function store()
    {
        $user_data = request()->validate([
            'username' => 'required|max:255|min:3|exists:users,username',
            'password' => 'required|max:255'
        ]);
        //auth OK

        if(auth()->attempt($user_data)) {
            return redirect ('/')->with('user_loggedOut', 'Zalogowany');

        }
        //auth KO
        return back()->withErrors(['username' => 'Wprowadzono złe dane.']);


    }


    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('user_loggedOut', 'Zostales pomyslnie wylogowany z konta.');
    }
}
