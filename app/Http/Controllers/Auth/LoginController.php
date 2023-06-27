<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Middleware to prevent user from login in twice
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validate user
        $this->validate($request, [
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        // Redirect to last page user visited if NOT authenticated
        if (!auth()->attempt($request->only('email', 'password'), $request->remember))
        {
            return back()->with('status', 'Invalid credentials');
        }

        return redirect()->route('dashboard');
    }
}
