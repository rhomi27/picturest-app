<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Album;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
  //

  public function index(Request $request)
  {
    $bg = "white";
    $title = "Picturest | Home";
    $post = Post::with(['users'])->where('status', 'aktif')->latest()->paginate(12);
    $data = '';
    if ($request->ajax()) {
      $data .= view("page.posts.read", compact("post"));

      return $data;
    }
    return view("page.posts.home", compact("bg", "title", "post"));
  }

  public function mengikuti(Request $request)
  {
    $bg = "white";
    $title = "Picturest | Mengikuti";
    $user = auth()->user();
    $following = $user->following()->pluck('following_id');
    $post = Post::whereIn('user_id', $following)->where('status', 'aktif')->latest()->paginate(12);
    $data = '';
    if ($request->ajax()) {
      $data .= view("page.posts.read", compact("post"));

      return $data;
    }
    return view("page.posts.mengikuti", compact("bg", "title", "post"));
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

  public function searchImageMengikuti(Request $request)
  {
    $user = auth()->user();
    $following = $user->following()->pluck('following_id');
    $post = Post::whereIn('user_id', $following)->where('status', 'aktif')
      ->where(function ($query) use ($request) {
        $query->where("judul", "like", "%" . $request->search_string . "%")
          ->orWhere("deskripsi", "like", "%" . $request->search_string . "%")
          ->orWhere("tag", "like", "%" . $request->search_string . "%");
      })
      ->orderBy('id', 'desc')
      ->paginate(10);

    if ($post->count() >= 1) {
      return view('page.posts.read', compact('post'));
    } else if ($post->count() <= 1) {
      return response()->json([
        'status' => 400,
        'pesan' => "Data tidak ditemukan"
      ]);
    }
  }

  public function detail(Post $post)
  {
   
    try {
      $bg = "white";
      $data = Post::with('comments', 'likes', 'users')->where('status', 'aktif')->where('uuid',$post->uuid)->first();
      $postUser = Post::where('user_id', $data->users->id)->where('status', 'aktif')->get();
      $title = "Picturest | Detail-$data->judul";
      $navTitle = "Detail Postingan";
      return view("page.posts.detail", compact("bg", "title", "navTitle", "data", "postUser"));
    } catch (\Throwable $th) {
      return view("error-handling.404");
    }
  }
  public function create()
  {
    $bg = "white";
    $title = "Picturest | Unggah";
    $navTitle = "Unggah Postingan";
    $album = Album::where("user_id", auth()->user()->id)->get();
    return view("page.posts.create", compact("bg", "title", "album", "navTitle"));
  }
  public function store(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'judul' => 'required|max:25',
      'deskripsi' => 'required|max:255',
      'tag' => 'required|max:20',
      'file' => 'required|mimes:png,jpg,jpeg|image|max:5000',
    ], [
      'judul.required' => 'kolom judul harus diisi',
      'judul.max' =>  'kolom judul tidak boleh lebih dari 25 karakter',
      'deskripsi.required' => 'kolom deskripsi harus diisi',
      'deskripsi.max' =>  'kolom deskripsi tidak boleh lebih dari 255 karakter',
      'tag.required' => 'kolom tag harus diisi',
      'tag.max' =>  'kolom tag tidak boleh lebih dari 20 karakter',
      'file.required' => 'gambar harus diisi',
      'file.mimes' => 'extensi file harus png jpg jpeg',
      'file.max' =>   'gambar tidak boleh lebih dari 5 mb'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status' => 400,
        'errors' => $validator->errors()
      ]);

    } else {
      $photo = $request->file('file');
      $extensi = $photo->getClientOriginalExtension();
      $files = 'post-' . now()->timestamp . '.' . $extensi;
      $photo->move('imagePost', $files);

      $data = [
        "user_id" => auth()->user()->id,
        "judul" => $request->judul,
        "deskripsi" => $request->deskripsi,
        "tag" => $request->tag,
        "album_id" => $request->album_id,
        "file" => $files,
      ];
      $post = Post::create($data);
      $postId = $post->id;
      return response()->json([
        "status" => 200,
        "messages" => "Postingan berhasil di unggah",
        "postId" => $postId,
      ]);
    }
  }

  public function show(Post $post)
  {
    $bg = "bg-white";
    $title = "Picturest | Update";
    $navTitle = "Edit Postingan";
    $post = Post::with(['albums'])->where('status', 'aktif')->where('uuid',$post->uuid)->first();
    $album = Album::where("user_id", auth()->user()->id)->get();
    if ($post->user_id == auth()->id()) {
      return view("page.edit-post", compact("post", "album", "title", "bg", "navTitle"));
    } else {
      return view('error-handling.404');
    }
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'judul' => 'required|max:30',
      'deskripsi' => 'required|max:255',
      'tag' => 'required|max:20',
    ], [
      'judul.required' => 'kolom judul harus diisi',
      'judul.max' =>  'kolom judul tidak boleh lebih dari 30 karakter',
      'deskripsi.required' => 'kolom deskripsi harus diisi',
      'deskripsi.max'=> 'kolom deskripsi tidak boleh lebih dari 255 karakter',
      'tag.required' => 'kolom tag harus diisi',
      'tag.max'=> 'kolom tag tidak boleh lebih dari 20 karakter',
      
    ]);
    if ($validator->fails()) {
      return response()->json([
        'status' => 400,
        'errors' => $validator->errors()
      ]);
    } else {
      $post = Post::find($id);
      $post->update([
        'album_id' => $request->album_id,
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'tag' => $request->tag,
      ]);
      return response()->json([
        'status' => 200,
        'message' => 'Postinngan berhasil di perbarui'
      ]);
    }
  }

  public function destroy($id)
  {
    $post = Post::find($id);
    $namaFile = $post->file;
    $lokasi = public_path('imagePost/' . $namaFile);
    if (file_exists($lokasi)) {
      unlink($lokasi);
    }
    $post->delete();
    return redirect()->back();
  }
}

