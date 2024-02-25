<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    //
    public function help()
    {
        $title = 'Picturest | Tentang Bantuan';
        $bg = 'bg-gray-100';
        return view('help', compact('title', 'bg'));
    }
    public function helpAuth()
    {
        $title = 'Picturest | Tentang Bantuan';
        $bg = 'bg-gray-100';
        return view('page.users.help-auth', compact('title', 'bg'));
    }

    public function inbox(Request $request){
        $validator = validator($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'pesan'=> 'required',
        ],[
            'name.required'=> 'name harus diisi',
            'email.required'=> 'email harus diisi',
            'pesan.required'=> 'pesan harus diisi',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        } else{
            Inbox::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'pesan'=> $request->pesan,
            ]);
            return redirect()->back()->with('success','Inbox telah berhasil dikirim');
        }
    }
}
