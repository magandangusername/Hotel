<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSuiteAddController extends Controller
{
    public function index (){
        $rooms = DB::table('suite_descriptions')
            ->leftJoin('amenities', 'suite_descriptions.amenities_number', '=', 'amenities.amenities_number')
            ->get();

        $amenities = DB::table('amenities')
            ->get();

        return view('admin/managewebsite/managesuite')->with(compact('rooms', 'amenities'));

    }

    public function modifysuites(Request $request)
    {
        $rooms = DB::table('suite_descriptions')
            ->leftJoin('amenities', 'suite_descriptions.amenities_number', '=', 'amenities.amenities_number')
            ->get();

        $amenities = DB::table('amenities')
            ->get();


        if ($request->input('deleteroom') !== null) {
            DB::table('suite_descriptions')
                ->where('suite_name', $request->input('deleteroom'))
                ->delete();

            return redirect('admin/addsuite?success=Suite has been deleted.');
        }

        if ($request->input('editroom') !== null) {
            $editroom = DB::table('suite_descriptions')
                ->where('suite_name', $request->input('editroom'))
                ->first();
            $edit = true;



            return view('admin/managewebsite/managesuite')->with(compact('rooms', 'amenities', 'editroom', 'edit'));

        }


        if ($request->input('submitedit') !== null) {
            $request->validate([
                'suite_name' => 'required',
                'suite_long_description' => 'required',
                'suite_short_description' => 'required',
                'suite_size' => 'required',
                'base_price' => 'required',
                'beds' => 'required',
                'amenities_number' => 'required',
                'image1' => 'image|mimes:jpg,png,jpeg,gif,svg',
                'image2' => 'image|mimes:jpg,png,jpeg,gif,svg',
                'image3' => 'image|mimes:jpg,png,jpeg,gif,svg'

            ]);
            // dd(join($request->input('beds')));
            $original_image = DB::table('gallery_photos')
                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                ->leftJoin('suite_descriptions', 'suite_descriptions.album_id', '=', 'gallery_albums.album_id')
                ->where('suite_descriptions.suite_name', $request->input('submitedit'))
                ->get();

            if ($request->hasFile('image1')) {
                $filenameWithExt = $request->file('image1')->getClientOriginalName();

                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

                // Get just Extension
                $extension = $request->file('image1')->getClientOriginalExtension();

                // Filename To store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                // Upload Image$path =
                $request->file('image1')->move(public_path('/images'), $fileNameToStore);
                DB::table('gallery_photos')
                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                ->leftJoin('suite_descriptions', 'suite_descriptions.album_id', '=', 'gallery_albums.album_id')
                ->where('suite_descriptions.suite_name', $request->input('submitedit'))
                ->where('gallery_photos.photo_name', $original_image[0]->photo_name)
                ->update(['gallery_photos.photo_name' => $fileNameToStore,
                'suite_descriptions.image_name' => $fileNameToStore]);

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
                ->leftJoin('suite_descriptions', 'suite_descriptions.album_id', '=', 'gallery_albums.album_id')
                ->where('suite_descriptions.suite_name', $request->input('submitedit'))
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
                ->leftJoin('suite_descriptions', 'suite_descriptions.album_id', '=', 'gallery_albums.album_id')
                ->where('suite_descriptions.suite_name', $request->input('submitedit'))
                ->where('gallery_photos.photo_name', $original_image[2]->photo_name)
                ->update(['gallery_photos.photo_name' => $fileNameToStore]);
            }
            else {
                $fileNameToStore3 = 'logo.png';
            }

            $beds = join($request->input('beds'));

            DB::table('suite_descriptions')
            ->leftJoin('amenities', 'suite_descriptions.amenities_number', '=', 'amenities.amenities_number')
            ->leftJoin('gallery_albums', 'suite_descriptions.suite_name', '=', 'gallery_albums.album_name')
            ->where('suite_descriptions.suite_name', $request->input('submitedit'))
            ->update([
                'suite_descriptions.suite_name' => $request->input('suite_name'),
                'suite_descriptions.suite_long_description' => $request->input('suite_long_description'),
                'suite_descriptions.suite_short_description' => $request->input('suite_short_description'),
                'suite_descriptions.suite_size' => $request->input('suite_size'),
                'suite_descriptions.base_price' => $request->input('base_price'),
                'suite_descriptions.bed_type' => $beds,
                'suite_descriptions.amenities_number' => $request->input('amenities_number'),
                'gallery_albums.album_name' => $request->input('suite_name')
            ]);

            return redirect('admin/addsuite?success=Suite successfully edited.');
        }

        if($request->input('addsuite') == 'addsuite'){
            $add = true;

            return view('admin/managewebsite/managesuite')->with(compact('rooms', 'amenities', 'add'));
        }

        if ($request->input('submitadd') == 'submitadd') {
            $request->validate([
                'suite_name' => 'required',
                'suite_long_description' => 'required',
                'suite_short_description' => 'required',
                'suite_size' => 'required',
                'base_price' => 'required',
                'beds' => 'required',
                'amenities_number' => 'required',
                'image1' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'image2' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'image3' => 'required|image|mimes:jpg,png,jpeg,gif,svg'

            ]);

            $suite_duplicate = DB::table('suite_descriptions')
            ->where('suite_name', $request->input('suite_name'))
            ->count();

            if($suite_duplicate = 0){
                return redirect('admin/addsuite?error=Suite already exists.');
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
                'album_name' => $request->input('suite_name')
            ]);

            $album_id = DB::table('gallery_albums')
            ->where('album_name', $request->input('suite_name'))
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

            DB::table('suite_descriptions')
            ->insert([
                'suite_name' => $request->input('suite_name'),
                'image_name' => $fileNameToStore,
                'suite_long_description' => $request->input('suite_long_description'),
                'suite_short_description' => $request->input('suite_short_description'),
                'suite_size' => $request->input('suite_size'),
                'base_price' => $request->input('base_price'),
                'bed_type' => join($request->input('beds')),
                'amenities_number' => $request->input('amenities_number'),
                'album_id' => $album_id
            ]);


            return redirect('admin/addsuite?success=Suite successfully added.');
        }

        return redirect('admin/addsuite');
    }
}

