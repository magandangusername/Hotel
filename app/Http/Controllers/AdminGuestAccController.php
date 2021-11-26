<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminGuestAccController extends Controller
{
    public function index (){
        $users = DB::table('users')
        ->get();

        return view('admin/manageaccounts/manageguest')->with(compact('users'));

    }

    public function modifyguestacc (Request $request){


        return redirect(route('adminguestacc'));

    }
}
