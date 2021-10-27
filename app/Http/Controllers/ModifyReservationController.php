<?php

namespace App\Http\Controllers;

use App\Models\guest_information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\BillingPortal\Session;

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
        if(session('uid') !== null && session('gid') !== null){
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
            ->orWhere('reservation_tables.guest_code', session('gid'))
            ->first();
            dd('FUUUUK '.$book->first_name );
            if($book->first_name === null) {
                $book = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('room_descriptions', 'room_statuses.room_suite_name', '=', 'room_descriptions.room_name')

                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->orWhere('reservation_tables.guest_code', session('gid'))
                ->first();
            }

            // $bookinfo = DB;


            // $bookinfo = DB::table('reservation_tables')
            // ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
            // ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
            // ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
            // ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
            // ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
            // ->where('reservation_tables.confirmation_number', session('confirmation_number'))
            // ->where('reservation_tables.user_id', session('uid'))
            // ->orWhere('reservation_tables.guest_code', session('uid'))
            // ->count();

            // if($bookinfo->first_name === null) {



                // This is the saddest code ive ever done

                $bookinfo = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('head_counts', 'reserved_rooms.head_count_id1', '=', 'head_counts.id')

                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->orWhere('reservation_tables.guest_code', session('gid'))
                ->orWhere('reserved_rooms.head_count_id2', 'head_counts.id')
                ->orWhere('reserved_rooms.head_count_id3', 'head_counts.id')
                ->first();

                $bookinfo2 = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r2', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate2', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('head_counts', 'reserved_rooms.head_count_id2', '=', 'head_counts.id')

                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->orWhere('reservation_tables.guest_code', session('gid'))
                ->orWhere('reserved_rooms.head_count_id2', 'head_counts.id')
                ->orWhere('reserved_rooms.head_count_id3', 'head_counts.id')
                ->first();

                $bookinfo3 = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r3', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate3', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('head_counts', 'reserved_rooms.head_count_id3', '=', 'head_counts.id')

                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->orWhere('reservation_tables.guest_code', session('gid'))
                ->orWhere('reserved_rooms.head_count_id2', 'head_counts.id')
                ->orWhere('reserved_rooms.head_count_id3', 'head_counts.id')
                ->first();
            // }

            // dd($bookinfo->adult, $bookinfo2->adult, $bookinfo3->adult);







        } else {
            $message = 'An error occured trying to fetch data.';
        }


        return view('modify')->with(compact('message', 'book', 'bookinfo', 'bookinfo2', 'bookinfo3'));
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
        if ($request->input('total_rate') !== null) {
            $request->validate([
                'bed' => 'required',
                'room_type' => 'required',
                'rate_type' => 'required',
                'total_rate' => 'required'
            ]);

            if(session('room_num') == 'r1'){

                //finds and edit the old room
                $bookinfo = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('head_counts', 'reserved_rooms.head_count_id1', '=', 'head_counts.id')

                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->orWhere('reservation_tables.guest_code', session('gid'))
                ->update(['room_statuses.status' => 0, 'room_statuses.confirmation_number' => '']);

                //updates the new room
                $roomnum = DB::table('room_statuses')
                ->where('room_suite_name', $request->input('room_type'))
                ->where('room_suite_bed', $request->input('bed'))
                ->where('status', 0)
                ->first();

                $roomnum = $roomnum->room_number;

                $roomstatus = DB::table('room_statuses')
                ->where('room_number', $roomnum)
                ->update(['status' => 1, 'confirmation_number' => session('confirmation_number')]);

                $reserved_rooms = DB::table('reserved_rooms')
                ->where('rr_code', session('rr_code'))
                ->update(['r1' => $roomnum, 'rate1' => $request->input('rate_type')]);


            } else if(session('room_num') == 'r2'){

                //finds and edit the old room
                $bookinfo = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r2', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate2', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('head_counts', 'reserved_rooms.head_count_id2', '=', 'head_counts.id')

                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->orWhere('reservation_tables.guest_code', session('gid'))
                ->update(['room_statuses.status' => 0, 'room_statuses.confirmation_number' => '']);

                //updates the new room
                $roomnum = DB::table('room_statuses')
                ->where('room_suite_name', $request->input('room_type'))
                ->where('room_suite_bed', $request->input('bed'))
                ->where('status', 0)
                ->first();

                $roomnum = $roomnum->room_number;

                $roomstatus = DB::table('room_statuses')
                ->where('room_number', $roomnum)
                ->update(['status' => 1, 'confirmation_number' => session('confirmation_number')]);

                $reserved_rooms = DB::table('reserved_rooms')
                ->where('rr_code', session('rr_code'))
                ->update(['r2' => $roomnum, 'rate2' => $request->input('rate_type')]);


            } else if(session('room_num') == 'r3'){

                //finds and edit the old room
                $bookinfo = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r3', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate3', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('head_counts', 'reserved_rooms.head_count_id3', '=', 'head_counts.id')

                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->orWhere('reservation_tables.guest_code', session('gid'))
                ->update(['room_statuses.status' => 0, 'room_statuses.confirmation_number' => '']);

                //updates the new room
                $roomnum = DB::table('room_statuses')
                ->where('room_suite_name', $request->input('room_type'))
                ->where('room_suite_bed', $request->input('bed'))
                ->where('status', 0)
                ->first();

                $roomnum = $roomnum->room_number;

                $roomstatus = DB::table('room_statuses')
                ->where('room_number', $roomnum)
                ->update(['status' => 1, 'confirmation_number' => session('confirmation_number')]);

                $reserved_rooms = DB::table('reserved_rooms')
                ->where('rr_code', session('rr_code'))
                ->update(['r3' => $roomnum, 'rate3' => $request->input('rate_type')]);


            } else {
                dd("ERROR: Please try again later.");
            }




            return redirect('/modify');

        } else {
            $request->validate([
                'confirmation_number' => 'required',
                'room_num' => 'required',
                'rr_code' => 'required',
                'rate_name' => 'required'
            ]);
            $request->session()->put('confirmation_number', $request->input('confirmation_number'));
            $request->session()->put('room_num', $request->input('room_num'));
            $request->session()->put('rr_code', $request->input('rr_code'));
            $request->session()->put('rate_name', $request->input('rr_code'));

            if(session('uid') !== null){
                $book = DB::table('reservation_tables')
                ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('head_counts', 'reserved_rooms.head_count_id2', '=', 'head_counts.id')
                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->orWhere('reservation_tables.guest_code', session('gid'))
                ->first();

                if($book->first_name === null) {
                    $book = DB::table('reservation_tables')
                    ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                    ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                    ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                    ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                    ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                    ->leftJoin('room_descriptions', 'room_statuses.room_suite_name', '=', 'room_descriptions.room_name')
                    ->leftJoin('head_counts', 'reserved_rooms.head_count_id2', '=', 'head_counts.id')
                    ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                    ->where('reservation_tables.user_id', session('uid'))
                    ->orWhere('reservation_tables.guest_code', session('gid'))
                    ->first();
                }

                $bookinfo2 = DB::table('reservation_tables')
                    ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                    ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                    ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                    ->leftJoin('room_statuses', 'reserved_rooms.r2', '=', 'room_statuses.room_number')
                    ->leftJoin('rate_descriptions', 'reserved_rooms.rate2', '=', 'rate_descriptions.rate_name')
                    ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                    ->leftJoin('head_counts', 'reserved_rooms.head_count_id2', '=', 'head_counts.id')

                    ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                    ->where('reservation_tables.user_id', session('uid'))
                    ->orWhere('reservation_tables.guest_code', session('gid'))
                    ->orWhere('reserved_rooms.head_count_id2', 'head_counts.id')
                    ->orWhere('reserved_rooms.head_count_id3', 'head_counts.id')
                    ->first();

                    $bookinfo3 = DB::table('reservation_tables')
                    ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                    ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                    ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                    ->leftJoin('room_statuses', 'reserved_rooms.r3', '=', 'room_statuses.room_number')
                    ->leftJoin('rate_descriptions', 'reserved_rooms.rate3', '=', 'rate_descriptions.rate_name')
                    ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                    ->leftJoin('head_counts', 'reserved_rooms.head_count_id3', '=', 'head_counts.id')

                    ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                    ->where('reservation_tables.user_id', session('uid'))
                    ->orWhere('reservation_tables.guest_code', session('gid'))
                    ->orWhere('reserved_rooms.head_count_id2', 'head_counts.id')
                    ->orWhere('reserved_rooms.head_count_id3', 'head_counts.id')
                    ->first();



            } else {
                $message = 'An error occured trying to fetch data.';
            }

            return view('chooseroom')->with(compact('book', 'bookinfo2', 'bookinfo3'));
        }

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
