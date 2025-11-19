<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\desainInterior;
use Illuminate\Support\Facades\Storage;

class DesainInteriorController extends Controller
{
    public function index(){
        $DIs = desainInterior::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $DIs
        ]);
    }
    
    public function store(Request $request){
        if (auth()->check()){       
            $incomingFields = $request->validate([
                'name' => 'required',
                'image' => 'required'
            ]);

            if($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('desain_project', 'public');
                ImageController::compressImage($imagePath);
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['user_id'] = auth()->id();
            $DI = desainInterior::create($incomingFields);
            return response()->json([
                'success' => true,
                'message' => 'Desain Interior berhasil dibuat',
                'data' => $DI
            ]);
        }
    }

    public function update(desainInterior $DI, Request $request){
        if (auth()->id() == $DI['user_id']){
            $incomingFields = $request->validate([
                'name' => 'required',
                'image' => 'sometimes|image|nullable'
            ]);

            if($request->hasFile('image')) {
                Storage::disk('public')->delete($DI->image);
                $imagePath = $request->file('image')->store('desain_interior', 'public');
                ImageController::compressImage($imagePath);
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['name'] = strip_tags($incomingFields['name']);

            $DI->update($incomingFields);
            
            return response()->json([
                'success' => true,
                'message' => 'Desain Interior berhasil diperbarui',
                'data' => $DI
            ]);
        }
    }

    public function destroy(desainInterior $DI){
        if (auth()->id() == $DI['user_id']){
            $DI->delete();
            Storage::disk('public')->delete($DI->image);
        
            return response()->json([
                'success' => true,
                'message' => 'Desain Interior berhasil dihapus',
                'data' => $DI
            ]);
        }
    }
}
