<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPromotionAddController extends Controller
{
    public function index (){

        return view('admin/managewebsite/managepromotions');

    }
}
