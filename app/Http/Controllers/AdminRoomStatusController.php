<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoomStatusController extends Controller
{
    public function index (){
        $statuses = DB::table('room_statuses')
        ->get();

        return view('admin/roomstatus')->with(compact('statuses'));

    }
}
