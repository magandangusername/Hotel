<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRateAddController extends Controller
{
    public function index (){
        $rates = DB::table('rate_descriptions')
        ->get();

        return view('admin/managewebsite/managerate')->with(compact('rates'));

    }


    public function modifyrates(Request $request)
    {
        $rates = DB::table('rate_descriptions')
            ->get();


        if ($request->input('deleterate') !== null) {
            DB::table('rate_descriptions')
                ->where('rate_name', $request->input('deleterate'))
                ->delete();

            return redirect(route('adminrate').'?success=Rate has been deleted.');
        }

        if ($request->input('editrate') !== null) {
            $editrate = DB::table('rate_descriptions')
                ->where('rate_name', $request->input('editrate'))
                ->first();
            $edit = true;



            return view('admin/managewebsite/managerate')->with(compact('rates', 'editrate', 'edit'));

        }


        if ($request->input('submitedit') !== null) {
            $request->validate([
                'rate_name' => 'required',
                'base_discount' => 'required',
                'service_rate' => 'required',
                'city_tax' => 'required',
                'vat' => 'required'

            ]);

            $original_image = DB::table('gallery_photos')
                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                ->leftJoin('rate_descriptions', 'rate_descriptions.album_id', '=', 'gallery_albums.album_id')
                ->where('rate_descriptions.rate_name', $request->input('submitedit'))
                ->get();

            if ($request->hasFile('image1')) {
                $filenameWithExt = $request->file('image1')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image1')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $request->file('image1')->move(public_path('/images'), $fileNameToStore);

                DB::table('gallery_photos')
                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                ->leftJoin('rate_descriptions', 'rate_descriptions.album_id', '=', 'gallery_albums.album_id')
                ->where('rate_descriptions.rate_name', $request->input('submitedit'))
                ->where('gallery_photos.photo_name', $original_image[0]->photo_name)
                ->update(['gallery_photos.photo_name' => $fileNameToStore]);

            } // Else add a dummy image
            else {
                $fileNameToStore = 'logo.png';
            }

            DB::table('rate_descriptions')
            ->leftJoin('gallery_albums', 'rate_descriptions.rate_name', '=', 'gallery_albums.album_name')
            ->where('rate_descriptions.rate_name', $request->input('submitedit'))
            ->update([
                'rate_descriptions.rate_name' => $request->input('rate_name'),
                'rate_descriptions.rate_offer1' => $request->input('rate_offer1'),
                'rate_descriptions.rate_offer2' => $request->input('rate_offer2'),
                'rate_descriptions.rate_offer3' => $request->input('rate_offer3'),
                'rate_descriptions.base_discount' => $request->input('base_discount') / 100,
                'rate_descriptions.service_rate' => $request->input('service_rate') / 100,
                'rate_descriptions.city_tax' => $request->input('city_tax') / 100,
                'rate_descriptions.vat' => $request->input('vat') / 100
            ]);

            return redirect('admin/addrate?success=Rate successfully edited.');
        }

        if($request->input('addrate') == 'addrate'){
            $add = true;

            return view('admin/managewebsite/managerate')->with(compact('rates', 'add'));
        }

        if ($request->input('submitadd') == 'submitadd') {
            $request->validate([
                'rate_name' => 'required',
                'rate_offer1' => 'required',
                'rate_offer2' => 'required',
                'rate_offer3' => 'required',
                'base_discount' => 'required',
                'service_rate' => 'required',
                'city_tax' => 'required',
                'vat' => 'required',
                'image1' => 'required|image|mimes:jpg,png,jpeg,gif,svg'

            ]);

            $rate_duplicate = DB::table('rate_descriptions')
            ->where('rate_name', $request->input('rate_name'))
            ->count();

            if($rate_duplicate = 0){
                return redirect('admin/addrate?error=Rate already exists.');
            }

            $filenameWithExt = $request->file('image1');
            $filenameWithExt = $filenameWithExt->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image1')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->file('image1')->move(public_path('/images'), $fileNameToStore);

            DB::table('gallery_albums')
            ->insert([
                'album_name' => $request->input('rate_name')
            ]);

            $album_id = DB::table('gallery_albums')
            ->where('album_name', $request->input('rate_name'))
            ->first();

            $album_id = $album_id->album_id;

            DB::table('gallery_photos')
            ->insert([
                'photo_name' => $fileNameToStore,
                'album_id' => $album_id
            ]);

            DB::table('rate_descriptions')
            ->insert([
                'rate_descriptions.rate_name' => $request->input('rate_name'),
                'rate_descriptions.rate_offer1' => $request->input('rate_offer1'),
                'rate_descriptions.rate_offer2' => $request->input('rate_offer2'),
                'rate_descriptions.rate_offer3' => $request->input('rate_offer3'),
                'rate_descriptions.base_discount' => $request->input('base_discount') / 100,
                'rate_descriptions.service_rate' => $request->input('service_rate') / 100,
                'rate_descriptions.city_tax' => $request->input('city_tax') / 100,
                'rate_descriptions.vat' => $request->input('vat') / 100,
                'album_id' => $album_id
            ]);


            return redirect('admin/addrate?success=Rate successfully added.');
        }

        return redirect('admin/addrate');
    }
}
