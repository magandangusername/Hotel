<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoomStatusController extends Controller
{
    public function index()
    {
        $statuses = DB::table('room_statuses')
            ->leftJoin('reservation_tables', 'room_statuses.confirmation_number', '=', 'reservation_tables.confirmation_number')
            ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')

            ->get();


        return view('admin/roomstatus')->with(compact('statuses'));
    }

    public function editstatus(Request $request)
    {
        $statuses = DB::table('room_statuses')
            ->leftJoin('reservation_tables', 'room_statuses.confirmation_number', '=', 'reservation_tables.confirmation_number')
            ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')

            ->get();

        if ($request->input('editroomstatus') !== null) {

            // $request->validate([
            //     'room_name' => 'required',
            //     'room_long_description' => 'required',
            //     'room_short_description' => 'required',
            //     'room_size' => 'required',
            //     'base_price' => 'required',
            //     'amenities_number' => 'required',
            //     'image1' => 'image|mimes:jpg,png,jpeg,gif,svg',
            //     'image2' => 'image|mimes:jpg,png,jpeg,gif,svg',
            //     'image3' => 'image|mimes:jpg,png,jpeg,gif,svg'

            // ]);

            $rooms = DB::table('room_statuses')
                ->where('status', 0)
                ->get();

            $editstatus = DB::table('reservation_tables')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
                ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->where('reservation_tables.confirmation_number', $request->input('editroomstatus'))
                ->where('reserved_rooms.r1', $request->input('roomnumber'))
                ->first();

            $roomnum = 1;
            if ($editstatus === null) {
                $editstatus = DB::table('reservation_tables')
                    ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                    ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
                    ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                    ->leftJoin('room_statuses', 'reserved_rooms.r2', '=', 'room_statuses.room_number')
                    ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                    ->where('reservation_tables.confirmation_number', $request->input('editroomstatus'))
                    ->where('reserved_rooms.r2', $request->input('roomnumber'))
                    ->first();

                $roomnum = 2;
            }
            if ($editstatus === null) {
                $editstatus = DB::table('reservation_tables')
                    ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                    ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
                    ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                    ->leftJoin('room_statuses', 'reserved_rooms.r3', '=', 'room_statuses.room_number')
                    ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                    ->where('reservation_tables.confirmation_number', $request->input('editroomstatus'))
                    ->where('reserved_rooms.r3', $request->input('roomnumber'))
                    ->first();

                $roomnum = 3;
            }

            return view('admin/roomstatus')->with(compact('statuses', 'editstatus', 'rooms', 'roomnum'));
        }


        if ($request->input('updateroom') !== null) {




            if ($request->input('roomnum') == 1) {


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

                    ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
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

                        ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
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

                    ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
                    ->update([
                        'room_statuses.status' => 0,
                        'room_statuses.confirmation_number' => '',
                        'reserved_rooms.r1' => $request->input('room'),
                        'computeds.ctotal_price' => ($price->ctotal_price - $total) + $request->input('total_rate')
                    ]);



                // if you are thinking about refunding the excess downpayment or even adding more, dont. let the physical hotel deal with it

                // dd(($price->ctotal_price - $total) + $request->input('total_rate'));

                //updates the new room
                // $roomnum = DB::table('room_statuses')
                //     ->where('room_number', $request->input('room'))
                //     ->where('status', 0)
                //     ->first();

                // $roomnum = $roomnum->room_number;

                $roomstatus = DB::table('room_statuses')
                    ->where('room_number', $request->input('room'))
                    ->update([
                        'status' => 1,
                        'confirmation_number' => $request->input('confirmation_number')
                    ]);

                // $reserved_rooms = DB::table('reserved_rooms')
                //     ->where('rr_code', session('rr_code'))
                //     ->update([
                //         'r1' => $roomnum
                //     ]);

                DB::table('transfers')
                    ->insert([
                        'transfer_date' => date('Y-m-d H:i:s'),
                        'previous_room' => $request->input('updateroom'),
                        'transferred_room' => $request->input('room'),
                        'confirmation_number' => $request->input('confirmation_number'),
                        'reason' => $request->input('reason')
                    ]);
                $transfer_id = DB::table('transfers')
                    ->max('transfer_id');

                DB::table('reservation_tables')
                    ->update([
                        'transfer_id' => $transfer_id
                    ]);

            } elseif ($request->input('roomnum') == 2) {


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

                    ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
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

                        ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
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

                    ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
                    ->update([
                        'room_statuses.status' => 0,
                        'room_statuses.confirmation_number' => '',
                        'reserved_rooms.r2' => $request->input('room'),
                        'computeds.ctotal_price' => ($price->ctotal_price - $total) + $request->input('total_rate')
                    ]);



                $roomstatus = DB::table('room_statuses')
                    ->where('room_number', $request->input('room'))
                    ->update([
                        'status' => 1,
                        'confirmation_number' => $request->input('confirmation_number')
                    ]);

                DB::table('transfers')
                    ->insert([
                        'transfer_date' => date('Y-m-d H:i:s'),
                        'previous_room' => $request->input('updateroom'),
                        'transferred_room' => $request->input('room'),
                        'confirmation_number' => $request->input('confirmation_number'),
                        'reason' => $request->input('reason')
                    ]);

                $transfer_id = DB::table('transfers')
                    ->max('transfer_id');

                DB::table('reservation_tables')
                    ->update([
                        'transfer_id' => $transfer_id
                    ]);
            } elseif ($request->input('roomnum') == 3) {


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

                    ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
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

                        ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
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

                    ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
                    ->update([
                        'room_statuses.status' => 0,
                        'room_statuses.confirmation_number' => '',
                        'reserved_rooms.r3' => $request->input('room'),
                        'computeds.ctotal_price' => ($price->ctotal_price - $total) + $request->input('total_rate')
                    ]);



                $roomstatus = DB::table('room_statuses')
                    ->where('room_number', $request->input('room'))
                    ->update([
                        'status' => 1,
                        'confirmation_number' => $request->input('confirmation_number')
                    ]);


                DB::table('transfers')
                    ->insert([
                        'transfer_date' => date('Y-m-d H:i:s'),
                        'previous_room' => $request->input('updateroom'),
                        'transferred_room' => $request->input('room'),
                        'confirmation_number' => $request->input('confirmation_number'),
                        'reason' => $request->input('reason')
                    ]);

                $transfer_id = DB::table('transfers')
                    ->max('transfer_id');

                DB::table('reservation_tables')
                    ->update([
                        'transfer_id' => $transfer_id
                    ]);
            }


            return redirect(route('roomstatus'));
        }


        return view('admin/roomstatus')->with(compact('statuses'));
    }
}
