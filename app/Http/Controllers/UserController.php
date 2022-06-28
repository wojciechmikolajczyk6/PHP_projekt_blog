<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    public function update (User $editUser)
    {
        $attributes = request()->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',

        ]);

        $editUser->update($attributes);

        return redirect('/admin')->with('success', 'Dane uzytkownika zostaly zmienione');

    }

    public function delete (User $editUser)
    {

        $editUser->delete();

        return redirect('/admin')->with('success', 'Uzytkownik zostal usuniety');
    }
}

