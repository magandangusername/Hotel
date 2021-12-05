<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutusController extends Controller
{
    public function index() {
        if(Auth::check() && !Auth::user()->verified) {
            return redirect('/email/verify');
        }

        return view('aboutus');
    }

}
