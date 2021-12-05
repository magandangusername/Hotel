<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Rules\PromoValidDuration;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;

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
            if(Auth::check() && !Auth::user()->verified) {

                return redirect('/email/verify');
            }

        }
        $date = date("Y-m-d h:i:sa");
        $newpromos = DB::table('promotion_descriptions')
        ->orderByRaw('promotion_start DESC')
        ->where('promotion_start', '<=', $date)
        ->where('promotion_end', '>=', $date)
        ->limit(3)
        ->get();


        return view('booking')->with(compact('newpromos'));
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
            'AdultCount2' => 'required|integer|min:1',
            'ChildCount2' => 'required|integer|min:0',
            'AdultCount3' => 'required|integer|min:1',
            'ChildCount3' => 'required|integer|min:0',
            'PromoCode' => ['nullable', new PromoValidDuration]

        ]);



        $request->session()->forget([
            'CheckIn',
            'CheckOut',
            'RoomCount',
            'AdultCount',
            'ChildCount',
            'AdultCount2',
            'ChildCount2',
            'AdultCount3',
            'ChildCount3',
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
                $request->session()->put('AdultCount2', $data['AdultCount2']);
                $request->session()->put('ChildCount2', $data['ChildCount2']);
                if (session('RoomCount') >= 3) {
                    $request->session()->put('AdultCount3', $data['AdultCount3']);
                    $request->session()->put('ChildCount3', $data['ChildCount3']);
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
