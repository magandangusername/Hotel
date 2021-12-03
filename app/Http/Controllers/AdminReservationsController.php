<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rules\PromoValidDuration;
use DateTime;

class AdminReservationsController extends Controller
{
    public function index (){
        $reservations = DB::table('reservation_tables')
        ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
        ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
        // ->leftJoin('head_counts as hc2', 'reserved_rooms.head_count_id1', '=', 'hc2.id')
        // ->leftJoin('head_counts as hc3', 'reserved_rooms.head_count_id1', '=', 'hc3.id')
        ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
        ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
        ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
        ->leftJoin('payment_informations', 'guest_informations.payment_code', '=', 'payment_informations.payment_code')
        ->whereNull('reservation_tables.cancelled_on')
        // ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
        ->get();
        // ->first();

        // if($reservations[0]->first_name == null || $reservations[0]->first_name == '') {
        //     dd('yes');
        // }

        // dd($reservations[0]->payment_type);

        return view('admin/managereservations/reservations')->with(compact('reservations'));

    }

    public function editreservation (Request $request){
        $reservations = DB::table('reservation_tables')
        ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
        ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
        ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
        ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
        ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
        ->leftJoin('payment_informations', 'guest_informations.payment_code', '=', 'payment_informations.payment_code')
        ->get();

        if ($request->input('editreservation') !== null) {



            $room = DB::table('reservation_tables')
            ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
            ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
            ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
            ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
            ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
            ->leftJoin('payment_informations', 'guest_informations.payment_code', '=', 'payment_informations.payment_code')
            ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
            ->where('reservation_tables.confirmation_number', $request->input('editreservation'))
            ->first();
            if($room->first_name == null){
                $room = DB::table('reservation_tables')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
                ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('payment_informations', 'users.payment_code', '=', 'payment_informations.payment_code')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->where('reservation_tables.confirmation_number', $request->input('editreservation'))
                ->first();
            }

            $roominfo2 = DB::table('reservation_tables')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id2', '=', 'hc1.id')
                ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                ->leftJoin('room_statuses', 'reserved_rooms.r2', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate2', '=', 'rate_descriptions.rate_name')
                ->where('reservation_tables.confirmation_number', $request->input('editreservation'))
                ->first();
                // dd($room2);

            $roominfo3 = DB::table('reservation_tables')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id3', '=', 'hc1.id')
                ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                ->leftJoin('room_statuses', 'reserved_rooms.r3', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate3', '=', 'rate_descriptions.rate_name')
                ->where('reservation_tables.confirmation_number', $request->input('editreservation'))
                ->first();

            // dd($reservations);

            $editreserve= true;

            return view('admin/managereservations/reservations')->with(compact('reservations','editreserve','room','roominfo2','roominfo3'));
            // return redirect('admin/reservation#edit')->with(compact('reservations','editreserve','room'));
        }

        if ($request->input('updatereservation') !== null || $request->input('updatereservation') == 'updatereservation') {
            $date1 = date("Y-m-d", strtotime('now'.'- 1 days'));
            $date2 = date("Y-m-d", strtotime('now'));
            $request->validate([
                // 'CheckIn' => "required|date|after:".$date1,
                // 'CheckOut' => 'required|date|after:'.$date2,
                'PromoCode' => ['nullable', new PromoValidDuration]

            ]);



            $room = DB::table('reservation_tables')
            ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
            ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
            ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
            ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
            ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
            ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
            ->first();

            if($room->r2 != '' || $room->r2 != null) {
                $roominfo2 = DB::table('reservation_tables')
                    ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                    ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id2', '=', 'hc1.id')
                    ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                    ->leftJoin('room_statuses', 'reserved_rooms.r2', '=', 'room_statuses.room_number')
                    ->leftJoin('rate_descriptions', 'reserved_rooms.rate2', '=', 'rate_descriptions.rate_name')
                    ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
                    ->first();
            }
            if($room->r3 != '' || $room->r3 != null) {
                $roominfo3 = DB::table('reservation_tables')
                    ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                    ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id3', '=', 'hc1.id')
                    ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
                    ->leftJoin('room_statuses', 'reserved_rooms.r3', '=', 'room_statuses.room_number')
                    ->leftJoin('rate_descriptions', 'reserved_rooms.rate3', '=', 'rate_descriptions.rate_name')
                    ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
                    ->first();
            }

            $total = 0;
            $total2 = 0;
            $total3 = 0;

            if ($request->input('PromoCode') != '' || $request->input('PromoCode') !== null) {
                $promodiscount = DB::table('promotion_descriptions')
                    ->where('promotion_code', $request->input('PromoCode'))
                    ->first();
                    $promotion_code = $request->input('PromoCode');
                $promodiscount = $promodiscount->overall_cut;
            } else {
                $promodiscount = 0;
                $promotion_code = '';
            }





            $price = DB::table('room_descriptions')
                ->where('room_name', $room->room_suite_name)
                ->first();
            if($price === null){
                $price = DB::table('suite_descriptions')
                    ->where('suite_name', $room->room_suite_name)
                    ->first();
            }

            $newnights = (new DateTime(date('Y-m-d', strtotime($request->input('CheckIn')))))->diff(new DateTime(date('Y-m-d', strtotime($request->input('CheckOut')))))->days;


            $vat = $price->base_price * $room->vat;
            $service_charge = $price->base_price * $room->service_rate;
            $city_tax = $price->base_price * $room->city_tax;
            $promo = $price->base_price * $promodiscount;
            $rate_discount = $price->base_price * $room->base_discount;
            $subtotal = $price->base_price + $vat + $service_charge + $city_tax;
            $total = ($subtotal - ($rate_discount + $promo)) * $newnights;

            if($room->r2 != '' || $room->r2 != null) {
                $price2 = DB::table('room_descriptions')
                    ->where('room_name', $roominfo2->room_suite_name)
                    ->first();
                if($price2 === null){
                    $price2 = DB::table('suite_descriptions')
                        ->where('suite_name', $roominfo2->room_suite_name)
                        ->first();
                }

                $vat2 = $price2->base_price * $roominfo2->vat;
                $service_charge2 = $price2->base_price * $roominfo2->service_rate;
                $city_tax2 = $price2->base_price * $roominfo2->city_tax;
                $promo2 = $price2->base_price * $promodiscount;
                $rate_discount2 = $price2->base_price * $roominfo2->base_discount;
                $subtotal2 = $price2->base_price + $vat2 + $service_charge2 + $city_tax2;
                $total2 = ($subtotal2 - ($rate_discount2 + $promo2)) * $newnights;
            }
            if($room->r3 != '' || $room->r3 != null) {
                $price3 = DB::table('room_descriptions')
                    ->where('room_name', $roominfo3->room_suite_name)
                    ->first();
                if($price3 === null){
                    $price3 = DB::table('suite_descriptions')
                        ->where('suite_name', $roominfo3->room_suite_name)
                        ->first();
                }
                $vat3 = $price3->base_price * $roominfo3->vat;
                $service_charge3 = $price3->base_price * $roominfo3->service_rate;
                $city_tax3 = $price3->base_price * $roominfo3->city_tax;
                $promo3 = $price3->base_price * $promodiscount;
                $rate_discount3 = $price3->base_price * $roominfo3->base_discount;
                $subtotal3 = $price3->base_price + $vat3 + $service_charge3 + $city_tax3;
                $total3 = ($subtotal3 - ($rate_discount3 + $promo3)) * $newnights;
            }


            $overall = $total + $total2 + $total3;

            // updates the database
            $updatereserve = DB::table('reservation_tables')
            ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
            ->leftJoin('head_counts as hc1', 'reserved_rooms.head_count_id1', '=', 'hc1.id')
            ->leftJoin('computeds', 'computeds.id', '=', 'reservation_tables.computed_price_id')
            ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
            ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
            ->leftJoin('payment_informations', 'guest_informations.payment_code', '=', 'payment_informations.payment_code')
            ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
            ->leftJoin('promotion_descriptions', 'reservation_tables.promotion_code', '=', 'promotion_descriptions.promotion_code')
            ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
            ->update(['reservation_tables.arrival_date' => $request->input('CheckIn'),
            'reservation_tables.departure_date' => $request->input('CheckOut'),
            'reservation_tables.promotion_code' => $promotion_code,
            'computeds.ctotal_price' => $overall]);





            // return view('admin/managereservations/reservations')->with(compact('reservations','editreserve','room','roominfo2','roominfo3'));
            return redirect('admin/reservation?success=modified reservation successfuly');

        }

        return redirect('admin/reservation');


    }
}
