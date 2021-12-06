<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoomTransfersController extends Controller
{
    public function index()
    {
        $roomtransfers = DB::table('transfers')
            ->get();


        return view('admin/managereservations/roomtransfers')->with(compact('roomtransfers'));
    }
}
