<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Album;
use App\Models\Inbox;
use App\Models\Report;
use App\Models\Comment;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function showLogin()
    {
        $title = "Login | Admin";
        $bg = 'bg-white';
        return view("admin.login", compact("title", "bg"));
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (User::where('email', $request->email)->exists()) {
            $user = User::where('email', $request->email)->first();
            if ($user->role !== 'admin') {
                return redirect()->back()->with('error', 'akses ditutup untuk user');
            }
        }
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with('success', 'anda admin');
        } else {
            return redirect()->back()->with('error', 'password dan email tida cocok');
        }
    }

    public function index()
    {
        $title = "Dashboard | Admin";
        $bg = 'bg-white';
        return view("admin.dashboard", compact("title", "bg"));
    }
    public function getData()
    {
        $reportsPerDay = Report::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json(['data' => $reportsPerDay]);
    }
    public function showReport()
    {
        $title = "Dashboard | Report";
        $bg = 'bg-white';
        $data = Report::with(['users', 'posts'])->latest()->get();
        return view("admin.report", compact("title", "bg", "data"));
    }
    public function detailReport($id)
    {
        $title = "Dashboard | Detail Report";
        $bg = 'bg-white';
        $data = Report::with('posts')->find($id);
        $user = User::where('id', $data->posts->user_id)->first();
        return view("admin.detail-report", compact("title", "bg", "data", "user"));
    }

    public function blockPost($id)
    {
        $post = Post::find($id);
        if ($post->status == 'aktif') {
            $post->status = 'blokir';
            $post->save();
            $data = [
                'from' => auth()->user()->id,
                'to' => $post->user_id,
                'msg' => 'Postingan anda melanggar aturan',
                'post_id' => $post->id,
            ];
            Notifikasi::create($data);
            return response()->json([
                'status' => 400,
                'message' => 'Data berhasil di blokir',
            ]);
        } else if ($post->status == 'blokir') {
            $post->status = 'aktif';
            $post->save();
            $data = [
                'from' => auth()->user()->id,
                'to' => $post->user_id,
                'msg' => 'Postingan anda telah di aktifkan kembali',
                'post_id' => $post->id,
            ];
            Notifikasi::create($data);
            return response()->json([
                'status' => 200,
                'message' => 'Data berhasil di aktifkan',
            ]);
        }
    }

    public function showUser(Request $request)
    {
        $title = "Dashboard | Users";
        $bg = 'bg-white';
        $user = User::paginate(9);
        $data = '';
        if ($request->ajax()) {
            $data .= view("admin.usersShow", compact("user"));
            return $data;
        }
        return view("admin.users", compact("title", "bg"));
    }

    public function searchUser(Request $request)
    {

        $user = User::where("username", "LIKE", "%" . $request->search . "%")
            ->orWhere("email", "LIKE", "%" . $request->search . "%")
            ->orderBy("id", "desc")->paginate(9);

        if ($user->count() >= 1) {
            return view("admin.usersShow", compact("user"));
        } else if ($user->count() <= 1) {
            return response()->json([
                "status" => 400,
                "message" => "Users tidak ditemukan"
            ]);
        }
    }


    public function bannedUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->status == "aktif") {
            $user->status = "banned";
            $user->save();
            $data = [
                'from' => auth()->user()->id,
                'to' => $user->id,
                'msg' => 'acounnt anda telah di banned dan tidak dapat melakukan kegiatan seperti biasa',
            ];
            Notifikasi::create($data);
            return response()->json([
                'status' => 400,
                'message' => 'berhasil di banned',
            ]);
        } else if ($user->status == "banned") {
            $user->status = "aktif";
            $user->save();
            $data = [
                'from' => auth()->user()->id,
                'to' => $user->id,
                'msg' => 'acounnt anda telah di diaktifkan kembali dan dapat melakukan kegiatan seperti biasa',
            ];
            Notifikasi::create($data);
            return response()->json([
                'status' => 200,
                'message' => 'berhasil di aktifkan',
            ]);
        }
    }

    public function usersInfo($id)
    {
        $title = "Dashboard | Users";
        $bg = 'bg-white';
        $user = User::find($id);
        $post = Post::where('user_id', $user->id)->get();
        $album = Album::where('user_id', $user->id)->get();
        $comen = Comment::with('users')->where('user_id', $user->id)->get();
        return view("admin.users-info", compact("title", "bg", "user", "post", "album", "comen"));
    }

    public function deleteReport($id)
    {
        $report = Report::find($id);
        $report->delete();
        return response()->json([
            "status" => 200,
            "message" => "berhasil dihapus"
        ]);
    }

    public function inbox()
    {
        $title = "Dashboard | Inbox";
        $bg = "bg-white";
        $inbox = Inbox::all();
        return view("admin.inbox", compact("title", "bg", "inbox"));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Berhasil logout');
    }
}
