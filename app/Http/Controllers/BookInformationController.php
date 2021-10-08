<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookCompleteMail;
use Stripe;


class BookInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bookinformation');
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
            'name_with_initials' => 'required',
            'fn' => 'required',
            'ln' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'mobilenum' => 'required',
            'vehicle1' => 'required',
            'vehicle2' => 'required'
        ]);

        $data = $request->input();
        // $title = $data['name_with_initials'];
        // $fn = $data['fn'];
        // $ln = $data['ln'];
        // $email = $data['email'];
        // $address = $data['address'];
        // $city = $data['city'];

        Session::put('title', $data['name_with_initials']);
        Session::put('fn', $data['fn']);
        Session::put('ln', $data['ln']);
        Session::put('email', $data['email']);
        Session::put('address', $data['address']);
        Session::put('city', $data['city']);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => 100 * session('downpayment'),
            "currency" => "php",
            "source" => $request->stripeToken,
            "description" => "Book down payment"
        ]);

        Session::flash('success', 'Payment successful!');

        // return back();





        $title = session('title');
        $fn = session('fn');
        $ln = session('ln');
        $email = session('email');
        $address = session('address');
        $city = session('city');
        $mobilenum = session('mobilenum');
        $paymenttype =  session('paymenttype');
        $chname =  session('chname');
        $chnum =  session('chnum');
        $expiration =  session('expiration');

        $countguest = DB::table('guest_informations')->count();

        $guestcode = "GC-0" . strval($countguest);
        $paymentcode = "PC-0" . strval($countguest);

        //reservation info

        $totalc = DB::table('reservation_tables')->select('confirmation_number')->count();
        $confirmation_number = strval(date('Ymd')) . strval($totalc + 1);
        $arrival = session('CheckIn');
        $departure = session('CheckOut');
        $adult = session('AdultCount');
        $child = session('ChildCount');
        if (session('RoomCount') >= 2) {
            $adult2 = session('AdultCount2');
            $child2 = session('ChildCount2');
            if (session('rooms') == 3) {
            $adult3 = session('AdultCount3');
            $child3 = session('ChildCount3');
            }
        }


        $rr_code = DB::table('reserved_rooms')->select('rr_code')->count();
        $rr_code = "RR-0" . strval($rr_code + 1);

        $ratetype = session('ratetype');
        $roomsuitename = session('roomtype');
        $roomsuitebed = session('bed');
        if (session('RoomCount') >= 2) {
            $roomsuitename2 = session('roomtype2');
            $roomsuitebed2 = session('bed2');
            $ratetype2 = session('ratetype2');
        } else {
            $roomsuitename2 = '';
            $roomsuitebed2 = '';
            $ratetype2 = '';
        }
        if (session('RoomCount') == 3) {
            $roomsuitename3 = session('roomtype3');
            $roomsuitebed3 = session('bed3');
            $ratetype3 = session('ratetype3');
        } else {
            $roomsuitename3 = '';
            $roomsuitebed3 = '';
            $ratetype3 = '';
        }

        $roomnum = DB::table('room_statuses')
        ->where('room_suite_name', $roomsuitename)
        ->where('room_suite_bed', $roomsuitebed)
        ->where('status', 0)
        ->first();

        if ($roomnum != null) {
            $roomnum = $roomnum->room_number;

        } else {
            echo "ERROR1: One of the rooms became unavailable before you submitted your reservation. Please check the availability of the rooms again.";
            exit;
        }



        if ($roomsuitename2 != '') {
            $roomnum2 = DB::table('room_statuses')
            ->where('room_suite_name', $roomsuitename2)
            ->where('room_suite_bed', $roomsuitebed2)
            ->where('status', 0)
            ->first();

            if ($roomnum2 != null) {
                $roomnum2 = $roomnum2->room_number;

            } else {
                echo "ERROR1: One of the rooms became unavailable before you submitted your reservation. Please check the availability of the rooms again.";
                exit;
            }

        } else {
            $roomnum2 = '';
        }

        if ($roomsuitename3 != '') {
            $roomnum3 = DB::table('room_statuses')
            ->where('room_suite_name', $roomsuitename3)
            ->where('room_suite_bed', $roomsuitebed3)
            ->where('status', 0)
            ->first();

            if ($roomnum3 != null) {
                $roomnum3 = $roomnum3->room_number;

            } else {
                echo "ERROR1: One of the rooms became unavailable before you submitted your reservation. Please check the availability of the rooms again.";
                exit;
            }
        } else {
            $roomnum3 = '';
        }



        if (session('promocode') != null && session('promocode') != '') {
            $promocode = session('promocode');
        } else {
            $promocode = '';
        }

        $paymentcode = '';
        // $paymentcode = DB::table('orders')->max('id');




        $guestinformation = DB::table('guest_informations')->insert([
            'guest_code' => $guestcode,
            'title' => $title,
            'first_name' => $fn,
            'last_name' => $ln,
            'address' => $address,
            'city' => $city,
            'email_address' => $email,
            'payment_code' => $paymentcode

        ]);


        $reservedroomsinfo = DB::table('reserved_rooms')->insert([
            'rr_code' => $rr_code,
            'r1' => $roomnum,
            'r2' => $roomnum2,
            'r3' => $roomnum3,
            'rate1' => $ratetype,
            'rate2' => $ratetype2,
            'rate3' => $ratetype3,
            'r1h' => '',
            'r2h' => '',
            'r3h' => ''

        ]);

        $computed = DB::table('computeds')->insert([
            'ctotal_price' => session('downpayment') * 2
        ]);

        $id = DB::table('computeds')->max('id');

        $reservationinfo = DB::table('reservation_tables')->insert([
            'confirmation_number' => $confirmation_number,
            'arrival_date' => $arrival,
            'departure_date' => $departure,
            'guest_code' => $guestcode,
            'booked_at' => date('Y-m-d h:i:s'),
            'rr_code' => $rr_code,
            'promotion_code' => $promocode,
            'computed_price_id' => $id
        ]);



        $roomstatus = DB::table('room_statuses')
        ->where('room_number', $roomnum)
        ->orWhere('room_number', $roomnum2)
        ->orWhere('room_number', $roomnum3)
        ->update(['status' => 1, 'confirmation_number' => $confirmation_number]);

        // $commands = $guestinformation . $reservedroomsinfo . $reservationinfo . $roomstatus;

        // if ($conn->query($guestinformation) && $conn->query($reservedroomsinfo) && $conn->query($reservationinfo) && $conn->query($roomstatus)) {
        //     // echo "Your confirmation number is: $confirmation_number";
        //     $_SESSION['confirmation_number'] = $confirmation_number;
        // } else {
        //     echo "ERROR OCCURED INSERTING TO DATABASE";
        //     $_SESSION['confirmation_number'] = "ERROR OCCURED INSERTING TO DATABASE";
        // }

        Session::put('totalprice', session('downpayment') * 2);

        Session::put('confirmation_number', $confirmation_number);




        $details = [
            'title' => 'hallo',
            'body' => 'im under the water'
        ];

        Mail::to($data['email'])->send(new BookCompleteMail($details));






        // return redirect('/bookinfo');
        return view('confdisplay');


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
