<?php

namespace App\Http\Controllers\Photo;

use App\Photo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;

class ReactionController extends Controller
{
    public function create(Request $request)
    {
        $ajax = json_decode($request->getContent(), true);
//        Log::debug($ajax);

        $user = User::find($ajax['user_id']);
        $photo = Photo::find($ajax['photo_id']);
        $reaction = $ajax['reaction'];
        Log::debug($user);

        $reactionType = ReactionType::fromName($reaction);
//        Log::debug($reactionType);

        if ($user->isNotRegisteredAsLoveReacter()) {
            $user->registerAsLoveReacter();
        }
        if ($photo->isNotRegisteredAsLoveReactant()) {
            $photo->registerAsLoveReactant();
        }

        $reacter = $user->getLoveReacter();
        $reactant = $photo->getLoveReactant();

        Log::debug($reacter->hasReactedTo($reactant, $reactionType));

        // 該当のリアクションを既にしていないか確認し、リアクション
        if ($reacter->hasReactedTo($reactant, $reactionType)) {
            $reacter->reactTo($reactant, $reactionType);
        }
    }

    public function destroy(Request $request)
    {
        //
    }
}
