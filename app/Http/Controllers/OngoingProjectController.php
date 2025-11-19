<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ongoingProjects;
use Illuminate\Support\Facades\Storage;

class OngoingProjectController extends Controller
{
    public function index(){
        $OPs = ongoingProjects::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $OPs
        ]);
    }
    
    public function store(Request $request){
        if (auth()->check()){   
            $incomingFields = $request->validate([
                'name' => 'required',
                'loc' => 'required',
                'persen' => 'required',
                'image' => 'required'
            ]);

            if($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('ongoing_project', 'public');
                ImageController::compressImage($imagePath);
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['loc'] = strip_tags($incomingFields['loc']);
            $incomingFields['persen'] = strip_tags($incomingFields['persen']);
            $incomingFields['user_id'] = auth()->id();
            $OP = ongoingProjects::create($incomingFields);
            return response()->json([
                'success' => true,
                'data' => $OP
            ]);
        }
    }

    public function update(ongoingProjects $OP, Request $request){
        if (auth()->id() == $OP['user_id']){
            $incomingFields = $request->validate([
                'name' => 'required',
                'loc' => 'required',
                'persen' => 'required',
                'image' => 'sometimes|image|nullable'
            ]);

            if($request->hasFile('image')) {
                Storage::disk('public')->delete($OP->image);
                $imagePath = $request->file('image')->store('ongoing_project', 'public');
                ImageController::compressImage($imagePath);
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['loc'] = strip_tags($incomingFields['loc']);
            $incomingFields['persen'] = strip_tags($incomingFields['persen']);

            $OP->update($incomingFields);
            
            return response()->json([
                'success' => true,
                'message' => "Ongoing Project berhasil diperbarui",
                'data' => $OP
            ]);
        }
    }

    public function destroy(ongoingProjects $OP){
        if (auth()->id() == $OP['user_id']){
            $OP->delete();
            Storage::disk('public')->delete($OP->image);
        
            return response()->json([
                'success' => true,
                'message' => "Ongoing Project berhasil dihapus",
                'data' => $OP
            ]);
        }
    }
}
