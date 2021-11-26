<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPromotionAddController extends Controller
{
    public function index (){
        $promotions = DB::table('promotion_descriptions')
        ->get();

        return view('admin/managewebsite/managepromotions')->with(compact('promotions'));

    }

    public function modifypromotion (Request $request){
        $promotions = DB::table('promotion_descriptions')
        ->get();

        if ($request->input('deletepromo') !== null) {
            $promocheck = DB::table('promotion_descriptions')
                ->leftJoin('reservation_tables', 'promotion_descriptions.promotion_code', '=', 'reservation_tables.promotion_code')
                ->where('reservation_tables.promotion_code', $request->input('deletepromo'))
                ->where('reservation_tables.departure_date', '>=', date('Y-m-d'))
                ->count();


            if ($promocheck == 0) {
                DB::table('promotion_descriptions')
                ->where('promotion_code', $request->input('deletepromo'))
                ->delete();

            } else {
                return redirect(route('adminpromotion').'?error=Promotion cannot be deleted as it is being used in current reservations.');
            }


            return redirect(route('adminpromotion').'?success=Promotion has been deleted.');

        }


        if ($request->input('editpromo') !== null) {
            $editpromo = DB::table('promotion_descriptions')
            ->where('promotion_code', $request->input('editpromo'))
            ->first();

            $edit = true;

            return view('admin/managewebsite/managepromotions')->with(compact('promotions', 'editpromo', 'edit'));

        }


        if ($request->input('submitedit') !== null) {
            $request->validate([
                'promotion_code' => 'required',
                'promotion_name' => 'required',
                'promotion_long_description' => 'required',
                'promotion_short_description' => 'required',
                'overall_cut' => 'required',
                'promotion_start' => 'required',
                'promotion_end' => 'required'
                // 'image3' => 'required|image|mimes:jpg,png,jpeg,gif,svg'

            ]);

            if($request->hasFile('image_name')){

                $filenameWithExt = $request->file('image_name');
                $filenameWithExt = $filenameWithExt->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image_name')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $request->file('image_name')->move(public_path('/images'), $fileNameToStore);

                DB::table('promotion_descriptions')
                ->where('promotion_code', $request->input('submitedit'))
                ->update([
                    'image_name' => $fileNameToStore
                ]);
            }

            DB::table('promotion_descriptions')
            ->where('promotion_code', $request->input('submitedit'))
            ->update([
                'promotion_code' => $request->input('promotion_code'),
                'promotion_name' => $request->input('promotion_name'),
                'promotion_long_description' => $request->input('promotion_long_description'),
                'promotion_short_description' => $request->input('promotion_short_description'),
                'overall_cut' => $request->input('overall_cut')/100,
                'promotion_start' => $request->input('promotion_start'),
                'promotion_end' => $request->input('promotion_end')
            ]);

            return redirect(route('adminpromotion').'?success=Amenity '.$request->input('submitedit').' has been edited.');

        }

        if ($request->input('addpromo') == 'addpromo') {
            $add = true;

            return view('admin/managewebsite/managepromotions')->with(compact('promotions', 'add'));
        }


        if ($request->input('submitadd') == "submitadd") {

            $request->validate([
                'promotion_code' => 'required',
                'promotion_name' => 'required',
                'promotion_long_description' => 'required',
                'promotion_short_description' => 'required',
                'overall_cut' => 'required',
                'promotion_start' => 'required',
                'promotion_end' => 'required',
                'image_name' => 'required|image|mimes:jpg,png,jpeg,gif,svg'

            ]);

            $filenameWithExt = $request->file('image_name');
            $filenameWithExt = $filenameWithExt->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image_name')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->file('image_name')->move(public_path('/images'), $fileNameToStore);

            DB::table('promotion_descriptions')
            ->insert([
                'promotion_code' => $request->input('promotion_code'),
                'promotion_name' => $request->input('promotion_name'),
                'promotion_long_description' => $request->input('promotion_long_description'),
                'promotion_short_description' => $request->input('promotion_short_description'),
                'overall_cut' => $request->input('overall_cut')/100,
                'promotion_start' => $request->input('promotion_start'),
                'promotion_end' => $request->input('promotion_end'),
                'image_name' => $fileNameToStore
            ]);

            return redirect('admin/addamenity?success=Amenity '.$request->input('amenityid').' has been created.');

        }





        return redirect(route('adminpromotion'));

    }
}
