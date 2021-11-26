<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAmenityAddController extends Controller
{
    public function index (){
        $amenities = DB::table('amenities')
        ->get();

        return view('admin/managewebsite/manageamenities')->with(compact('amenities'));

    }

    public function modifyamenity(Request $request){
        $amenities = DB::table('amenities')
        ->get();

        if ($request->input('deleteamenity') !== null) {
            $roomsconnected = DB::table('room_descriptions')
            ->where('amenities_number', $request->input('deleteamenity'))
            ->count();

            $suitesconnected = DB::table('suite_descriptions')
            ->where('amenities_number', $request->input('deleteamenity'))
            ->count();

            $total = $roomsconnected+$suitesconnected;

            if($total == 0){
                DB::table('amenities')
                ->where('amenities_number', $request->input('deleteamenity'))
                ->delete();

                return redirect('admin/addamenity?success=Amenity '.$request->input('deleteamenity').' has been deleted.');
            } else {
                return redirect('admin/addamenity?error=This amenity number is still connected to room(s)/suite(s). Please change it first.');
            }



        }

        if ($request->input('editamenity') !== null) {
            $editamenity = DB::table('amenities')
            ->where('amenities_number', $request->input('editamenity'))
            ->first();

            $edit = true;

            return view('admin/managewebsite/manageamenities')->with(compact('amenities', 'editamenity', 'edit'));

        }

        if ($request->input('submitedit') !== null) {

            DB::table('amenities')
            ->where('amenities_number', $request->input('submitedit'))
            ->update([
                'a1' => $request->input('a1'),
                'a2' => $request->input('a2'),
                'a3' => $request->input('a3'),
                'a4' => $request->input('a4'),
                'a5' => $request->input('a5'),
                'a6' => $request->input('a6'),
                'a7' => $request->input('a7'),
                'a8' => $request->input('a8'),
                'a9' => $request->input('a9'),
                'a10' => $request->input('a10')
            ]);

            return redirect('admin/addamenity?success=Amenity '.$request->input('submitedit').' has been edited.');

        }

        if ($request->input('addamenity') == 'addamenity') {
            $add = true;

            return view('admin/managewebsite/manageamenities')->with(compact('amenities', 'add'));
        }



        if ($request->input('submitadd') == "submitadd") {
            $totalamenities = DB::table('amenities')
            ->count();

            $amenityid = 'DA-'.$totalamenities;


            while(true){
                $checkamenityid = DB::table('amenities')
                ->where('amenities_number', $amenityid)
                ->count();
                if($checkamenityid != 0){
                    $totalamenities++;
                    $amenityid = 'DA-'.$totalamenities;
                } else {
                    $amenityid = 'DA-'.$totalamenities;
                    break;
                }
            }


            DB::table('amenities')
            ->insert([
                'amenities_number' => $amenityid,
                'a1' => $request->input('a1'),
                'a2' => $request->input('a2'),
                'a3' => $request->input('a3'),
                'a4' => $request->input('a4'),
                'a5' => $request->input('a5'),
                'a6' => $request->input('a6'),
                'a7' => $request->input('a7'),
                'a8' => $request->input('a8'),
                'a9' => $request->input('a9'),
                'a10' => $request->input('a10')
            ]);

            return redirect('admin/addamenity?success=Amenity '.$request->input('amenityid').' has been created.');

        }




        return redirect('admin/addamenity');

    }
}
