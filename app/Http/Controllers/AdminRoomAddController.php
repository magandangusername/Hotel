<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoomAddController extends Controller
{
    public function index (){

        $rooms = DB::table('room_descriptions')
        ->leftJoin('gallery_albums', 'room_descriptions.album_id', '=', 'gallery_albums.album_id')
        ->leftJoin('gallery_photos', 'gallery_albums.album_id', '=', 'gallery_photos.album_id')
        ->get();

        return view('admin/managewebsite/managerooms');

    }
}
