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

    public function profilUser(Request $request, User $user)
    {

        if ($user->id == Auth::id()) {
            return redirect('/profil');
        }
        $bg = "white";
        $class = 'hidden';
        $p = 'p-2';
        $user = User::where('uuid', $user->uuid)->first();
        $post = Post::where('user_id', $user->id)->where('status', 'aktif')->latest()->paginate(12);

        $title = "Profil | $user->username";
        $data = '';
        if ($request->ajax()) {
            $data .= view("page.posts.read", compact("post"));
            return $data;
        }
        return view(
            "page.users.profil-user",
            compact("bg", "title", "user", "post", "class", "p")
        );
    }

    public function profil(Request $request)
    {
        $bg = "white";
        $class = '';
        $p = 'p-1';
        $title = "Picturest | Profil";
        $user = auth()->user();
        $post = Post::where('user_id', auth()->user()->id)->where('status', 'aktif')->latest()->paginate(12);
        $data = '';
        if ($request->ajax()) {
            $data .= view("page.users.data-user.post-user", compact("post"));
            return $data;
        }
        return view(
            "page.users.profil",
            compact("bg", "user", "title", "post", "class", "p")
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
            'pictures' => 'mimes:png,jpg,jpeg|image|max:5000',
            'username' => 'required|max:20',
            'nama_lengkap' => 'max:60',
            'bio' => 'max:225',
        ], [
            'pictures.mimes' => 'extensi gambar harus png jpg jpeg',
            'pictures.max' => 'ukuran gambar tidak boleh lebih dari 5 mb',
            'username.required' => 'username tidak boleh kosong',
            'username.max' => 'username tidak boleh lebih dari 20 karakter',
            'nama_lengkap.max' => 'username tidak boleh lebih dari 60 karakter',
            'bio.max' => 'username tidak boleh lebih dari 225 karakter',
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

    public function hapusProfil()
    {
        $user = auth()->user();
        if ($user->pictures !== 'user.jpg') {
            File::delete(public_path('pictures/' . $user->pictures));
        }
        $user->update([
            'pictures' => 'user.jpg'
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Photo profil berhasil dihapus'
        ]);
    }

    public function setAcount(Request $request)
    {
        $title = 'Pengaturan akun';
        $bg = 'bg-white';
        $user = auth()->user();
        $aktivitas_log = UserLoginLog::where('user_id', $user->id)->get();
        return view('page.users.akun', compact('user', 'title', 'bg', 'aktivitas_log'));
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

    public function deleteHistory(Request $request)
    {
        $ids = $request->ids;
        UserLoginLog::whereIn('id', $ids)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'history login di bersihkan'
        ]);
    }
}
