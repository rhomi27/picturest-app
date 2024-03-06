<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //
    public function follow(Request $request, $userId)
    {
        $userToFollow = User::findOrFail($userId);
        $isFollowing = auth()->user()->following()->where('following_id', $userId)->exists();

        if ($isFollowing) {
            auth()->user()->following()->detach($userId);

            if (auth()->id() !== $userId) {
                $notif = [
                    'from' => auth()->user()->id,
                    'to' => $userId,
                    'msg' => "berhenti mengikuti anda",
                ];
                Notifikasi::create($notif);
            }
        } else {
            auth()->user()->following()->attach($userId);
             
            if (auth()->id() !== $userId) {
                $notif = [
                    'from' => auth()->user()->id,
                    'to' => $userId,
                    'msg' => "mulai mengikuti anda ❤️",
                ];
                Notifikasi::create($notif);
            }
        }

        $followerCount = $userToFollow->followers()->count();

        return response()->json([
            'following' => !$isFollowing,
            'followerCount' => $followerCount,
        ]);
    }

    public function followers(User $user){
        $user = User::where('uuid', $user->uuid)->first();
        $follower = $user->followers()->get();
        $bg = "white";
        $title = "Picturest | Followers";
        return view("page.users.followers", compact("title","bg","follower","user"));
    }

    public function following(User $user){
        $user = User::where('uuid', $user->uuid)->first();
        $following = $user->following()->get();
        $bg = "white";
        $title = "Picturest | Following";
        return view("page.users.following", compact("title","bg","user","following"));
    }



}
