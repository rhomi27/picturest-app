<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Notifikasi;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function like(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $liked = $post->likes()->where('user_id', auth()->id())->exists();

        if ($liked) {
            $post->likes()->where('user_id', auth()->id())->delete();
        } else {
            $post->likes()->create(['user_id' => auth()->id()]);
            
            if (auth()->id() !== $post->user_id) {
                $notif = [
                    'from' => auth()->user()->id,
                    'to' => $post->user_id,
                    'msg' => "menyukai postingan anda 💙",
                    'post_id' => $post->id,
                ];
                Notifikasi::create($notif);
            }
        }
        $jmlLike = $post->likes()->count();

        return response()->json([
            'liked' => !$liked,
            'countLike' => $jmlLike,
        ]);
    }
}
