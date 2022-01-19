<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // validate the request
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);

        // attempt to authenticate and log in the user
        // based on the provided credentials
        if (!auth()->attempt($attributes)) {
            // auth failed:

            // Solution 1:
            // return back()
            //     ->withInput()
            //     ->withErrors(['email' => 'Your provided credentials could not be verified.']);

            // Solution 2:
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.',
            ]);
        }

        // always regenerate the user session in order to prevent SESSION FIXATION
        session()->regenerate();

        // redirect with a success flash message
        return redirect('/')->with('success', 'Welcome back!');

    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
