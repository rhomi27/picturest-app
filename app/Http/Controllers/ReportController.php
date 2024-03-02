<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    //
    public function report(Request $request,$postId){
        $validator = Validator::make($request->all(),[
            "alasan"=> "required",
        ],[
            "alasan.required"=> "anda harus punya alasan",
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors'=> $validator->errors(),
            ]);
        } else{
            $data = [
                'user_id' => auth()->user()->id,
                'post_id'=> $postId,
                'alasan' => $request->alasan,
            ];
            Report::create($data);
            return response()->json([
                'status'=> 200,
                'message'=> 'Anda berhasil melaporkan postingan',
            ]);
        }
    }
}
