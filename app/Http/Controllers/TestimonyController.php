<?php

namespace App\Http\Controllers;

use App\Models\testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function index(){
        $tstmns = testimony::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $tstmns
        ]);
    }
    
    public function store(Request $request){
        if (auth()->check()){   
            $incomingFields = $request->validate([
                'name' => 'required',
                'review' => 'required',
                'star' => 'required',
            ]);

            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['review'] = strip_tags($incomingFields['review']);
            $incomingFields['star'] = strip_tags($incomingFields['star']);
            $incomingFields['user_id'] = auth()->id();
            $tstmn = testimony::create($incomingFields);
            return response()->json([
                'success' => true,
                'message' => 'Testimoni berhasil dibuat',
                'data' => $tstmn
            ]);
        }
    }

    public function update(testimony $tstmn, Request $request){
        if (auth()->id() == $tstmn['user_id']){
            $incomingFields = $request->validate([
                'name' => 'required',
                'review' => 'required',
                'star' => 'required',
            ]);


            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['review'] = strip_tags($incomingFields['review']);
            $incomingFields['star'] = strip_tags($incomingFields['star']);

            $tstmn->update($incomingFields);
            
            return response()->json([
                'success' => true,
                'message' => 'Testimoni berhasil diperbarui',
                'data' => $tstmn
            ]);
        }
    }

    public function destroy(testimony $tstmn){
        if (auth()->id() == $tstmn['user_id']){
            $tstmn->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Testimoni berhasil dihapus',
                'data' => $tstmn
            ]);
        }
    }
}
