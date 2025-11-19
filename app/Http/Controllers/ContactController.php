<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $cont = contact::all();

        return response()->json([
            'success' => true,
            'data' => $cont
        ]);
    }

    public function store(Request $request){
        if (auth()->check()){   
            $incomingFields = $request->validate([
                'no_telp' => 'required',
                'alamat' => 'required',
                'link_gmaps' => 'required',
                'email' => 'required'
            ]);

            $incomingFields['no_telp'] = strip_tags($incomingFields['no_telp']);
            $incomingFields['alamat'] = strip_tags($incomingFields['alamat']);
            $incomingFields['link_gmaps'] = filter_var($incomingFields['link_gmaps']);
            $incomingFields['email'] = strip_tags($incomingFields['email']);
            $incomingFields['user_id'] = auth()->id();
            $cont = contact::create($incomingFields);
            return response()->json([
                'success' => true,
                'message' => 'Kontak berhasil dibuat',
                'data' => $cont
            ]);
        } 
    }

    public function update(contact $cont, Request $request){
        if (auth()->id() == $cont['user_id']){
            $incomingFields = $request->validate([
                'no_telp' => 'required',
                'alamat' => 'required',
                'link_gmaps' => 'required',
                'email' => 'required',
            ]);

            $incomingFields['no_telp'] = strip_tags($incomingFields['no_telp']);
            $incomingFields['alamat'] = strip_tags($incomingFields['alamat']);
            $incomingFields['link_gmaps'] = filter_var($incomingFields['link_gmaps']);
            $incomingFields['email'] = strip_tags($incomingFields['email']);

            $cont->update($incomingFields);
            
            return response()->json([
                'success' => true,
                'message' => 'Kontak berhasil dibuat',
                'data' => $cont
            ]);
        }
    }

    public function destroy(contact $cont){
        if (auth()->id() == $cont['user_id']){
            $cont->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Kontak berhasil dibuat',
                'data' => $cont
            ]);
        }
    }
}
