<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookCompleteMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use CardDetect;
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
        // if(Auth::check()){
        //     if (Auth::user()->hasVerifiedEmail() != true) {
        //         return view('notverified');
        //     }

        // }
        if (session('RoomCount') >= 1) {
            $totalrate = floatval(session('totalrate'));
            if (session('RoomCount') >= 2) {
                $totalrate += floatval(session('totalrate2'));
                if (session('RoomCount') == 3) {
                    $totalrate += floatval(session('totalrate3'));
                }
            }
        }
        Session::put('overallprice', $totalrate);

        if (Auth::check()) {
            $review = 'review';
            $profile = DB::table('users')
                ->leftJoin('payment_informations', 'payment_informations.payment_code', '=', 'users.payment_code')
                ->where('users.id', Auth::user()->id)
                ->first();
            $bookinfo2 = null;
            $bookinfo3 = null;
            return view('modify')->with(compact('review', 'bookinfo2', 'bookinfo3', 'profile'));
        }
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
        // if($request->input('review') == 'review'){
        //     $review = 'review';
        //     $bookinfo2 = null;
        //     $bookinfo3 = null;
        //     return view('modify')->with(compact('review', 'bookinfo2', 'bookinfo3'));
        // }






        // dd(number_format(session('downpayment'), 2, '.', ''));
        // Session::put('downpayment', number_format(session('downpayment'), 2, '.', ''));
        // Session::put('totalprice', session('downpayment') * 2);
        // dd(number_format(session('overallprice') * 0.5, 2));
        // dd(number_format(session('overallprice') / 2, 2, '.', '') * 100);
        // dd(number_format(100 * session('downpayment'), 2, '.', ''));


        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // Stripe\Charge::create ([
        //     "amount" => number_format(session('overallprice') / 2, 2, '.', '') * 100,
        //     "currency" => "php",
        //     "source" => $request->stripeToken,
        //     "description" => "Book down payment"
        // ]);

        // Session::flash('success', 'Payment successful!');

        // return back();

        //reservation info











        if ($request->input('proceed') == "proceed") {



            $payment = DB::table('payment_informations')->count();
            $payment = 'PC-0' . ($payment + 1);

            $detector = new CardDetect\Detector();
            $card = str_replace(' ', '', $request->input('card_number'));

            $cardtype = $detector->detect($card);
            if ($cardtype == 'Invalid Card') {
                $cardtype = 'mastercard';
            }
            $cardtoken = strtolower($cardtype);


            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            if ($request->input('addpaymenttoprofile') == 'addpaymenttoprofile') {
                $customer = \Stripe\Customer::create([
                    'source' => 'tok_' . $cardtoken,
                    'email' => Auth::user()->email,
                ]);
                $charge = \Stripe\Charge::create([
                    'amount' => number_format(session('overallprice') / 2, 2, '.', '') * 100,
                    'currency' => 'php',
                    'customer' => $customer->id,
                ]);

                $user = DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update(['payment_code' => $payment]);
            } elseif ($request->input('savedpayment') == 'savedpayment') {
                $profile = DB::table('users')
                    ->leftJoin('payment_informations', 'payment_informations.payment_code', '=', 'users.payment_code')
                    ->where('users.id', Auth::user()->id)
                    ->first();
                // dd($request->input('cardcvc').' '. $profile->cvc);
                if ($request->input('cardcvc') == $profile->cvc) {
                    // dd(session()->all());
                    $charge = Stripe\Charge::create([
                        "amount" => number_format(session('overallprice') / 2, 2, '.', '') * 100,
                        "currency" => "php",
                        "customer" => $profile->customer_id,
                        "description" => "Book down payment"
                    ]);
                } else {
                    return redirect('/bookinfo?error=CVC is incorrect');
                }
            } else {
                // $charge = Stripe\Charge::create([
                //     "amount" => number_format(session('overallprice') / 2, 2, '.', '') * 100,
                //     "currency" => "php",
                //     "source" => $request->stripeToken,
                //     "description" => "Book down payment"
                // ]);
                $customer = \Stripe\Customer::create([
                    'source' => 'tok_' . $cardtoken,
                    'email' => session('email'),
                ]);
                $charge = \Stripe\Charge::create([
                    'amount' => number_format(session('overallprice') / 2, 2, '.', '') * 100,
                    'currency' => 'php',
                    'customer' => $customer->id,
                ]);

            }

            Session::flash('success', 'Payment successful!');



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



            $totalc = DB::table('reservation_tables')->select('confirmation_number')->count();
            $confirmation_number = strval(date('Ymd')) . strval($totalc + 1);


            while(true){
                $checkrrtables = DB::table('reservation_tables')
                ->where('confirmation_number', $confirmation_number)
                ->count();
                if($checkrrtables != 0){
                    $totalc++;
                    $confirmation_number = strval(date('Ymd')) . strval($totalc + 1);
                } else {
                    $confirmation_number = strval(date('Ymd')) . strval($totalc + 1);
                    break;
                }
            }

            $arrival = session('CheckIn');
            $departure = session('CheckOut');
            $adult = session('AdultCount');
            $child = session('ChildCount');

            $adult2 = '';
            $child2 = '';
            $adult3 = '';
            $child3 = '';


            if (session('RoomCount') >= 2) {
                $adult2 = session('AdultCount2');
                $child2 = session('ChildCount2');
                if (session('RoomCount') == 3) {
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

            // $payment = DB::table('payment_informations')->count();
            // $payment = 'PC-0'.($payment + 1);

            // $detector = new CardDetect\Detector();
            // $card = str_replace(' ', '', $request->input('card_number'));

            // $cardtype = $detector->detect($card);
            // if($cardtype == 'Invalid Card'){
            //     $cardtype = 'mastercard';
            // }
            // $cardtoken = strtolower($cardtype);


            // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            // if ($request->input('addpaymenttoprofile') == 'addpaymenttoprofile') {
            //     $customer = \Stripe\Customer::create([
            //         'source' => 'tok_'.$cardtoken,
            //         'email' => Auth::user()->email,
            //     ]);
            //     $charge = \Stripe\Charge::create([
            //         'amount' => number_format(session('overallprice') / 2, 2, '.', '') * 100,
            //         'currency' => 'php',
            //         'customer' => $customer->id,
            //     ]);

            //     $user = DB::table('users')
            //     ->where('id', Auth::user()->id)
            //     ->update(['payment_code' => $payment]);
            // }elseif ($request->input('savedpayment') == 'savedpayment') {
            //     $profile = DB::table('users')
            //         ->leftJoin('payment_informations', 'payment_informations.payment_code', '=', 'users.payment_code')
            //         ->where('users.id', Auth::user()->id)
            //         ->first();
            //         // dd($request->input('cardcvc').' '. $profile->cvc);
            //     if($request->input('cardcvc') == $profile->cvc){
            //         // dd(session()->all());
            //         $charge = Stripe\Charge::create ([
            //             "amount" => number_format(session('overallprice') / 2, 2, '.', '') * 100,
            //             "currency" => "php",
            //             "customer" => $profile->customer_id,
            //             "description" => "Book down payment"
            //         ]);
            //     }else{
            //         return redirect('/bookinfo?error=CVC is incorrect');
            //     }
            // }else {
            //     $charge = Stripe\Charge::create ([
            //         "amount" => number_format(session('overallprice') / 2, 2, '.', '') * 100,
            //         "currency" => "php",
            //         "source" => $request->stripeToken,
            //         "description" => "Book down payment"
            //     ]);
            // }

            // Session::flash('success', 'Payment successful!');

            $detector = new CardDetect\Detector();
            $card = str_replace(' ', '', $request->input('card_number'));
            $cardtype = $detector->detect($card);

            $cardtype = $detector->detect($card);
            if ($cardtype == 'Invalid Card') {
                $cardtype = 'Unknown Card';
            }

            if (!($request->input('savedpayment') == 'savedpayment') && !($request->input('addpaymenttoprofile') == 'addpaymenttoprofile')) {
                $paymentinfo = DB::table('payment_informations')->insert([
                    'payment_code' => $payment,
                    'payment_type' => $cardtype,
                    'card_number' => $request->input('cardnum'),
                    'card_holder_name' => $request->input('cardname'),
                    'expiration_month' => $request->input('cardexprm'),
                    'expiration_year' => $request->input('cardexpry'),
                    'CVC' => $request->input('cardcvc'),
                    'charge_id' => $charge->id,
                    'customer_id' => $customer->id

                ]);
            } elseif ($request->input('addpaymenttoprofile') == 'addpaymenttoprofile') {
                $paymentinfo = DB::table('payment_informations')->insert([
                    'payment_code' => $payment,
                    'payment_type' => $cardtype,
                    'card_number' => $request->input('cardnum'),
                    'card_holder_name' => $request->input('cardname'),
                    'expiration_month' => $request->input('cardexprm'),
                    'expiration_year' => $request->input('cardexpry'),
                    'CVC' => $request->input('cardcvc'),
                    'charge_id' => $charge->id,
                    'customer_id' => $customer->id

                ]);
            } elseif ($request->input('savedpayment') == 'savedpayment') {
                $paymentinfo = DB::table('payment_informations')
                ->where('payment_code', $profile->payment_code)
                ->update([
                    'charge_id' => $charge->id

                ]);
            }




            if ($roomnum != null) {
                $roomnum = $roomnum->room_number;

                $roomstatus = DB::table('room_statuses')
                    ->where('room_number', $roomnum)
                    ->update(['status' => 1, 'confirmation_number' => $confirmation_number]);
            } else {
                echo "ERROR1: One of the rooms became unavailable right before you submitted your reservation. Please check the availability of the rooms again.";
                $re = \Stripe\Refund::create([
                    "charge" => $charge->id
                ]);
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
                    echo "ERROR2: One of the rooms became unavailable right before you submitted your reservation. Please check the availability of the rooms again.";
                    $re = \Stripe\Refund::create([
                        "charge" => $charge->id
                    ]);
                    exit;
                }

                $roomstatus = DB::table('room_statuses')
                    ->where('room_number', $roomnum2)
                    ->update(['status' => 1, 'confirmation_number' => $confirmation_number]);
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
                    echo "ERROR3: One of the rooms became unavailable right before you submitted your reservation. Please check the availability of the rooms again.";
                    $re = \Stripe\Refund::create([
                        "charge" => $charge->id
                    ]);
                    exit;
                }
                $roomstatus = DB::table('room_statuses')
                    ->where('room_number', $roomnum3)
                    ->update(['status' => 1, 'confirmation_number' => $confirmation_number]);
            } else {
                $roomnum3 = '';
            }



            if (session('PromoCode') !== null && session('PromoCode') != "") {
                $promocode = session('PromoCode');
            } else {
                $promocode = '';
            }


            $paymentcode = '';
            // $paymentcode = DB::table('orders')->max('id');





            if (Auth::check() != true) {
                $guestinformation = DB::table('guest_informations')->insert([
                    'guest_code' => $guestcode,
                    'title' => $title,
                    'first_name' => $fn,
                    'last_name' => $ln,
                    'address' => $address,
                    'city' => $city,
                    'email' => $email,
                    'mobile_num' => $mobilenum,
                    'payment_code' => $payment

                ]);
            }





            $headcount = DB::table('head_counts')->insert([
                'adult' => $adult,
                'child' => $child
            ]);

            $headcount = DB::table('head_counts')->max('id');
            // $headcount = $headcount->id;
            // dd($headcount);
            $headcount2 = null;
            $headcount3 = null;
            if (session('RoomCount') >= 2) {
                $headcount2 = DB::table('head_counts')->insert([
                    'adult' => $adult2,
                    'child' => $child2
                ]);

                $headcount2 = DB::table('head_counts')->max('id');
                // $headcount2 = $headcount->id;
            }
            if (session('RoomCount') >= 3) {
                $headcount3 = DB::table('head_counts')->insert([
                    'adult' => $adult3,
                    'child' => $child3
                ]);

                $headcount3 = DB::table('head_counts')->max('id');
                // $headcount3 = $headcount->id;
            }

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
                'r3h' => '',
                'head_count_id1' => $headcount,
                'head_count_id2' => $headcount2,
                'head_count_id3' => $headcount3
            ]);

            $computed = DB::table('computeds')->insert([
                'ctotal_price' => session('overallprice')
            ]);

            $id = DB::table('computeds')->max('id');


            if (Auth::check()) {
                $reservationinfo = DB::table('reservation_tables')->insert([
                    'confirmation_number' => $confirmation_number,
                    'arrival_date' => $arrival,
                    'departure_date' => $departure,
                    'user_id' => Auth::user()->id,
                    'booked_at' => date('Y-m-d h:i:s'),
                    'rr_code' => $rr_code,
                    'promotion_code' => $promocode,
                    'computed_price_id' => $id
                ]);
            } else {
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
            }






            // $roomstatus = DB::table('room_statuses')
            // ->where('room_number', $roomnum)
            // ->orWhere('room_number', $roomnum2)
            // ->orWhere('room_number', $roomnum3)
            // ->update(['status' => 1, 'confirmation_number' => $confirmation_number]);





            // $commands = $guestinformation . $reservedroomsinfo . $reservationinfo . $roomstatus;

            // if ($conn->query($guestinformation) && $conn->query($reservedroomsinfo) && $conn->query($reservationinfo) && $conn->query($roomstatus)) {
            //     // echo "Your confirmation number is: $confirmation_number";
            //     $_SESSION['confirmation_number'] = $confirmation_number;
            // } else {
            //     echo "ERROR OCCURED INSERTING TO DATABASE";
            //     $_SESSION['confirmation_number'] = "ERROR OCCURED INSERTING TO DATABASE";
            // }



            Session::put('confirmation_number', $confirmation_number);




            $details = [
                'title' => 'hallo',
                'body' => 'im under the water'
            ];

            if (Auth::check()) {
                Mail::to(Auth::user()->email)->send(new BookCompleteMail($details, $confirmation_number));
            } else {
                Mail::to(session('email'))->send(new BookCompleteMail($details, $confirmation_number));
            }




            // Session::forget([
            //     'CheckIn',
            //     'CheckOut',
            //     'RoomCount',
            //     'AdultCount',
            //     'ChildCount',
            //     'PromoCode',
            //     'room',
            //     'roomchecker',
            //     'roomchecker2',
            //     'roomtype2',
            //     'ratetype2',
            //     'bedcheckerq',
            //     'bedcheckerk',
            //     'roomtype',
            //     'ratetype',
            //     'bed',
            //     'totalrate',
            //     'overallprice',
            //     'success',
            //     'confirmation_number'
            // ]);
            Session::forget([
                'roomtype1',
                'roomtype2',
                'roomtype3',
                'RoomCount',
                'totalrate',
                'totalrate2',
                'totalrate3'

            ]);

            // dd(session()->all());

            // return redirect('/bookinfo');
            return view('confdisplay')->with(compact('confirmation_number'));
        } else {
            if (Auth::check() != true) {
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
                Session::put('mobilenum', $data['mobilenum']);
            }
            $review = 'review';

            $bookinfo2 = null;
            $bookinfo3 = null;
            return view('modify')->with(compact('review', 'bookinfo2', 'bookinfo3'));
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
