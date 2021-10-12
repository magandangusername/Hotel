<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Rules\PromoValidDuration;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            if (Auth::user()->hasVerifiedEmail() != true) {
                return view('notverified');
            }

        }
        return view('booking');
    }
    public function book()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date1 = date("Y-m-d", strtotime('now'.'- 1 days'));
        $date2 = date("Y-m-d", strtotime('now'));

        $message = "validation failed";
        $request->validate([
            'CheckIn' => "required|date|after:".$date1,
            'CheckOut' => 'required|date|after:'.$date2,
            'RoomCount' => 'required|integer|min:1|max:3',
            'AdultCount' => 'required|integer|min:1',
            'ChildCount' => 'required|integer|min:0',
            'AdultCountRoom2' => 'required|integer|min:1',
            'ChildCountRoom2' => 'required|integer|min:0',
            'AdultCountRoom3' => 'required|integer|min:1',
            'ChildCountRoom3' => 'required|integer|min:0',
            'PromoCode' => ['nullable', new PromoValidDuration]

        ]);



        $request->session()->forget([
            'CheckIn',
            'CheckOut',
            'RoomCount',
            'AdultCount',
            'ChildCount',
            'AdultCountRoom2',
            'ChildCountRoom2',
            'AdultCountRoom3',
            'ChildCountRoom3',
            'PromoCode',
            'roomchecker',
            'room'

        ]);




        $data = $request->input();
        $request->session()->put('CheckIn', $data['CheckIn']);
        $request->session()->put('CheckOut', $data['CheckOut']);
        $request->session()->put('RoomCount', $data['RoomCount']);
        if (session('RoomCount') >= 1) {
            $request->session()->put('AdultCount', $data['AdultCount']);
            $request->session()->put('ChildCount', $data['ChildCount']);
            if (session('RoomCount') >= 2) {
                $request->session()->put('AdultCountRoom2', $data['AdultCountRoom2']);
                $request->session()->put('ChildCountRoom2', $data['ChildCountRoom2']);
                if (session('RoomCount') >= 3) {
                    $request->session()->put('AdultCountRoom3', $data['AdultCountRoom3']);
                    $request->session()->put('ChildCountRoom3', $data['ChildCountRoom3']);
                }
            }
        }
        $request->session()->put('PromoCode', $data['PromoCode']);

        // echo session('AdultCountRoom3');
        // dd("GOOD");
        // echo "validation successful! ".session('AdultCountRoom3');

        // return view('booking')->with('message', $message);
        return redirect('/chooseroom');
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
