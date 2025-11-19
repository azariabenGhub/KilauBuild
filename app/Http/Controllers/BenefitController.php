<?php

namespace App\Http\Controllers;

use App\Models\benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BenefitController extends Controller
{
    public function index(){
        $bnfts = benefit::all();

        return view('dashboard', ['bnfts' => $bnfts]);
    }
    
    public function createBenefit(Request $request){
        if (auth()->check()){   
            $incomingFields = $request->validate([
                'title' => 'required',
                'desc' => 'required',
                'image' => 'required'
            ]);

            if($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('benefits', 'public');
                ImageController::compressImage($imagePath);
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['title'] = strip_tags($incomingFields['title']);
            $incomingFields['desc'] = strip_tags($incomingFields['desc']);
            $incomingFields['user_id'] = auth()->id();
            benefit::create($incomingFields);
            return Redirect("/dashboard");
        }
        
        return redirect('/');
    }

    public function showEditScreen(benefit $bnft){
        if (auth()->id() == $bnft['user_id']){
            return view('edit-benefit', ['bnft' => $bnft]);
        }
        
        return redirect('/');
    }

    public function updateBenefit(benefit $bnft, Request $request){
        if (auth()->id() == $bnft['user_id']){
            $incomingFields = $request->validate([
                'title' => 'required',
                'desc' => 'required'
            ]);

            if($request->hasFile('image')) {
                Storage::disk('public')->delete($bnft->image);
                $imagePath = $request->file('image')->store('benefits', 'public');
                ImageController::compressImage($imagePath);
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['title'] = strip_tags($incomingFields['title']);
            $incomingFields['desc'] = strip_tags($incomingFields['desc']);

            $bnft->update($incomingFields);
            
            return redirect('/dashboard');
        }
        
        return redirect('/');
    }

    public function deleteBenefit(benefit $bnft){
        if (auth()->id() == $bnft['user_id']){
            $bnft->delete();
            Storage::disk('public')->delete($bnft->image);
        }
        
        return redirect('/dashboard');
    }
}
