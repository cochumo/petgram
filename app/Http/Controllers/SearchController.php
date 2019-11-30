<?php

namespace App\Http\Controllers;

use App\User;
use App\Tag;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;

class SearchController extends Controller
{
    /**
     * 自分の投稿
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mypost()
    {
        $photos = Photo::where('user_id', Auth::id())->simplePaginate(8);

        return view('search/mypost', [
            'photos' => $photos,
        ]);
    }

    /**
     * リアクションした投稿
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function collection()
    {
        $photos = Photo::query()
            ->whereReactedBy(Auth::user())
            ->simplePaginate(8);

        return view('search/collection', [
            'photos' => $photos,
        ]);
    }

    /**
     * タグの検索
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tag(Tag $tag)
    {
        $photos = $tag->photos()->latest()->simplePaginate(8);

        return view('search/tag', [
            'tag' => $tag,
            'photos' => $photos,
        ]);
    }

    /**
     * ユーザーの検索
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user(User $user)
    {
        $photos = $user->photos()->latest()->simplePaginate(8);

        return view('search/user', [
            'user' => $user,
            'photos' => $photos,
        ]);
    }
}
