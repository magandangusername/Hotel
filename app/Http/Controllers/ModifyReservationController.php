<?php

namespace App\Http\Controllers;

use App\Mail\CancellationMail;
use App\Models\guest_information;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\BillingPortal\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe;

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
        $book = '';
        $bookinfo = '';
        $bookinfo2 = '';
        $bookinfo3 = '';
        // dd(session('uid').' '.session('gid'));
        if(session('uid') !== null || session('gid') !== null){
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
            ->leftJoin('payment_informations', 'guest_informations.payment_code', '=', 'payment_informations.payment_code')


            ->where('reservation_tables.confirmation_number', session('confirmation_number'))

            // ->where('reservation_tables.user_id', session('uid'))
            ->where('reservation_tables.guest_code', session('gid'))

            ->first();
            $user = false;
            if($book->first_name === null) {

                $book = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('room_descriptions', 'room_statuses.room_suite_name', '=', 'room_descriptions.room_name')
                ->leftJoin('payment_informations', 'users.payment_code', '=', 'payment_informations.payment_code')

                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->first();
                $user = true;
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
                ->leftJoin('payment_informations', 'users.payment_code', '=', 'payment_informations.payment_code')


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
                // dd($bookinfo2);
            // }

            // dd($bookinfo->adult, $bookinfo2->adult, $bookinfo3->adult);







        } else {
            $message = 'An error occured trying to fetch data.';
        }


        return view('modify')->with(compact('message', 'book', 'bookinfo', 'bookinfo2', 'bookinfo3', 'user'));
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
        $message = '';
        $book = '';
        $bookinfo = '';
        $bookinfo2 = '';
        $bookinfo3 = '';
        if(session('uid') !== null || session('gid') !== null){
            $book = DB::table('reservation_tables')
            ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
            ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
            ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
            ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
            ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
            ->leftJoin('payment_informations', 'guest_informations.payment_code', '=', 'payment_informations.payment_code')
            ->where('reservation_tables.confirmation_number', session('confirmation_number'))
            ->where('reservation_tables.guest_code', session('gid'))

            ->first();
            $user = false;
            if($book->first_name === null) {
                $book = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('room_descriptions', 'room_statuses.room_suite_name', '=', 'room_descriptions.room_name')
                ->leftJoin('payment_informations', 'users.payment_code', '=', 'payment_informations.payment_code')
                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->first();
                $user = true;
            }
                // This is the saddest code ive ever done
                $bookinfo = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('head_counts', 'reserved_rooms.head_count_id1', '=', 'head_counts.id')
                ->leftJoin('payment_informations', 'users.payment_code', '=', 'payment_informations.payment_code')


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
        }

        if($request->input('cancel') == 'cancel'){
            $reservation = DB::table('reservation_tables')
            ->where('confirmation_number', session('confirmation_number'))
            ->first();
            $to = \Carbon\Carbon::createFromFormat('Y-m-d', date("Y-m-d", strtotime($reservation->arrival_date)));
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', date("Y-m-d", strtotime('now')));
            $diff_in_hours = $to->diffInHours($from);
            // print_r($diff_in_hours);// Output: 6

            // dd($reservation->arrival_date.' - '.date("Y-m-d", strtotime('now')).' = '.$diff_in_hours.' hours');

            if ($diff_in_hours <= 24) {
                $invalidcancellation = true;
                return view('modify')->with(compact('message', 'book', 'bookinfo', 'bookinfo2', 'bookinfo3', 'user', 'invalidcancellation'));
            } else {

                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $re = \Stripe\Refund::create([
                    "charge" => $book->charge_id
                ]);


                $cancel = DB::table('reservation_tables')
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
                ->update(['room_statuses.status' => 0, 'room_statuses.confirmation_number' => '', 'reservation_tables.cancelled_on' => Carbon::now()]);

                $cancel = DB::table('reservation_tables')
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

                $cancel = DB::table('reservation_tables')
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


                $name = $book->first_name.' '.$book->last_name;
                $amount = number_format($book->ctotal_price / 2, 2);
                Mail::to($book->email)->send(new CancellationMail($name, $amount));




                return redirect(route('index').'?success=Your cancellation has been refunded! Please check your email.');


            }








        }

        if($request->input('cancelappeal') == 'cancelappeal'){
            $paymentinfo = DB::table('cancellation_requests')->insert([
                'confirmation_number' => session('confirmation_number'),
                'reason' => $request->input('reason'),
                'approval_status' => 'pending'

            ]);

            $appealsubmitted = true;
            return view('modify')->with(compact('message', 'book', 'bookinfo', 'bookinfo2', 'bookinfo3', 'user', 'appealsubmitted'));
        }

        if($request->input('editguestinfo') == 'editguestinfo'){
            $editguest = true;
            return view('modify')->with(compact('message', 'book', 'bookinfo', 'bookinfo2', 'bookinfo3', 'user', 'editguest'));
        }

        if($request->input('submitguestinfo') == 'submitguestinfo'){
            if($user){
                $edit = DB::table('users')
                    ->where('id', session('uid'))
                    ->update(['first_name' => $request->input('first_name'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'mobile_num' => $request->input('mobile_num'),
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                ]);
            } else {
                $edit = DB::table('guest_informations')
                    ->where('guest_code', session('gid'))
                    ->update(['first_name' => $request->input('first_name'),
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'mobile_num' => $request->input('mobile_num'),
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                ]);
            }

            return redirect('/modify');
        }


        if ($request->input('total_rate') !== null) {
            $request->validate([
                'bed' => 'required',
                'room_type' => 'required',
                'rate_type' => 'required',
                'total_rate' => 'required'
            ]);

            if(session('room_num') == 'r1'){

                //finds and edit the old room
                $price = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('head_counts', 'reserved_rooms.head_count_id1', '=', 'head_counts.id')
                ->leftJoin('room_descriptions', 'room_statuses.room_suite_name', '=', 'room_descriptions.room_name')

                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->orWhere('reservation_tables.guest_code', session('gid'))
                ->first();

                if ($price->base_price === null) {
                    $price = DB::table('reservation_tables')
                    ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                    ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                    ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                    ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                    ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                    ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                    ->leftJoin('head_counts', 'reserved_rooms.head_count_id1', '=', 'head_counts.id')
                    ->leftJoin('suite_descriptions', 'room_statuses.room_suite_name', '=', 'suite_descriptions.suite_name')

                    ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                    ->where('reservation_tables.user_id', session('uid'))
                    ->orWhere('reservation_tables.guest_code', session('gid'))
                    ->first();
                }

                $base_price = $price->base_price;
                $rate_discount = $price->base_price * $price->base_discount;
                $city_tax = $price->base_price * $price->city_tax;
                $vat = $price->base_price * $price->vat;
                $service_charge = $price->base_price * $price->service_rate;
                $nights = (new DateTime(date('Y-m-d', strtotime($price->arrival_date))))->diff(new DateTime(date('Y-m-d', strtotime($price->departure_date))))->days;
                $total = (($price->base_price - $rate_discount) + $vat + $service_charge + $city_tax) * $nights;




                // dd('(('.$base_price.' - '.$rate_discount.')'.' + '.$city_tax.' + '.$vat.' + '.$service_charge.' * '.$nights.') = '.$total);
                // dd('('.$price->ctotal_price.' - '.$total.') + '.$request->input('total_rate'). ' = '.($price->ctotal_price - $total) + $request->input('total_rate'));


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
                ->update(['room_statuses.status' => 0, 'room_statuses.confirmation_number' => '', 'computeds.ctotal_price' => ($price->ctotal_price - $total) + $request->input('total_rate')]);


                // dd(($price->ctotal_price - $total) + $request->input('total_rate'));

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
                $price = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r2', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate2', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('head_counts', 'reserved_rooms.head_count_id2', '=', 'head_counts.id')
                ->leftJoin('room_descriptions', 'room_statuses.room_suite_name', '=', 'room_descriptions.room_name')

                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->orWhere('reservation_tables.guest_code', session('gid'))
                ->first();

                if ($price->base_price === null) {
                    $price = DB::table('reservation_tables')
                    ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                    ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                    ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                    ->leftJoin('room_statuses', 'reserved_rooms.r2', '=', 'room_statuses.room_number')
                    ->leftJoin('rate_descriptions', 'reserved_rooms.rate2', '=', 'rate_descriptions.rate_name')
                    ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                    ->leftJoin('head_counts', 'reserved_rooms.head_count_id2', '=', 'head_counts.id')
                    ->leftJoin('suite_descriptions', 'room_statuses.room_suite_name', '=', 'suite_descriptions.suite_name')

                    ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                    ->where('reservation_tables.user_id', session('uid'))
                    ->orWhere('reservation_tables.guest_code', session('gid'))
                    ->first();
                }

                $base_price = $price->base_price;
                $rate_discount = $price->base_price * $price->base_discount;
                $city_tax = $price->base_price * $price->city_tax;
                $vat = $price->base_price * $price->vat;
                $service_charge = $price->base_price * $price->service_rate;
                $nights = (new DateTime(date('Y-m-d', strtotime($price->arrival_date))))->diff(new DateTime(date('Y-m-d', strtotime($price->departure_date))))->days;
                $total = (($price->base_price - $rate_discount) + $vat + $service_charge + $city_tax) * $nights;



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
                ->update(['room_statuses.status' => 0, 'room_statuses.confirmation_number' => '', 'computeds.ctotal_price' => ($price->ctotal_price - $total) + $request->input('total_rate')]);

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
                $price = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r3', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate3', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('head_counts', 'reserved_rooms.head_count_id3', '=', 'head_counts.id')
                ->leftJoin('room_descriptions', 'room_statuses.room_suite_name', '=', 'room_descriptions.room_name')

                ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                ->where('reservation_tables.user_id', session('uid'))
                ->orWhere('reservation_tables.guest_code', session('gid'))
                ->first();

                if ($price->base_price === null) {
                    $price = DB::table('reservation_tables')
                    ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                    ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                    ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                    ->leftJoin('room_statuses', 'reserved_rooms.r3', '=', 'room_statuses.room_number')
                    ->leftJoin('rate_descriptions', 'reserved_rooms.rate3', '=', 'rate_descriptions.rate_name')
                    ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                    ->leftJoin('head_counts', 'reserved_rooms.head_count_id3', '=', 'head_counts.id')
                    ->leftJoin('suite_descriptions', 'room_statuses.room_suite_name', '=', 'suite_descriptions.suite_name')

                    ->where('reservation_tables.confirmation_number', session('confirmation_number'))
                    ->where('reservation_tables.user_id', session('uid'))
                    ->orWhere('reservation_tables.guest_code', session('gid'))
                    ->first();
                }

                $base_price = $price->base_price;
                $rate_discount = $price->base_price * $price->base_discount;
                $city_tax = $price->base_price * $price->city_tax;
                $vat = $price->base_price * $price->vat;
                $service_charge = $price->base_price * $price->service_rate;
                $nights = (new DateTime(date('Y-m-d', strtotime($price->arrival_date))))->diff(new DateTime(date('Y-m-d', strtotime($price->departure_date))))->days;
                $total = (($price->base_price - $rate_discount) + $vat + $service_charge + $city_tax) * $nights;


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
                ->update(['room_statuses.status' => 0, 'room_statuses.confirmation_number' => '', 'computeds.ctotal_price' => ($price->ctotal_price - $total) + $request->input('total_rate')]);

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

            if(session('uid') !== null || session('gid')){
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
                dd('An error occured trying to fetch data.');
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
