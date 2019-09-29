<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotosRequest;
use App\Photo;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function index()
    {
        $photos = Photo::all();

        return view('photos/index', [
            'photos' => $photos,
        ]);
    }

    public function showCreateForm()
    {
        return view('photos/create');
    }

    public function confirm(PhotosRequest $request)
    {
//        dd($request);

        $imagefile = $request->file('photo');

//        dd($imagefile);
        $temp_path = $imagefile->store('public/temp');
        $temp_filename = str_replace('public/temp/', '', $temp_path);
        $read_temp_path = str_replace('public/', 'storage/', $temp_path);
//        dd($read_temp_path);

        $data = array(
            'temp_path' => $temp_path,
            'read_temp_path' => $read_temp_path,
            'temp_filename' => $temp_filename,
        );

        $request->session()->put('data', $data);


        return view('photos/create_confirm', compact('data'));
    }

    public function create()
    {

    }
}
