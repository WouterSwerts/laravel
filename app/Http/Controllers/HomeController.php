<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {

        // dd(Auth::id());
        // dd(Auth::user());
        // dd(Auth::check());
        return view('home.index');
    }

    public function contact() {
        return view('home.contact');
    }

    public function secret() {
        return view('home.secret');
    }
}
