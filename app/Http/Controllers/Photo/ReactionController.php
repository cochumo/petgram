<?php

namespace App\Http\Controllers\Photo;

use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;

class ReactionController extends Controller
{
    public function reaction(Request $request)
    {
        $ajax = json_decode($request->getContent(), true);
//        Log::debug($ajax);

        $user = Auth::user();
        $photo = Photo::find($ajax['photo_id']);
        $reaction = $ajax['reaction'];
//        Log::debug($user);

        $reactionType = ReactionType::fromName($reaction);
//        Log::debug($reactionType);

        $reacter = $user->getLoveReacter();
        $reactant = $photo->getLoveReactant();

//        Log::debug($reacter->hasReactedTo($reactant, $reactionType));

        // 該当のリアクションを既にしていないか確認し、リアクション
        if ($reacter->hasNotReactedTo($reactant, $reactionType)) {
            $reacter->reactTo($reactant, $reactionType);
            $reaction_count = $photo->viaLoveReactant()->getReactionCounterOfType($reaction)->getCount();
            return response()->json(
                [
                    'message' => 'いいねしました',
                    'reaction' => $reaction,
                    'reaction_count' => $reaction_count,
                ]
            );
        } elseif ($reacter->hasReactedTo($reactant, $reactionType)) {
            $reacter->unreactTo($reactant, $reactionType);
            $reaction_count = $photo->viaLoveReactant()->getReactionCounterOfType($reaction)->getCount();
            return response()->json(
                [
                    'message' => 'いいねを解除しました',
                    'reaction' => $reaction,
                    'reaction_count' => $reaction_count,
                ]
            );
        } else {
            return response()->json(
                ['message' => 'なんらかのエラーが発生しました']
            );
        }
    }
}
