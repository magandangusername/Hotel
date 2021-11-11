<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPaymentInfoController extends Controller
{
    public function index (){

        return view('admin/managedata/paymentdata');

    }
}
