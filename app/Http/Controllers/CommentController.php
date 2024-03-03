<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //
    public function read($id){
        $comen = Comment::with(['users','posts'])->where('post_id',$id)->latest()->paginate(5);
        return view('page.posts.detail.comment.read',compact('comen'));
    }
    public function commen(Request $request,$postId){
        $validator = Validator::make(request()->all(), [
            'isi_komen' => 'required|',
        ],[
            'isi_komen.required'=> 'kolom harus diisi',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors'=> $validator->errors(),
            ]);
        } else {
            $data = [
                'post_id'=> $postId,
                'isi_komen' => $request->isi_komen,
                'user_id' => auth()->user()->id,
            ];
            Comment::create($data);
            $post = Post::find($postId);
            if (auth()->id() !== $post->user_id) {
                $notif = [
                    'from' => auth()->user()->id,
                    'to' => $post->user_id,
                    'msg' => "mengomentari postingan anda 💬",
                    'post_id' => $post->id,
                ];
                Notifikasi::create($notif);
            }
            return response()->json([
                'status'=> 200,
                'message'=> 'berhasil komentar',
            ]);
        }
    }
}
