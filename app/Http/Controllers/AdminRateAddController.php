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
                'rate_offer1' => 'required',
                'rate_offer2' => 'required',
                'rate_offer3' => 'required',
                'base_discount' => 'required',
                'service_rate' => 'required',
                'city_tax' => 'required',
                'vat' => 'image|mimes:jpg,png,jpeg,gif,svg',
                'image1' => 'image|mimes:jpg,png,jpeg,gif,svg',
                'image2' => 'image|mimes:jpg,png,jpeg,gif,svg',
                'image3' => 'image|mimes:jpg,png,jpeg,gif,svg'

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
                ->update(['gallery_photos.photo_name' => $fileNameToStore,
                'rate_descriptions.image_name' => $fileNameToStore]);

            } // Else add a dummy image
            else {
                $fileNameToStore = 'logo.png';
            }


            if ($request->hasFile('image2')) {
                $filenameWithExt = $request->file('image2');
                $filenameWithExt = $filenameWithExt->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image2')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $request->file('image2')->move(public_path('/images'), $fileNameToStore);




                DB::table('gallery_photos')
                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                ->leftJoin('rate_descriptions', 'rate_descriptions.album_id', '=', 'gallery_albums.album_id')
                ->where('rate_descriptions.rate_name', $request->input('submitedit'))
                ->where('gallery_photos.photo_name', $original_image[1]->photo_name)
                ->update(['gallery_photos.photo_name' => $fileNameToStore]);
            }
            else {
                $fileNameToStore2 = 'logo.png';
            }

            if ($request->hasFile('image3')) {
                $filenameWithExt = $request->file('image3')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image3')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $request->file('image3')->move(public_path('/images'), $fileNameToStore);

                DB::table('gallery_photos')
                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                ->leftJoin('rate_descriptions', 'rate_descriptions.album_id', '=', 'gallery_albums.album_id')
                ->where('rate_descriptions.rate_name', $request->input('submitedit'))
                ->where('gallery_photos.photo_name', $original_image[2]->photo_name)
                ->update(['gallery_photos.photo_name' => $fileNameToStore]);
            }
            else {
                $fileNameToStore3 = 'logo.png';
            }

            $beds = join($request->input('beds'));

            DB::table('rate_descriptions')
            ->leftJoin('amenities', 'rate_descriptions.amenities_number', '=', 'amenities.amenities_number')
            ->leftJoin('gallery_albums', 'rate_descriptions.rate_name', '=', 'gallery_albums.album_name')
            ->where('rate_descriptions.rate_name', $request->input('submitedit'))
            ->update([
                'rate_descriptions.rate_name' => $request->input('rate_name'),
                'rate_descriptions.rate_long_description' => $request->input('rate_long_description'),
                'rate_descriptions.rate_short_description' => $request->input('rate_short_description'),
                'rate_descriptions.rate_size' => $request->input('rate_size'),
                'rate_descriptions.base_price' => $request->input('base_price'),
                'rate_descriptions.bed_type' => $beds,
                'rate_descriptions.amenities_number' => $request->input('amenities_number'),
                'gallery_albums.album_name' => $request->input('rate_name')
            ]);

            return redirect('admin/addrate?success=Rate successfully edited.');
        }

        if($request->input('addrate') == 'addrate'){
            $add = true;

            return view('admin/managewebsite/managerate')->with(compact('rates', 'amenities', 'add'));
        }

        if ($request->input('submitadd') == 'submitadd') {
            $request->validate([
                'rate_name' => 'required',
                'rate_long_description' => 'required',
                'rate_short_description' => 'required',
                'rate_size' => 'required',
                'base_price' => 'required',
                'beds' => 'required',
                'amenities_number' => 'required',
                'image1' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'image2' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'image3' => 'required|image|mimes:jpg,png,jpeg,gif,svg'

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

            $filenameWithExt = $request->file('image2');
            $filenameWithExt = $filenameWithExt->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image2')->getClientOriginalExtension();
            $fileNameToStore2 = $filename . '_' . time() . '.' . $extension;
            $request->file('image2')->move(public_path('/images'), $fileNameToStore2);

            $filenameWithExt = $request->file('image3');
            $filenameWithExt = $filenameWithExt->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image3')->getClientOriginalExtension();
            $fileNameToStore3 = $filename . '_' . time() . '.' . $extension;
            $request->file('image3')->move(public_path('/images'), $fileNameToStore3);



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
            DB::table('gallery_photos')
            ->insert([
                'photo_name' => $fileNameToStore2,
                'album_id' => $album_id
            ]);
            DB::table('gallery_photos')
            ->insert([
                'photo_name' => $fileNameToStore3,
                'album_id' => $album_id
            ]);

            DB::table('rate_descriptions')
            ->insert([
                'rate_name' => $request->input('rate_name'),
                'image_name' => $fileNameToStore,
                'rate_long_description' => $request->input('rate_long_description'),
                'rate_short_description' => $request->input('rate_short_description'),
                'rate_size' => $request->input('rate_size'),
                'base_price' => $request->input('base_price'),
                'bed_type' => join($request->input('beds')),
                'amenities_number' => $request->input('amenities_number'),
                'album_id' => $album_id
            ]);


            return redirect('admin/addrate?success=Rate successfully added.');
        }

        return redirect('admin/addrate');
    }
}
