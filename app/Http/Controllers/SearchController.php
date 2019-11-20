<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function mypost()
    {
        $photos = Photo::where('user_id', Auth::id())->simplePaginate(8);

        return view('search/mypost', [
            'photos' => $photos,
        ]);
    }
}
