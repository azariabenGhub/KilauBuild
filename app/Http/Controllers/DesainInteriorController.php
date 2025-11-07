<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\desainInterior;
use Illuminate\Support\Facades\Storage;

class DesainInteriorController extends Controller
{
    public function createDI(Request $request){
        if (auth()->check()){       
            $incomingFields = $request->validate([
                'name' => 'required',
                'image' => 'required'
            ]);

            if($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('desain_project', 'public');
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['user_id'] = auth()->id();
            desainInterior::create($incomingFields);
            return Redirect("/dashboard");
        }
        
        return redirect('/');
    }

    public function showEditScreen(desainInterior $DI){
        if (auth()->id() == $DI['user_id']){
            return view('edit-desain-interior', ['OP' => $DI]);
        }
        
        return redirect('/');
    }

    public function updateOP(desainInterior $DI, Request $request){
        if (auth()->id() == $DI['user_id']){
            $incomingFields = $request->validate([
                'name' => 'required',
                'image' => 'sometimes|image|nullable'
            ]);

            if($request->hasFile('image')) {
                Storage::disk('public')->delete($DI->image);
                $imagePath = $request->file('image')->store('desain_interior', 'public');
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['name'] = strip_tags($incomingFields['name']);

            $DI->update($incomingFields);
            
            return redirect('/dashboard');
        }
        
        return redirect('/');
    }

    public function deleteDI(desainInterior $DI){
        if (auth()->id() == $DI['user_id']){
            $DI->delete();
            Storage::disk('public')->delete($DI->image);
        }
        
        return redirect('/dashboard');
    }
}
