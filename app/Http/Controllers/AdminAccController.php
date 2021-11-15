<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAccController extends Controller
{
    public function index (){
        if(Auth::check() && Auth::user()->admin == 1){



        return view('admin/manageaccounts/manageadmin');

        } else{
            dd('You do not have permission to do access this.');
        }

    }
}
