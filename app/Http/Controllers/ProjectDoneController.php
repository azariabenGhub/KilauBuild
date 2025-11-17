<?php

namespace App\Http\Controllers;

use App\Models\projectDone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectDoneController extends Controller
{
    public function createPD(Request $request){
        if (auth()->check()){   
            $incomingFields = $request->validate([
                'name' => 'required',
                'desc' => 'required',
                'year' => 'required',
                'image' => 'required'
            ]);

            if($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('project_done', 'public');
                ImageController::compressImage($imagePath);
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['desc'] = strip_tags($incomingFields['desc']);
            $incomingFields['year'] = strip_tags($incomingFields['year']);
            $incomingFields['user_id'] = auth()->id();
            projectDone::create($incomingFields);
            return Redirect("/dashboard");
        }
        
        return redirect('/');
    }

    public function showEditScreen(projectDone $PD){
        if (auth()->id() == $PD['user_id']){
            return view('edit-project-done', ['PD' => $PD]);
        }
        
        return redirect('/');
    }

    public function updatePD(projectDone $PD, Request $request){
        if (auth()->id() == $PD['user_id']){
            $incomingFields = $request->validate([
                'name' => 'required',
                'desc' => 'required',
                'year' => 'required',
                'image' => 'sometimes|image|nullable'
            ]);

            if($request->hasFile('image')) {
                Storage::disk('public')->delete($PD->image);
                $imagePath = $request->file('image')->store('project_done', 'public');
                ImageController::compressImage($imagePath);
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['desc'] = strip_tags($incomingFields['desc']);
            $incomingFields['year'] = strip_tags($incomingFields['year']);

            $PD->update($incomingFields);
            
            return redirect('/dashboard');
        }
        
        return redirect('/');
    }

    public function deletePD(projectDone $PD){
        if (auth()->id() == $PD['user_id']){
            $$PD->delete();
            Storage::disk('public')->delete($PD->image);
        }
        
        return redirect('/dashboard');
    }
}
