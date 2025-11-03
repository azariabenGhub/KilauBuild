<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ongoingProjects;
use Illuminate\Support\Facades\Storage;

class OngoingProjectController extends Controller
{
    public function createOP(Request $request){
        if (auth()->check()){   
            $incomingFields = $request->validate([
                'name' => 'required',
                'loc' => 'required',
                'persen' => 'required',
                'image' => 'required'
            ]);

            if($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('ongoing_project', 'public');
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['loc'] = strip_tags($incomingFields['loc']);
            $incomingFields['persen'] = strip_tags($incomingFields['persen']);
            $incomingFields['user_id'] = auth()->id();
            ongoingProjects::create($incomingFields);
            return Redirect("/dashboard");
        }
        
        return redirect('/');
    }

    public function showEditScreen(ongoingProjects $OP){
        if (auth()->id() == $OP['user_id']){
            return view('edit-ongoing-project', ['OP' => $OP]);
        }
        
        return redirect('/');
    }

    public function updateOP(ongoingProjects $OP, Request $request){
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
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['loc'] = strip_tags($incomingFields['loc']);
            $incomingFields['persen'] = strip_tags($incomingFields['persen']);

            $OP->update($incomingFields);
            
            return redirect('/dashboard');
        }
        
        return redirect('/');
    }

    public function deleteOP(ongoingProjects $OP){
        if (auth()->id() == $OP['user_id']){
            $OP->delete();
            Storage::disk('public')->delete($OP->image);
        }
        
        return redirect('/dashboard');
    }
}
