<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlbumController extends Controller
{
    //
    public function albumDetail($id)
    {
        $bg = "white";
        $album = Album::find($id);
        $title = "Detail Album | $album->nama";
        return view("page.album.detail-album", compact("album", "title", "bg"));
    }

    public function readDetail(Request $request)
    {
        $id = $request->id;
        $post = Post::where("album_id", $id)->where('status', 'aktif')->latest()->paginate(12);
        return view('page.album.read-detail', compact('post'));
    }
    public function index(Request $request)
    {
        $bg = "white";
        $title = "Picturest | Album";
        return view("page.album.album", compact("bg", "title"));
    }
    public function read(Request $request)
    {
        $album = Album::where('user_id', auth()->user()->id)->latest()->get();
        return view('page.album.read', compact('album'));
    }

    public function albumUser(Request $request, $id)
    {
        $album = Album::where('user_id', $id)->latest()->get();
        return view('page.album.read', compact('album'));
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
            'wallpaper' => 'required|mimes:png,jpg,jpeg|image|max:5000',
        ], [
            'nama.required' => 'kolom nama harus diisi',
            'deskripsi.required' => 'kolom deskripsi harus diisi',
            'wallpaper.mimes' => 'extensi file harus png jpg jpeg',
            'wallpaper.required' => 'wallpaper harus diisi',
            'wallpaper.image'=> 'wallpaper harus berbentuk gambar',
            'wallpaper.max' => 'ukuran gambar harus dibawah 5 mb',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $photo = $request->file('wallpaper');
            $extensi = $photo->getClientOriginalExtension();
            $files = 'wallpaper-' . now()->timestamp . '.' . $extensi;
            $photo->move('Album', $files);

            $data = [
                "user_id" => auth()->user()->id,
                "nama" => $request->nama,
                "deskripsi" => $request->deskripsi,
                "wallpaper" => $files,
            ];
            Album::create($data);

            return response()->json([
                "status" => 200,
                "messages" => "Album dibuat",
            ]);
        }
    }

    public function show($id)
    {
        $album = Album::find($id);
        if (!$album) {
            return response()->json([
                "status" => 404,
                "message" => "not data"
            ]);
        }
        return response()->json([
            "status" => 200,
            "id" => $album->id,
            "nama" => $album->nama,
            "deskripsi" => $album->deskripsi,
            "wallpaper" => asset('Album/' . $album->wallpaper),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
            'wallpaper' => 'required|mimes:png,jpg,jpeg|image|max:5000',
        ], [
            'nama.required' => 'kolom nama harus diisi',
            'deskripsi.required' => 'kolom deskripsi harus diisi',
            'wallpaper.mimes' => 'extensi file harus png jpg jpeg',
            'wallpaper.required' => 'gambar harus diisi',
            'wallpaper.image'=> 'wallpaper harus berbentuk gambar',
            'wallpaper.max' => 'ukuran gambar harus dibawah 5 mb',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $album = Album::find($id);
            if (!$album) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Album tidak ditemukan'
                ]);
            }

            $photo = $request->file('wallpaper');

            if ($request->hasFile('wallpaper') && $photo->isValid()) {
                if ($album->wallpaper) {
                    $oldFilePath = public_path('Album/' . $album->wallpaper);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
                $extensi = $photo->getClientOriginalExtension();
                $files = 'wallpaper-' . now()->timestamp . '.' . $extensi;
                $photo->move('Album', $files);

                $gambar = $files;
            } else {
                $gambar = $album->wallpaper;
            }

            $album->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'wallpaper' => $gambar,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Album berhasil diperbarui'
            ]);

        }
    }


    public function searchAlbum(Request $request)
    {
        $album = Album::where('user_id', auth()->id())
            ->where(function ($query) use ($request) {
                $query->where("nama", "like", "%" . $request->search_string . "%")
                    ->orWhere("deskripsi", "like", "%" . $request->search_string . "%");
            })
            ->orderBy('id', 'desc')
            ->get();

        if ($album->count() >= 1) {
            return view('page.album.read', compact('album'));
        } else if ($album->count() <= 1) {
            return response()->json([
                'status' => 400,
                'pesan' => "Album tidak ditemukan"
            ]);
        }
    }

    public function searchImage(Request $request, $id)
    {
        $post = Post::where('status', 'aktif')
            ->where('album_id', $id)
            ->where(function ($query) use ($request) {
                $query->where("judul", "like", "%" . $request->search_string . "%")
                    ->orWhere("deskripsi", "like", "%" . $request->search_string . "%")
                    ->orWhere("tag", "like", "%" . $request->search_string . "%");
            })
            ->orderBy('id', 'desc')
            ->paginate(16);


        if ($post->count() >= 1) {
            return view('page.album.read-detail', compact('post'));
        } else if ($post->count() <= 1) {
            return response()->json([
                'status' => 400,
                'pesan' => "Data tidak ditemukan"
            ]);
        }
    }


    public function delete($id)
    {
        $album = Album::find($id);
        $namaFile = $album->wallpaper;
        $lokasi = public_path('Album/' . $namaFile);
        if (file_exists($lokasi)) {
            unlink($lokasi);
        }
        $album->delete();
        return redirect()->back();
    }
}
