<?php

namespace App\Http\Controllers;

use App\User;
use App\Tag;
use App\Photo;
use Illuminate\Http\Request;
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

    public function collection()
    {
        $user = Auth::user();
        $reacter = $user->getLoveReacter();
    }

    public function tag(Tag $tag)
    {
        $photos = $tag->photos()->latest()->simplePaginate(8);

        return view('search/tag', [
            'tag' => $tag,
            'photos' => $photos,
        ]);
    }

    public function user(User $user)
    {
        $photos = $user->photos()->latest()->simplePaginate(8);

        return view('search/user', [
            'user' => $user,
            'photos' => $photos,
        ]);
    }
}
