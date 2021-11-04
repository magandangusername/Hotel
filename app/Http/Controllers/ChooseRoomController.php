<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ChooseRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $rates = DB::table('rate_descriptions')->get();
        // $roomtype = DB::table('room_statuses')->distinct()->get(['room_suite_name']);
        // echo 'FUUUUUUU';
        // return view('chooseroom')->with(compact('rates', 'roomtype'));
        return view('chooseroom');
        // foreach ($roomtype as $rooms) {
        //     echo $rooms->room_suite_name."<br>";
        // }
        // return redirect('/book');
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
        /*
        reminder if there is something wrong: check the operators
        */

        // if($request->input('proceed') == 'proceed'){
        //     return redirect('/bookinfo');
        // }

        $request->validate([
            'bed' => 'required',
            'room_type' => 'required',
            'rate_type' => 'required',
            'total_rate' => 'required'
        ]);
        // echo 'i hate this';
        // Session::forget([
        //     'roomtype',
        //     'ratetype',
        //     'bed',
        //     'totralrate',
        //     'RoomCount',
        //     'roomchecker',
        //     'roomchecker2',
        //     'roomtype2',
        //     'ratetype2',
        //     'bed2',
        //     'totralrate2'
        // ]);

        if(session('RoomCount') >= session('room')){
            if(session('room')==1){
                $data = $request->input();
                $request->session()->put('roomtype', $data['room_type']);
                $request->session()->put('ratetype', $data['rate_type']);
                $request->session()->put('bed', $data['bed']);
                $request->session()->put('totalrate', $data['total_rate']);
                //Session::put('command', '');

                $checkavailable = DB::table('room_statuses')
                ->where('room_suite_name', session('roomtype'))
                ->where('room_suite_bed', session('bed'))
                ->where('status', '0')
                ->count();
                $roomchecker = false;
                if($checkavailable > 0) {
                    if($checkavailable < 2){
                        $roomchecker = false;
                        if(session('bed') == 'Queen Bed'){
                            Session::put('bedcheckerq', false);
                        } elseif(session('bed') == 'King Bed'){
                            Session::put('bedcheckerk', false);
                        } else {
                            $roomchecker = true;
                            if(session('bed') == 'Queen Bed'){
                                Session::put('bedcheckerq', true);
                            } elseif(session('bed') == 'King Bed'){
                                Session::put('bedcheckerk', true);
                            }
                        }
                    }

                } else {
                    $roomchecker = false;
                    if(session('bed') == 'Queen Bed') {
                        Session::put('bedcheckerq', false);
                    } elseif(session('bed') == 'King Bed') {
                        Session::put('bedcheckerk', false);
                    }
                }
                // $roomchecker = false;
                Session::put('roomchecker', $roomchecker);

            }

            if (session('room') == 2) {
                $data = $request->input();
                $request->session()->put('roomtype2', $data['room_type']);
                $request->session()->put('ratetype2', $data['rate_type']);
                $request->session()->put('bed2', $data['bed']);
                $request->session()->put('totalrate2', $data['total_rate']);
                //Session::put('command', '');

                //2nd choice is the same as the 1st one
                if ($data['room_type'] == session('roomtype') && $data['bed'] == session('bed')) {
                    $checkavailable = DB::table('room_statuses')
                    ->where('room_suite_name', session('roomtype'))
                    ->where('room_suite_bed', session('bed'))
                    ->where('status', '0')
                    ->count();

                    if($checkavailable > 0) {
                        if($checkavailable <= 2){
                            $roomchecker2 = false;
                            if(session('bed') == 'Queen Bed'){
                                Session::put('bedcheckerq', false);
                            } elseif(session('bed') == 'King Bed'){
                                Session::put('bedcheckerk', false);
                            } else {
                                $roomchecker2 = true;
                                if(session('bed') == 'Queen Bed'){
                                    Session::put('bedcheckerq', true);
                                } elseif(session('bed') == 'King Bed'){
                                    Session::put('bedcheckerk', true);
                                }
                            }
                        }

                    } else {
                        $roomchecker2 = false;
                        if(session('bed') == 'Queen Bed') {
                            Session::put('bedcheckerq', false);
                        } elseif(session('bed') == 'King Bed') {
                            Session::put('bedcheckerk', false);
                        }
                    }
                    // Session::put('roomchecker', $roomchecker);
                } else {
                    $checkavailable = DB::table('room_statuses')
                    ->where('room_suite_name', session('roomtype'))
                    ->where('room_suite_bed', session('bed'))
                    ->where('status', '0')
                    ->count();
                    $roomchecker = false;

                    if($checkavailable > 0) {
                        if($checkavailable < 2){
                            $roomchecker = false;
                            if(session('bed') == 'Queen Bed'){
                                Session::put('bedcheckerq', false);
                            } elseif(session('bed') == 'King Bed'){
                                Session::put('bedcheckerk', false);
                            } else {
                                $roomchecker = true;
                                if(session('bed') == 'Queen Bed'){
                                    Session::put('bedcheckerq', true);
                                } elseif(session('bed') == 'King Bed'){
                                    Session::put('bedcheckerk', true);
                                }
                            }
                        }

                    } else {
                        $roomchecker = false;
                        if(session('bed') == 'Queen Bed') {
                            Session::put('bedcheckerq', false);
                        } elseif(session('bed') == 'King Bed') {
                            Session::put('bedcheckerk', false);
                        }
                    }
                    Session::put('roomchecker', $roomchecker);

                }

            }


            if (session('room') == 3) {
                $data = $request->input();
                $request->session()->put('roomtype3', $data['room_type']);
                $request->session()->put('ratetype3', $data['rate_type']);
                $request->session()->put('bed3', $data['bed']);
                $request->session()->put('totalrate3', $data['total_rate']);
                //Session::put('command', '');


            }
            if(isset($roomchecker)) {
                Session::put('roomchecker', $roomchecker);
            }
            if(isset($roomchecker2)) {
                Session::put('roomchecker2', $roomchecker2);
            }
            if(session('RoomCount') == session('room')) {
                return redirect('/bookinfo');
                // $review = 'review';
                // $bookinfo2 = null;
                // $bookinfo3 = null;
                // return view('modify')->with(compact('review', 'bookinfo2', 'bookinfo3'));
            }


        }
        if (session('RoomCount') > session('room')){
            Session::put('room', session('room') + 1);
        }


        return view('chooseroom');
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
        echo 'rip';
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
        echo 'check mate';
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
