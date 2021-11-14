<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function DashboardController (){
        $totalrooms = DB::table('room_statuses')
        ->count();
        $totalbooked = DB::table('room_statuses')
        ->where('status', 1)
        ->count();
        $unusedrooms = DB::table('room_statuses')
        ->where('status', 0)
        ->count();
        $reservations = DB::table('reservation_tables')
        ->where('departure_date','>=', date("Y-m-d", strtotime('now')))
        ->where(function($query)
            {
                $query->where('cancelled_on', null)
                ->orWhere('cancelled_on','');
            })
        ->count();
        $updaterequests = DB::table('reservation_updates')
        ->count();

        // im not sure if this actually works
        $frequentroom = DB::table('room_statuses')
        ->leftJoin('reserved_rooms as rr1', 'room_statuses.room_number', '=', 'rr1.r1')
        ->leftJoin('reserved_rooms as rr2', 'room_statuses.room_number', '=', 'rr2.r2')
        ->leftJoin('reserved_rooms as rr3', 'room_statuses.room_number', '=', 'rr3.r3')
        ->select('room_statuses.room_suite_name as room')
        ->groupBy('room')
        ->orderByRaw('COUNT(*) DESC')
        ->first();
        $frequentroom = $frequentroom->room;

        // and this one too
        $frequentrate = DB::table('rate_descriptions')
        ->leftJoin('reserved_rooms as rr1', 'rate_descriptions.rate_name', '=', 'rr1.rate1')
        ->leftJoin('reserved_rooms as rr2', 'rate_descriptions.rate_name', '=', 'rr2.rate2')
        ->leftJoin('reserved_rooms as rr3', 'rate_descriptions.rate_name', '=', 'rr3.rate3')
        ->select('rate_descriptions.rate_name as rate')
        ->groupBy('rate')
        ->orderByRaw('COUNT(*) DESC')
        ->first();
        $frequentrate = $frequentrate->rate;

        // and this one
        $frequentpromotion = DB::table('promotion_descriptions')
        ->leftJoin('reservation_tables as rt', 'promotion_descriptions.promotion_code', '=', 'rt.promotion_code')
        ->select('promotion_descriptions.promotion_name as promo')
        ->groupBy('promo')
        ->orderByRaw('COUNT(*) DESC')
        ->first();

        $frequentpromotion = $frequentpromotion->promo;

        $recentreservations = DB::table('reservation_tables')
        ->get();

        $recentmodifications = DB::table('modification_requests')
        ->get();

        $recentcancellations = DB::table('cancellation_requests')
        ->get();


        // dd($frequentpromotion);


        return view('admin/dashboard')->with(compact('totalrooms','totalbooked','unusedrooms','reservations','updaterequests','frequentroom','frequentrate','frequentpromotion','recentreservations','recentmodifications','recentcancellations'));

    }
}
