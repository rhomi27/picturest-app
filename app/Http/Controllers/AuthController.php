<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserLoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function daftar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email:filter|unique:users',
            'password' => 'required|min:6',
        ], [
            'username.required' => 'username harus diisi',
            'email.required' => 'email harus diisi',
            'email.email' => 'format email harus benar',
            'email.unique' => 'email sudah terdaftar',
            'password.required' => 'password harus diisi',
            'password.min' => 'password harus memiliki minimal 6 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $dataUser = [
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            User::create($dataUser);
            return response()->json([
                'status' => 200,
                'messages' => 'Pendaftaran Berhasil'
            ]);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:filter',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email harus benar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password harus memiliki minimal 6 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $dataLogin = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if (User::where('email', $request->email)->exists()) {
                $user = User::where('email', $request->email)->first();
                if ($user->role !== 'user') {
                    return response()->json([
                        'status' => 500,
                        'info' => 'Hanya pengguna yang diizinkan',
                    ]);
                }
            }
            
            if (Auth::attempt($dataLogin)) {
                $request->session()->regenerate();
                UserLoginLog::create([
                    "user_id" => Auth::id(),
                    "login_time" =>  Carbon::now()->locale("id"),
                    "ip_address" => $request->ip(),
                ]);
                return response()->json([
                    'status' => 200,
                    'messages' => 'Login berhasil',
                    'redirect' => '/home',
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'msg' => 'Password atau email tidak cocok',
                ]);
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/')->with('success', 'Berhasil logout');
    }

}
