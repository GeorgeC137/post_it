<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Middleware to prevent registered users from registering again
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request->email); dd()is used to kill the page and outputs anything you write(email in this case)
        // Before storing the user we need to:
        // validate the user
        $this->validate($request, [
            'name'=> 'required|max:255',
            'username'=> 'required|max:255',
            'email'=> 'required|email',
            'phone'=> 'required|numeric|digits:10',
            'password'=> 'required|confirmed',
            'address'=> 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/'
        ]);

        // store user
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'password'=> Hash::make($request->password),
            'username'=> $request->username,
            'address'=> $request->address,
        ]);

        // sign in user
        auth()->attempt($request->only('email', 'password'));

        // redirect user
        return redirect()->route('dashboard');
    }
}
