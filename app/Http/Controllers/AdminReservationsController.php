<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReservationsController extends Controller
{
    public function index (){
        $reservations = DB::table('reservation_tables')
        ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
        ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
        // ->leftJoin('head_counts as hc2', 'reserved_rooms.head_count_id1', '=', 'hc2.id')
        // ->leftJoin('head_counts as hc3', 'reserved_rooms.head_count_id1', '=', 'hc3.id')
        ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
        ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
        ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
        ->leftJoin('payment_informations', 'guest_informations.payment_code', '=', 'payment_informations.payment_code')
        // ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
        ->get();
        // ->first();

        // if($reservations[0]->first_name == null || $reservations[0]->first_name == '') {
        //     dd('yes');
        // }

        // dd($reservations[0]->payment_type);

        return view('admin/managereservations/reservations')->with(compact('reservations'));

    }

    public function editreservation (Request $request){
        $reservations = DB::table('reservation_tables')
        ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
        ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
        ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
        ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
        ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
        ->leftJoin('payment_informations', 'guest_informations.payment_code', '=', 'payment_informations.payment_code')
        ->get();

        if ($request->input('editreservation') !== null) {



            $room = DB::table('reservation_tables')
            ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
            ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
            ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
            ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
            ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
            ->leftJoin('payment_informations', 'guest_informations.payment_code', '=', 'payment_informations.payment_code')
            ->where('reservation_tables.confirmation_number', $request->input('editreservation'))
            ->first();
            if($room->first_name == null){
                $room = DB::table('reservation_tables')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
                ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('payment_informations', 'users.payment_code', '=', 'payment_informations.payment_code')
                ->where('reservation_tables.confirmation_number', $request->input('editreservation'))
                ->first();
            }

            // dd($reservations);

            $editreserve= true;

            return view('admin/managereservations/reservations')->with(compact('reservations','editreserve','room'));
            // return redirect('admin/reservation#edit')->with(compact('reservations','editreserve','room'));
        }

        if ($request->input('updatereservation') !== null || $request->input('updatereservation') == 'updatereservation') {
            dd('noice');

        }

        return redirect('admin/reservation');


    }
}
