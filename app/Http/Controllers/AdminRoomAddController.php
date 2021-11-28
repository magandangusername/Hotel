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

            DB::table('room_statuses')
            ->where('room_suite_name', $request->input('deletesuite'))
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
            $request->validate([
                'room_name' => 'required',
                'room_long_description' => 'required',
                'room_short_description' => 'required',
                'room_size' => 'required',
                'base_price' => 'required',
                'amenities_number' => 'required',
                'image1' => 'image|mimes:jpg,png,jpeg,gif,svg',
                'image2' => 'image|mimes:jpg,png,jpeg,gif,svg',
                'image3' => 'image|mimes:jpg,png,jpeg,gif,svg'

            ]);

            $duplicate_checker = DB::table('room_descriptions')
            ->where('room_name', $request->input('room_name'))
            ->count();

            if ($duplicate_checker > 1) {
                return redirect('admin/addroom?error=Room name already exists.');
            }

            $bedtypes = '';

            if ($request->input('King_bed_count') <= 0 && $request->input('Queen_bed_count') <= 0) {
                return redirect('admin/addroom?error=Room must have atleast 1 King/Queen bed room.');
            }



            if ($request->input('King_bed_count') > 0) {
                $bedtypes = $bedtypes . 'K';
            }

            if ($request->input('Queen_bed_count') > 0) {
                $bedtypes = $bedtypes . 'Q';

            }


            // dd(join($request->input('beds')));
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
                $request->file('image1')->move(public_path('/images'), $fileNameToStore);
                DB::table('gallery_photos')
                    ->leftJoin('gallery_albums', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
                    ->leftJoin('room_descriptions', 'room_descriptions.album_id', '=', 'gallery_albums.album_id')
                    ->where('room_descriptions.room_name', $request->input('submitedit'))
                    ->where('gallery_photos.photo_name', $original_image[0]->photo_name)
                    ->update([
                        'gallery_photos.photo_name' => $fileNameToStore,
                        'room_descriptions.image_name' => $fileNameToStore
                    ]);
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
                    ->leftJoin('room_descriptions', 'room_descriptions.album_id', '=', 'gallery_albums.album_id')
                    ->where('room_descriptions.room_name', $request->input('submitedit'))
                    ->where('gallery_photos.photo_name', $original_image[1]->photo_name)
                    ->update(['gallery_photos.photo_name' => $fileNameToStore]);
            } else {
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
                    ->leftJoin('room_descriptions', 'room_descriptions.album_id', '=', 'gallery_albums.album_id')
                    ->where('room_descriptions.room_name', $request->input('submitedit'))
                    ->where('gallery_photos.photo_name', $original_image[2]->photo_name)
                    ->update(['gallery_photos.photo_name' => $fileNameToStore]);
            } else {
                $fileNameToStore3 = 'logo.png';
            }

            // $beds = join($request->input('beds'));

            DB::table('room_descriptions')
                ->leftJoin('amenities', 'room_descriptions.amenities_number', '=', 'amenities.amenities_number')
                ->leftJoin('gallery_albums', 'room_descriptions.room_name', '=', 'gallery_albums.album_name')
                ->where('room_descriptions.room_name', $request->input('submitedit'))
                ->update([
                    'room_descriptions.room_name' => $request->input('room_name'),
                    'room_descriptions.room_long_description' => $request->input('room_long_description'),
                    'room_descriptions.room_short_description' => $request->input('room_short_description'),
                    'room_descriptions.room_size' => $request->input('room_size'),
                    'room_descriptions.base_price' => $request->input('base_price'),
                    'room_descriptions.bed_type' => $bedtypes,
                    'room_descriptions.amenities_number' => $request->input('amenities_number'),
                    'gallery_albums.album_name' => $request->input('room_name')
                ]);

            DB::table('room_statuses')
            ->where('room_suite_name', $request->input('submitedit'))
            ->update(['room_suite_name' => $request->input('room_name')]);



            if ($request->input('King_bed_count') > 0) {

                $kingbeds = DB::table('room_statuses')
                    ->where('room_suite_name', $request->input('room_name'))
                    ->where('room_suite_bed', 'King Bed')
                    ->count();

                if ($kingbeds > $request->input('King_bed_count')) {
                    $removebedcount = $kingbeds - $request->input('King_bed_count');

                    $availablebedscount = DB::table('room_statuses')
                        ->where('room_suite_name', $request->input('room_name'))
                        ->where('room_suite_bed', 'King Bed')
                        ->where('status', 0)
                        ->count();

                    if ($removebedcount > $availablebedscount) {
                        return redirect('admin/addroom?error=Some rooms with king beds are still being used. Room removal unsuccessful.');
                    }


                    DB::table('room_statuses')
                        ->where('room_suite_name', $request->input('room_name'))
                        ->where('room_suite_bed', 'King Bed')
                        ->where('status', 0)
                        ->limit($removebedcount)
                        ->delete();
                } elseif ($kingbeds < $request->input('King_bed_count')) {
                    $addbedcount = $request->input('King_bed_count') - $kingbeds;

                    for ($i = 0; $i < $addbedcount; $i++) {
                        $totalrooms = DB::table('room_statuses')
                            ->count();

                        $roomid = 'R-' . $totalrooms;


                        while (true) {
                            $checkroomid = DB::table('room_statuses')
                                ->where('room_number', $roomid)
                                ->count();
                            if ($checkroomid != 0) {
                                $totalrooms++;
                                $roomid = 'R-' . $totalrooms;
                            } else {
                                $roomid = 'R-' . $totalrooms;
                                break;
                            }
                        }

                        DB::table('room_statuses')
                        ->insert([
                            'room_number' => $roomid,
                            'status' => 0,
                            'confirmation_number' => "",
                            'room_suite_name' => $request->input('room_name'),
                            'room_suite_bed' => "King Bed",
                        ]);
                    }

                }
            }elseif ($request->input('King_bed_count') <= 0) {


                $kingbeds = DB::table('room_statuses')
                ->where('room_suite_name', $request->input('room_name'))
                ->where('room_suite_bed', 'King Bed')
                ->count();

                $availablebedscount = DB::table('room_statuses')
                    ->where('room_suite_name', $request->input('room_name'))
                    ->where('room_suite_bed', 'King Bed')
                    ->where('status', 0)
                    ->count();

                if ($kingbeds != $availablebedscount) {
                    return redirect('admin/addroom?error=Some rooms with king beds are still being used. Room removal unsuccessful.');
                } else{
                    DB::table('room_statuses')
                    ->where('room_suite_name', $request->input('room_name'))
                    ->where('room_suite_bed', 'King Bed')
                    ->where('status', 0)
                    ->delete();
                }

            }

            if ($request->input('Queen_bed_count') > 0) {

                $queenbeds = DB::table('room_statuses')
                    ->where('room_suite_name', $request->input('room_name'))
                    ->where('room_suite_bed', 'Queen Bed')
                    ->count();

                if ($queenbeds > $request->input('Queen_bed_count')) {
                    $removebedcount = $queenbeds - $request->input('Queen_bed_count');

                    $availablebedscount = DB::table('room_statuses')
                        ->where('room_suite_name', $request->input('room_name'))
                        ->where('room_suite_bed', 'Queen Bed')
                        ->where('status', 0)
                        ->count();

                    if ($removebedcount > $availablebedscount) {
                        return redirect('admin/addroom?error=Some rooms with queen beds are still being used. Room removal unsuccessful.');
                    }


                    DB::table('room_statuses')
                        ->where('room_suite_name', $request->input('room_name'))
                        ->where('room_suite_bed', 'Queen Bed')
                        ->where('status', 0)
                        ->limit($removebedcount)
                        ->delete();
                } elseif ($queenbeds < $request->input('Queen_bed_count')) {
                    $addbedcount = $request->input('Queen_bed_count') - $queenbeds;

                    for ($i = 0; $i < $addbedcount; $i++) {
                        $totalrooms = DB::table('room_statuses')
                            ->count();

                        $roomid = 'R-' . $totalrooms;


                        while (true) {
                            $checkroomid = DB::table('room_statuses')
                                ->where('room_number', $roomid)
                                ->count();
                            if ($checkroomid != 0) {
                                $totalrooms++;
                                $roomid = 'R-' . $totalrooms;
                            } else {
                                $roomid = 'R-' . $totalrooms;
                                break;
                            }
                        }
                        DB::table('room_statuses')
                        ->insert([
                            'room_number' => $roomid,
                            'status' => 0,
                            'confirmation_number' => "",
                            'room_suite_name' => $request->input('room_name'),
                            'room_suite_bed' => "Queen Bed",
                        ]);
                    }

                }
            }elseif ($request->input('queen_bed_count') <= 0) {
                $queenbeds = DB::table('room_statuses')
                ->where('room_suite_name', $request->input('room_name'))
                ->where('room_suite_bed', 'Queen Bed')
                ->count();

                $availablebedscount = DB::table('room_statuses')
                    ->where('room_suite_name', $request->input('room_name'))
                    ->where('room_suite_bed', 'Queen Bed')
                    ->where('status', 0)
                    ->count();

                if ($queenbeds != $availablebedscount) {
                    return redirect('admin/addroom?error=Some rooms with queen beds are still being used. Room removal unsuccessful.');
                } else{
                    DB::table('room_statuses')
                    ->where('room_suite_name', $request->input('room_name'))
                    ->where('room_suite_bed', 'Queen Bed')
                    ->where('status', 0)
                    ->delete();
                }

            }


            return redirect('admin/addroom?success=Room successfully edited.');
        }

        if ($request->input('addroom') == 'addroom') {
            $add = true;

            // return redirect()->route( 'adminroom' )->with('add', true);
            return view('admin/managewebsite/managerooms')->with(compact('rooms', 'amenities', 'add'));
        }

        if ($request->input('submitadd') == 'submitadd') {
            $request->validate([
                'room_name' => 'required',
                'room_long_description' => 'required',
                'room_short_description' => 'required',
                'room_size' => 'required',
                'base_price' => 'required',
                'amenities_number' => 'required',
                'image1' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'image2' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'image3' => 'required|image|mimes:jpg,png,jpeg,gif,svg'

            ]);

            $duplicate_checker = DB::table('room_descriptions')
            ->where('room_name', $request->input('room_name'))
            ->count();

            if ($duplicate_checker > 0) {
                return redirect('admin/addroom?error=Room name already exists.');
            }

            $bedtypes = '';

            if ($request->input('King_bed_count') <= 0 && $request->input('Queen_bed_count') <= 0) {
                return redirect('admin/addroom?error=Room must have atleast 1 King/Queen bed room.');
            }



            if ($request->input('King_bed_count') > 0) {
                $bedtypes = $bedtypes . 'K';
            }

            if ($request->input('Queen_bed_count') > 0) {
                $bedtypes = $bedtypes . 'Q';

            }




            $room_duplicate = DB::table('room_descriptions')
                ->where('room_name', $request->input('room_name'))
                ->count();

            if ($room_duplicate = 0) {
                return redirect('admin/addroom?error=Room already exists.');
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
                    'album_name' => $request->input('room_name')
                ]);

            $album_id = DB::table('gallery_albums')
                ->where('album_name', $request->input('room_name'))
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


            // inserts the data in room descriptions table
            DB::table('room_descriptions')
                ->insert([
                    'room_name' => $request->input('room_name'),
                    'image_name' => $fileNameToStore,
                    'room_long_description' => $request->input('room_long_description'),
                    'room_short_description' => $request->input('room_short_description'),
                    'room_size' => $request->input('room_size'),
                    'base_price' => $request->input('base_price'),
                    'bed_type' => $bedtypes,
                    'amenities_number' => $request->input('amenities_number'),
                    'album_id' => $album_id
                ]);


            // inserts the data in room statuses table
            $addbedcount = $request->input('King_bed_count');

            for ($i = 0; $i < $addbedcount; $i++) {
                $totalrooms = DB::table('room_statuses')
                    ->count();

                $roomid = 'R-' . $totalrooms;


                while (true) {
                    $checkroomid = DB::table('room_statuses')
                        ->where('room_number', $roomid)
                        ->count();
                    if ($checkroomid != 0) {
                        $totalrooms++;
                        $roomid = 'R-' . $totalrooms;
                    } else {
                        $roomid = 'R-' . $totalrooms;
                        break;
                    }
                }

                DB::table('room_statuses')
                ->insert([
                    'room_number' => $roomid,
                    'status' => 0,
                    'confirmation_number' => "",
                    'room_suite_name' => $request->input('room_name'),
                    'room_suite_bed' => "King Bed",
                ]);
            }

            $addbedcount = $request->input('Queen_bed_count');

            for ($i = 0; $i < $addbedcount; $i++) {
                $totalrooms = DB::table('room_statuses')
                    ->count();

                $roomid = 'R-' . $totalrooms;


                while (true) {
                    $checkroomid = DB::table('room_statuses')
                        ->where('room_number', $roomid)
                        ->count();
                    if ($checkroomid != 0) {
                        $totalrooms++;
                        $roomid = 'R-' . $totalrooms;
                    } else {
                        $roomid = 'R-' . $totalrooms;
                        break;
                    }
                }
                DB::table('room_statuses')
                ->insert([
                    'room_number' => $roomid,
                    'status' => 0,
                    'confirmation_number' => "",
                    'room_suite_name' => $request->input('room_name'),
                    'room_suite_bed' => "Queen Bed",
                ]);
            }










            return redirect('admin/addroom?success=Room successfully added.');
        }






        // return view('admin/managewebsite/managerooms')->with(compact('rooms', 'amenities'));
        return redirect('admin/addroom');
    }
}
