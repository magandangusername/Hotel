<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRequestsController extends Controller
{
    public function index (){
        $requests = DB::table('request_lists')
        ->leftJoin('reservation_tables', 'request_lists.rql_id', '=', 'reservation_tables.request_id')
        // ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
        ->get();
        // if ($requests->first_name !== $) {

        // }

        return view('admin/managewebsite/addrequest')->with(compact('requests'));

    }

    public function modifyrequests (Request $request){
        $requests = DB::table('request_lists')
        ->leftJoin('reservation_tables', 'request_lists.rql_id', '=', 'reservation_tables.request_id')
        ->get();

        if($request->input('deleterequest') !== null){

            $request_charge = DB::table('request_lists')
            ->where('rql_id', $request->input('deleterequest'))
            ->first();

            $computeds_price = DB::table('reservation_tables')
            ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
            ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
            ->first();

            $computeds = DB::table('reservation_tables')
            ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
            ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
            ->update([
                'ctotal_price' => $computeds_price->ctotal_price - $request_charge->request_charge
            ]);

            $request_charge = $request_charge->request_charge;


            DB::table('request_lists')
            ->where('rql_id', $request->input('deleterequest'))
            ->delete();

            DB::table('reservation_tables')
            ->where('request_id', $request->input('deleterequest'))
            ->update([
                'request_id' => null
            ]);



            return redirect(route('adminmanagerequests'));

        }

        if($request->input('editrequest') !== null){
            $editrequest = DB::table('request_lists')
            ->leftJoin('reservation_tables', 'request_lists.rql_id', '=', 'reservation_tables.request_id')
            ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')

            ->where('rql_id', $request->input('editrequest'))
            ->first();
            if($editrequest->first_name == null){
                $editrequest = DB::table('request_lists')
                ->leftJoin('reservation_tables', 'request_lists.rql_id', '=', 'reservation_tables.request_id')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')

                ->where('rql_id', $request->input('editrequest'))
                ->first();
            }

            return view('admin/managewebsite/addrequest')->with(compact('requests', 'editrequest'));

        }

        if($request->input('submitedit') !== null){

            $prev_rq_price = DB::table('request_lists')
            ->where('rql_id', $request->input('submitedit'))
            ->first();

            $prev_rq_price = $prev_rq_price->request_charge;

            DB::table('request_lists')
            ->where('rql_id', $request->input('submitedit'))
            ->update([
                'rql1' => $request->input('rql1'),
                'rql2' => $request->input('rql2'),
                'rql3' => $request->input('rql3'),
                'rql4' => $request->input('rql4'),
                'rql5' => $request->input('rql5'),
                'rql6' => $request->input('rql6'),
                'rql7' => $request->input('rql7'),
                'rql8' => $request->input('rql8'),
                'rql9' => $request->input('rql9'),
                'rql10' => $request->input('rql10'),
                'request_charge' => $request->input('request_charge')
            ]);

            $computeds_price = DB::table('reservation_tables')
            ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
            ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
            ->first();

            $computeds = DB::table('reservation_tables')
            ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
            ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
            ->update([
                'ctotal_price' => ($computeds_price->ctotal_price - $prev_rq_price) + $request->input('request_charge')
            ]);

            return redirect(route('adminmanagerequests'));

        }


        if($request->input('addrequest') !== null){
            $reservations = DB::table('reservation_tables')
            ->whereNull('request_id')
            ->get();

            $add = true;

            return view('admin/managewebsite/addrequest')->with(compact('requests', 'add', 'reservations'));

        }

        if($request->input('submitadd') !== null){
            $request->validate([
                'rql1' => "required"

            ]);

            DB::table('request_lists')
            ->insert([
                'rql1' => $request->input('rql1'),
                'rql2' => $request->input('rql2'),
                'rql3' => $request->input('rql3'),
                'rql4' => $request->input('rql4'),
                'rql5' => $request->input('rql5'),
                'rql6' => $request->input('rql6'),
                'rql7' => $request->input('rql7'),
                'rql8' => $request->input('rql8'),
                'rql9' => $request->input('rql9'),
                'rql10' => $request->input('rql10'),
                'request_charge' => $request->input('request_charge')
            ]);

            $request_id = DB::table('request_lists')
            ->max('rql_id');

            DB::table('reservation_tables')
            ->where('confirmation_number', $request->input('confirmation_number'))
            ->update([
                'request_id' => $request_id
            ]);

            $computeds_price = DB::table('reservation_tables')
            ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
            ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
            ->first();

            $computeds = DB::table('reservation_tables')
            ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
            ->where('reservation_tables.confirmation_number', $request->input('confirmation_number'))
            ->update([
                'ctotal_price' => $computeds_price->ctotal_price + $request->input('request_charge')
            ]);





            return redirect(route('adminmanagerequests'));

        }



        return view('admin/managewebsite/addrequest')->with(compact('requests'));

    }
}
