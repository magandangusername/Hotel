<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchModifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check() && !Auth::user()->verified) {

            return redirect('/email/verify');
        }
        return view('search');
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

        $request->validate([
            'confirmation_number' => 'required|integer',
            'email' => 'required'
        ]);

        $data = $request->input();

        // $user = DB::table('users')->where('email', $data['email'])->first();


        // $id = '';
        // if ($user != null) {
        //     $id = $user->id;
        // } else {
            // $guest = DB::table('guest_informations')->where('email', $data['email'])->first();
        //     if ($guest != null) {
        //         $id = $guest->guest_code;

        //     }
        // }

        // $uid = "";
        // $gid = "";
        // if($user !== null){
        //     $uid = $user->id;
        // }

        // if($guest !== null){
        //     $gid = $guest->guest_code;
        // }



        // $book = DB::table('reservation_tables')->where('confirmation_number', $data['confirmation_number'])->where('user_id', $uid)->orWhere('guest_code', $gid)->count();

            $book = DB::table('reservation_tables')
            ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
            ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
            ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
            ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
            ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')

            ->where('reservation_tables.confirmation_number', $data['confirmation_number'])
            ->whereNull('reservation_tables.cancelled_on')
            // ->where('reservation_tables.user_id', session('uid'))
            ->where('guest_informations.email', $data['email'])

            ->first();
            if($book === null) {
                $book = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('room_descriptions', 'room_statuses.room_suite_name', '=', 'room_descriptions.room_name')

                ->where('reservation_tables.confirmation_number', $data['confirmation_number'])
                ->whereNull('reservation_tables.cancelled_on')
                // ->where('reservation_tables.user_id', session('uid'))
                // ->orWhere('reservation_tables.guest_code', session('gid'))
                ->where('users.email', $data['email'])
                ->first();
            }




        // $gbook = DB::table('reservation_tables')->where('guest_code', $gid)->where('confirmation_number', $data['confirmation_number'])->count();
        if($book !== null) {
            if ($book->arrival_date <= date('Y-m-d')) {
                return redirect(route('search.index').'?error=This reservation is already ongoing.');
            }
            Session::put('confirmation_number', $data['confirmation_number']);
            Session::put('uid', $book->user_id);
            Session::put('gid', $book->guest_code);
            return redirect('modify');
            dd('congrats');

        } else {
            return redirect(route('search.index').'?error=Invalid reservation number or email.');
            dd('INVALID CONFIRMATION OR EMAIL');
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
