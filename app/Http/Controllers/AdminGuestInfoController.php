<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminGuestInfoController extends Controller
{
    public function index (){
        $users = DB::table('users')
        ->where('admin', '!=', 1)
        ->get();
        $guests = DB::table('guest_informations')
        ->get();

        return view('admin/managedata/guestdata')->with(compact('users', 'guests'));

    }


    public function modifyguestinfo (Request $request){
        $users = DB::table('users')
        ->where('admin', '!=', 1)
        ->get();
        $guests = DB::table('guest_informations')
        ->get();

        if ($request->input('deleteguestinfo') !== null) {

            $active_reservations = DB::table('reservation_tables')
            ->where('user_id', $request->input('deleteguestinfo'))
            ->where('departure_date', '>', date('Y-m-d'))
            ->count();

            if ($active_reservations == 0) {
                $active_reservations = DB::table('reservation_tables')
                ->where('guest_code', $request->input('deleteguestinfo'))
                ->where('departure_date', '>', date('Y-m-d'))
                ->count();
            }


            if ($active_reservations != 0) {
                return redirect(route('adminguestinfo').'?error=This guest still has ongoing reservation.');
            }


            if(!DB::table('users')
            ->where('id', $request->input('deleteguestinfo'))
            ->delete()) {
                DB::table('guest_informations')
                ->where('guest_code', $request->input('deleteguestinfo'))
                ->delete();
            }

            return redirect(route('adminguestinfo').'?success=Guest has been deleted.');

        }


        if($request->input('editguestinfo') !== null){
            $editguest = DB::table('users')
            ->where('id', $request->input('editguestinfo'))
            ->first();

            if($editguest->first_name == null){
                $editguest = DB::table('guest_informations')
                ->where('guest_code', $request->input('editguestinfo'))
                ->first();

            }
            $edit = true;

            return view('admin/managedata/guestdata')->with(compact('users', 'guests', 'editguest', 'edit'));

        }

        if ($request->input('submitedit') !== null) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'email' => 'required',
                'mobile_num' => 'required'


            ]);


            $guest_info = DB::table('users')
            ->where('id', $request->input('submitedit'))
            ->count();

            if($guest_info != 0){
                $guest_info = DB::table('users')
                ->where('id', $request->input('submitedit'))
                ->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                    'email' => $request->input('email'),
                    'mobile_num' => $request->input('mobile_num')
                ]);

            }else{
                $guest_info = DB::table('guest_informations')
                ->where('guest_code', $request->input('submitedit'))
                ->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                    'email' => $request->input('email'),
                    'mobile_num' => $request->input('mobile_num')
                ]);
            }

            return redirect(route('adminguestinfo').'?success=Guest has been edited.');


        }


        return redirect(route('adminguestinfo'));

    }
}
