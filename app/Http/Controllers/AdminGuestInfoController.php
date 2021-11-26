<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminGuestInfoController extends Controller
{
    public function index (){
        $users = DB::table('users')
        ->get();

        return view('admin/managedata/guestdata')->with(compact('users'));

    }


    public function modifyguestacc (){


        return redirect(route('adminguestacc'));

    }
}
