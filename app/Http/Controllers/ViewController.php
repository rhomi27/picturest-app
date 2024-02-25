<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Notifikasi;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    //
    public function index()
    {
        $bg = 'bg-slate-800';
        $title = 'Picturest';
        return view("index", compact("bg", "title"));
    }
    public function search(Request $request)
    {
        $bg = 'bg-white';
        $title = 'Picturest | Search';
        $post = Post::latest()->paginate(16);
        $data = '';
        if ($request->ajax()) {
            $data .= view("page.posts.read", compact("post"));
            return $data;
        }
        return view("guest.search", compact("bg", "title", "post"));
    }

    public function searchImage(Request $request)
    {
        $post = Post::where('status', 'aktif')
            ->where(function ($query) use ($request) {
                $query->where("judul", "like", "%" . $request->search_string . "%")
                    ->orWhere("deskripsi", "like", "%" . $request->search_string . "%")
                    ->orWhere("tag", "like", "%" . $request->search_string . "%");
            })
            ->orderBy('id', 'desc')
            ->paginate(16);


        if ($post->count() >= 1) {
            return view('page.posts.read', compact('post'));
        } else if ($post->count() <= 1) {
            return response()->json([
                'status' => 400,
                'pesan' => "Data tidak ditemukan"
            ]);
        }
    }

    public function detail($id)
    {
        $bg = "white";
        $data = Post::find($id);
        $user = User::where('id', $data->user_id)->first();
        $like = Like::with(['users', 'posts'])->where('post_id', $id)->get();
        $comen = Comment::with(['users', 'posts'])->where('post_id', $id)->get();
        $postUser = Post::where('user_id', $user->id)->get();
        $title = "Picturest | Detail-$data->judul";
        $navTitle = "Detail Postingan";
        return view(
            "guest.detail-guest",
            compact("bg", "title", "navTitle", "data", "user", "like", "comen", "postUser")
        );
    }


    public function notif()
    {
        $bg = "white";
        $title = "Picturest | Notifikasi";
        $user = auth()->user();
        $notifikasi = Notifikasi::where('to', $user->id)->latest()->get();
        return view("page.notifikasi", compact("bg", "title", "notifikasi"));
    }


    public function readNotif(Request $request)
    {
        $idNotif = $request->id;
        $notif = Notifikasi::find($idNotif);
        $notif->status = 'read';
        $notif->save();
        return response()->json([
            'status' => 200,
            'message' => 'notif dibaca'
        ]);

    }
    public function delete($id)
    {
        $notif = Notifikasi::find($id);
        $notif->delete();
        return response()->json([
            'status' => 200,
            'message' => 'notif di hapus'
        ]);

    }

    public function readAllNotif()
    {
        $userId = auth()->user()->id;
        Notifikasi::where('to', $userId)->update(['status' => 'read']);
        return response()->json([
            'status' => 200,
            'message' => 'Semua notif telah dibaca'
        ]);
    }

    public function deleteAll()
    {
        $userId = auth()->user()->id;
        Notifikasi::where('to', $userId)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Semua notif telah di hapus'
        ]);
    }



}
