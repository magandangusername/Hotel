<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CancellationMail;
use Stripe;

class AdminCancellationsController extends Controller
{
    public function index (){
        $cancellations = DB::table('cancellation_requests')
        ->where('approval_status', '!=', 'approved')
        ->where('approval_status', '!=', 'denied')
        ->get();

        return view('admin/managereservations/cancellations')->with(compact('cancellations'));

    }

    public function approvedeny (Request $request){
        $cancellations = DB::table('cancellation_requests')
        ->where('approval_status', '!=', 'approved')
        ->where('approval_status', '!=', 'denied')
        ->get();

        if($request->input('deny') == 'deny') {
            DB::table('cancellation_requests')
            ->where('id', $request->input('id'))
            ->update([
                'approval_status' => 'denied',
                'approved_denied_on' => date("Y-m-d H:s:i", strtotime('now'))
            ]);
            return redirect('admin/cancellation?success=Cancellation has been denied!');
        }
        if($request->input('approve') == 'approve') {
            // DB::table('cancellation_requests')
            // ->where('id', $request->input('id'))
            // ->update([
            //     'approval_status' => 'approved',
            //     'approved_denied_on' => date("Y-m-d H:s:i", strtotime('now'))
            // ]);

            $book = DB::table('reservation_tables')
            ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
            ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
            ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
            ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
            ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
            ->leftJoin('payment_informations', 'guest_informations.payment_code', '=', 'payment_informations.payment_code')
            ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
            ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
            ->first();

            if($book->first_name == null){
                $book = DB::table('reservation_tables')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
                ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('payment_informations', 'users.payment_code', '=', 'payment_informations.payment_code')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
                ->first();
            }


            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            if ($book->guest_code == null) {
                $re = \Stripe\Refund::create([
                    'amount' => $book->ctotal_price * 100,
                    'currency' => 'php',
                    "customer" => $book->customer_id
                ]);
            } else {

                $re = \Stripe\Refund::create([
                    "charge" => $book->charge_id
                ]);
            }


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



            DB::table('cancellation_requests')
            ->where('id', $request->input('id'))
            ->update([
                'approval_status' => 'approved',
                'approved_denied_on' => date("Y-m-d H:s:i", strtotime('now'))
            ]);

            return redirect('admin/cancellation?success=Cancellation has been approved!');
        }

        // return view('admin/managereservations/cancellations')->with(compact('cancellations'));
        return redirect('admin/cancellation');

    }
}
