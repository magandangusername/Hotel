<?php

namespace App\Http\Controllers;

use App\Models\guest_information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModifyReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = '';
        if(session('uid') !== null){
            // dd('meron '.session('uid'));
            $book = DB::table('reservation_tables')
            // ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
            ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
            ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
            ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
            // ->leftJoin('room_statuses', 'reserved_rooms.r2', '=', 'room_statuses.room_number')
            // ->leftJoin('room_statuses', 'reserved_rooms.r3', '=', 'room_statuses.room_number')
            ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
            ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')

            ->where('reservation_tables.confirmation_number', session('confirmation_number'))
            ->where('reservation_tables.user_id', session('uid'))
            ->orWhere('reservation_tables.guest_code', session('uid'))
            ->first();

            if($book->first_name === null) {
                $book = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')

                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->orWhere('reservation_tables.guest_code', session('uid'))
                ->first();
            }

        } else {
            $message = 'An error occured trying to fetch data.';
        }


        return view('modify')->with(compact('message', 'book'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
