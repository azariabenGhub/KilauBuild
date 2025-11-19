<?php

namespace App\Http\Controllers;

use App\Models\statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(){
        $statis = statistic::all();

        return response()->json([
            'success' => true,
            'data' => $statis
        ]);
    }
    
    public function store(Request $request){
        if (auth()->check()){   
            $incomingFields = $request->validate([
                'tahun_pengalaman' => 'required',
                'proyek_selesai' => 'required',
                'klien_puas' => 'required',
                'sebaran_kota' => 'required'
            ]);

            $incomingFields['tahun_pengalaman'] = strip_tags($incomingFields['tahun_pengalaman']);
            $incomingFields['proyek_selesai'] = strip_tags($incomingFields['proyek_selesai']);
            $incomingFields['klien_puas'] = strip_tags($incomingFields['klien_puas']);
            $incomingFields['sebaran_kota'] = strip_tags($incomingFields['sebaran_kota']);
            $incomingFields['user_id'] = auth()->id();
            $statis =  statistic::create($incomingFields);
            return response()->json([
                'success' => true,
                'message' => "Statistik berhasil dibuat",
                'data' => $statis
            ]);
        } 
    }

    public function update(statistic $statis, Request $request){
        if (auth()->id() == $statis['user_id']){
            $incomingFields = $request->validate([
                'tahun_pengalaman' => 'required',
                'proyek_selesai' => 'required',
                'klien_puas' => 'required',
                'sebaran_kota' => 'required'
            ]);


            $incomingFields['tahun_pengalaman'] = strip_tags($incomingFields['tahun_pengalaman']);
            $incomingFields['proyek_selesai'] = strip_tags($incomingFields['proyek_selesai']);
            $incomingFields['klien_puas'] = strip_tags($incomingFields['klien_puas']);
            $incomingFields['sebaran_kota'] = strip_tags($incomingFields['sebaran_kota']);

            $statis->update($incomingFields);
            
            return response()->json([
                'success' => true,
                'message' => "Statistik berhasil diperbarui",
                'data' => $statis
            ]);
        }
    }

    public function destroy(statistic $statis){
        if (auth()->id() == $statis['user_id']){
            $statis->delete();
            
            return response()->json([
                'success' => true,
                'message' => "Statistik berhasil dihapus",
                'data' => $statis
            ]);
        }
    }
}
