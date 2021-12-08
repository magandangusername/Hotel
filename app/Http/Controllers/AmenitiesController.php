<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    public function index() {
        if(Auth::check() && !Auth::user()->email_verified_at) {
            return view('auth.verify');
        }

        return view('index');
    }
}
