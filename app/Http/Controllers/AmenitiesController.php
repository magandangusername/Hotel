<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    public function index() {

        return view('index');
    }
}
