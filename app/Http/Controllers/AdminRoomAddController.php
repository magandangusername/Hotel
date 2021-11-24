<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoomAddController extends Controller
{
    public function index()
    {

        $rooms = DB::table('room_descriptions')
            // ->leftJoin('gallery_albums', 'room_descriptions.album_id', '=', 'gallery_albums.album_id')
            // ->leftJoin('gallery_photos', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
            ->leftJoin('amenities', 'room_descriptions.amenities_number', '=', 'amenities.amenities_number')
            ->get();

        $amenities = DB::table('amenities')
            ->get();

        return view('admin/managewebsite/managerooms')->with(compact('rooms', 'amenities'));
    }

    public function modifyrooms(Request $request)
    {

        $rooms = DB::table('room_descriptions')
            ->leftJoin('amenities', 'room_descriptions.amenities_number', '=', 'amenities.amenities_number')
            ->get();

        $amenities = DB::table('amenities')
            ->get();


        if ($request->input('deleteroom') !== null) {
            DB::table('room_descriptions')
                ->where('room_name', $request->input('deleteroom'))
                ->delete();

            return redirect('admin/addroom?success=Room has been deleted.');
        }

        if ($request->input('editroom') !== null) {
            $editroom = DB::table('room_descriptions')
                ->where('room_name', $request->input('editroom'))
                ->first();
            $edit = true;



            return view('admin/managewebsite/managerooms')->with(compact('rooms', 'amenities', 'editroom', 'edit'));
            // return redirect('admin/addroom?success=Room successfully edited.');
        }


        if ($request->input('submitedit') !== null) {
            $original_image = DB::table('gallery_photos')
                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                ->leftJoin('room_descriptions', 'room_descriptions.album_id', '=', 'gallery_albums.album_id')
                ->where('room_descriptions.room_name', $request->input('submitedit'))
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
                $request->file('image1')->storeAs('public/image', $fileNameToStore);
                DB::table('gallery_photos')
                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                ->leftJoin('room_descriptions', 'room_descriptions.album_id', '=', 'gallery_albums.album_id')
                ->where('room_descriptions.room_name', $request->input('submitedit'))
                ->where('gallery_photos.photo_name', $original_image[0]->photo_name)
                ->update(['gallery_photos.photo_name' => $fileNameToStore]);

            } // Else add a dummy image
            else {
                $fileNameToStore = 'logo.png';
            }

            $validatedData = $request->validate([
                'test' => 'required|image|mimes:jpg,png,jpeg,gif,svg',

               ]);
            // if ($request->hasFile('image2')) {
                $filenameWithExt = $request->file('image2');
                $filenameWithExt = $filenameWithExt->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image2')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $request->file('image2')->storeAs('public/image', $fileNameToStore);

                dd('image2');


                DB::table('gallery_photos')
                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                ->leftJoin('room_descriptions', 'room_descriptions.album_id', '=', 'gallery_albums.album_id')
                ->where('room_descriptions.room_name', $request->input('submitedit'))
                ->where('gallery_photos.photo_name', $original_image[1]->photo_name)
                ->update(['gallery_photos.photo_name' => $fileNameToStore]);
            // }
            // else {
            //     $fileNameToStore2 = 'logo.png';
            // }

            if ($request->hasFile('image3')) {
                $filenameWithExt = $request->file('image3')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image3')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $request->file('image3')->storeAs('public/image', $fileNameToStore);

                DB::table('gallery_photos')
                ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                ->leftJoin('room_descriptions', 'room_descriptions.album_id', '=', 'gallery_albums.album_id')
                ->where('room_descriptions.room_name', $request->input('submitedit'))
                ->where('gallery_photos.photo_name', $original_image[2]->photo_name)
                ->update(['gallery_photos.photo_name' => $fileNameToStore]);
            }
            else {
                $fileNameToStore3 = 'logo.png';
            }

            $beds = '';
            if($request->has('king_bed')){
                $beds = $beds.'K';
            }
            if($request->has('queen_bed')){
                $beds = $beds.'Q';
            }

            DB::table('room_descriptions')
            ->leftJoin('amenities', 'room_descriptions.amenities_number', '=', 'amenities.amenities_number')
            ->where('room_descriptions.room_name', $request->input('submitedit'))
            ->update([
                'room_descriptions.room_name' => $request->input('room_name'),
                'room_descriptions.room_long_description' => $request->input('room_long_description'),
                'room_descriptions.room_short_description' => $request->input('room_short_description'),
                'room_descriptions.room_size' => $request->input('room_size'),
                'room_descriptions.base_price' => $request->input('base_price'),
                'room_descriptions.bed_type' => $beds,
                'room_descriptions.amenities_number' => $request->input('amenities_number')
            ]);

            return redirect('admin/addroom?success=Room successfully edited.');
        }






        // return view('admin/managewebsite/managerooms')->with(compact('rooms', 'amenities'));
        return redirect('admin/addroom');
    }
}
