<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\UserLoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function read($id)
    {
        $user = User::find($id);
        $countPost = Post::where('user_id', $id)->count();
        $follower = $user->followers()->get();
        $following = $user->following()->get();
        return view("page.users.data-user.count", compact("user", "follower", "following", "countPost"));
    }
    public function reading()
    {
        $user = auth()->user();
        $countPost = Post::where('user_id', $user->id)->count();
        $follower = $user->followers()->get();
        $following = $user->following()->get();
        return view("page.users.data-user.count", compact("user", "follower", "following", "countPost"));
    }

    public function profilUser(Request $request, $id)
    {

        if ($id == Auth::id()) {
            return redirect('/profil');
        }
        $bg = "white";
        $class = 'hidden';
        $p = 'p-2';
        $user = User::find($id);
        $follower = $user->followers()->get();
        $following = $user->following()->get();
        $post = Post::where('user_id', $id)->where('status', 'aktif')->latest()->paginate(12);
        $countPost = Post::where('user_id', $id)->count();
        $title = "Profil | $user->username";
        $data = '';
        if ($request->ajax()) {
            $data .= view("page.posts.read", compact("post"));
            return $data;
        }
        return view(
            "page.users.profil-user",
            compact("bg", "title", "user", "post", "countPost", "class", "p", "follower", "following")
        );
    }

    public function profil(Request $request)
    {
        $bg = "white";
        $class = '';
        $p = 'p-1';
        $title = "Picturest | Profil";
        $user = auth()->user();
        $follower = $user->followers()->get();
        $following = $user->following()->get();
        $post = Post::where('user_id', auth()->user()->id)->where('status', 'aktif')->latest()->paginate(12);
        $data = '';
        if ($request->ajax()) {
            $data .= view("page.users.data-user.post-user", compact("post"));
            return $data;
        }
        return view(
            "page.users.profil",
            compact("bg", "user", "title", "post", "class", "p", "follower", "following")
        );
    }
    public function showEdit()
    {
        $title = 'Picturest | Edit Profil';
        $bg = 'bg-white';
        $user = auth()->user();
        return view('page.edit-profil', compact('title', 'bg', 'user'));
    }

    public function edit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'pictures' => 'mimes:png,jpg,jpeg',
            'username' => 'required',
        ], [
            'pictures.mimes' => 'extensi gambar harus png jpg jpeg',
            'username.required' => 'username tidak boleh kosong',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $user = auth()->user();
            if ($request->hasFile('pictures')) {
                if ($user->pictures !== 'user.jpg') {
                    File::delete(public_path('pictures/' . $user->pictures));
                }
                $pictures = $request->file('pictures');
                $extensi = $pictures->getClientOriginalExtension();
                $filename = 'users' . now()->timestamp . '.' . $extensi;
                $pictures->move('pictures', $filename);
                $user->pictures = $filename;
            } else {
                $pictures = $user->pictures;
            }

            $user->username = $request->username;
            $user->nama_lengkap = $request->nama_lengkap;
            $user->alamat = $request->alamat;
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->bio = $request->bio;
            $user->tanggal_lahir = $request->tanggal_lahir;

            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'Profil telah di perbarui',
            ]);
        }
    }

    public function setAcount(Request $request)
    {
        $title = 'Pengaturan akun';
        $bg = 'bg-white';
        $user = auth()->user();
        $aktivitas_log = UserLoginLog::where('user_id', $user->id)->get();
        return view('page.users.akun', compact('user', 'title', 'bg','aktivitas_log'));
    }

    public function updateAcount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:filter',
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ], [
            'email.required' => 'kolom ini harus diisi',
            'email.email' => 'format email harus benar',
            'old_password.required' => 'kolom ini harus diisi',
            'old_password.min' => 'harus minimal memilliki 6 karakter',
            'new_password.required' => 'kolom ini harus diisi',
            'new_password.min' => 'harus minimal memilliki 6 karakter',
            'confirm_password.required' => 'kolom ini harus diisi',
            'confirm_password.same' => 'password tidak sama dengan sebelumnya',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $user = auth()->user();
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Gagal mengubah password.',
                    'errors' => ['old_password' => ['Password lama salah.']],
                ]);
            } else {
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'berhasi diperbarui',
                ]);
            }
        }
    }
}
