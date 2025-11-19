<?php

namespace App\Http\Controllers;

use App\Models\ownerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OwnerProfileController extends Controller
{
    public function index(){
        $owp = ownerProfile::all();

        return response()->json([
            'success' => true,
            'data' => $owp
        ]);
    }

    public function createOwp(Request $request){
        if (auth()->check()){   
            $incomingFields = $request->validate([
                'name' => 'required',
                'desc' => 'required',
                'image' => 'required',
                'url_instagram' => 'required',
                'url_linkedin' => 'required' 
            ]);

            if($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('owner_profile', 'public');
                ImageController::compressImage($imagePath);
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['desc'] = strip_tags($incomingFields['desc']);
            $incomingFields['desc'] = filter_var($incomingFields['url_instagram']);
            $incomingFields['url_instagram'] = filter_var($incomingFields['url_linkedin']);
            $incomingFields['user_id'] = auth()->id();
            ownerProfile::create($incomingFields);
            return Redirect("/dashboard");
        }
        
        return redirect('/');
    }

    public function showEditScreen(ownerProfile $owp){
        if (auth()->id() == $owp['user_id']){
            return view('edit-owner-profile', ['owp' => $owp]);
        }
        
        return redirect('/');
    }

    public function updateOwp(ownerProfile $owp, Request $request){
        if (auth()->id() == $owp['user_id']){
            $incomingFields = $request->validate([
                'name' => 'required',
                'desc' => 'required',
                'image' => 'required',
                'url_instagram' => 'required',
                'url_linkedin' => 'required' 
            ]);

            if($request->hasFile('image')) {
                Storage::disk('public')->delete($owp->image);
                $imagePath = $request->file('image')->store('services', 'public');
                ImageController::compressImage($imagePath);
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['name'] = strip_tags($incomingFields['name']);
            $incomingFields['desc'] = strip_tags($incomingFields['desc']);
            $incomingFields['desc'] = filter_var($incomingFields['url_instagram']);
            $incomingFields['url_instagram'] = filter_var($incomingFields['url_linkedin']);

            $owp->update($incomingFields);
            
            return redirect('/dashboard');
        }
        
        return redirect('/');
    }

    public function deleteOwp(ownerProfile $owp){
        if (auth()->id() == $owp['user_id']){
            $owp->delete();
            Storage::disk('public')->delete($owp->image);
        }
        
        return redirect('/dashboard');
    }
}
