<?php

namespace App\Http\Controllers;
use App\Models\request_status;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class request_statusController extends Controller
{
    public function index(){
        $requestor = request_status::all();

        return response()->json([
            'success' => true,
            'message' => 'Data Request',
            'data'    => $requestor  
        ], 200);
    }

    public function show_requests(Request $request){
        $reciever = DB::table('request_status')
            ->where('reciever', $request->reciever)
            ->get();

        if($reciever){
            return response()->json([
                'success' => true,
                'message' => 'Hasil penelusuran',
                'data'    => $reciever  
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal, tidak ada penelusuran',
                'data'    => $reciever  
            ], 400);
        }
    }

    public function show_friends(Request $request){
        $requestor = DB::table('request_status')
            ->where('requestor', $request->requestor)
            ->get();

        if($requestor){
            return response()->json([
                'success' => true,
                'message' => 'Hasil penelusuran',
                'data'    => $requestor  
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal, tidak ada penelusuran',
                'data'    => $requestor  
            ], 400);
        }
    }

    public function created(Request $request){
        $cek = DB::table('request_status')
            ->where('requestor', $request->requestor)
            ->where('reciever', $request->reciever)
            // ->where('status','=', 'pending','and','status','=', 'accepted')
            ->count();

        $requestor = new request_status;
        $requestor->requestor = $request->requestor;
        $requestor->reciever = $request->reciever;
        $requestor->status = $request->status;

        if($cek >= 1){
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Ditambahkan',
                'data'    => $requestor  
            ], 400);
        }
        else{
            $requestor->save(); 

                return response()->json([
                    'success' => true,
                    'message' => 'Data Berhasil Ditambahkan',
                    'data'    => $requestor  
                ], 200);
        }
    }

    public function update(Request $request, $reciever){
        $cek = DB::table('request_status')
            ->where('requestor', $request->requestor)
            ->where('reciever', $reciever)
            ->where('status','=', 'pending')
            ->count();

        if($cek >= 1){
            $update = DB::table('request_status')
            ->select('request_status_id')
            ->where('requestor', $request->requestor)
            ->where('reciever', $reciever)
            ->update(['status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diubah'
            ], 200);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Data Gagal Diubah'
        ], 400);
    }

    public function delete($id){
        $requestor = request_status::find($id);
        $requestor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post Deleted',
        ], 200);
    }
}
