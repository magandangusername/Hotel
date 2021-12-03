<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLoginController extends Controller
{
    public function index (){

        $logs = DB::table('reservation_logs')
        ->get();

        return view('admin/managedata/loggedreservations')->with(compact('logs'));

    }
}
