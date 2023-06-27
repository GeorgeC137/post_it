<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    // Making dashboard unaccessible if user s not logged in
    public function __construct()
    {
        $this->middleware(['auth']);
    }

        public function index()
    {
        return view('dashboard');
    }
}
