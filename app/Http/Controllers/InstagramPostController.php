<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstagramPost;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ImageController;

class InstagramPostController extends Controller
{
    public function index(){
        $posts = InstagramPost::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }
    
    public function store(Request $request){
        if (auth()->check()){       
            $incomingFields = $request->validate([
                'title' => 'required',
                'instagram_url' => 'required',
                'image' => 'required'
            ]);

            if($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('instagram_posts', 'public');
                ImageController::compressImage($imagePath);
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['title'] = strip_tags($incomingFields['title']);
            $incomingFields['instagram_url'] = filter_var($incomingFields['instagram_url']);
            $incomingFields['user_id'] = auth()->id();
            
            $post = InstagramPost::create($incomingFields);
            return response()->json([
                'success' => true,
                'message' => 'Post berhasil dibuat',
                'data' => $post
            ]);
        }
    }

    public function update(InstagramPost $post, Request $request){
        if (auth()->id() == $post['user_id']){
            $incomingFields = $request->validate([
                'title' => 'required',
                'instagram_url' => 'required'
            ]);

            if($request->hasFile('image')) {
                Storage::disk('public')->delete($post->image);
                $imagePath = $request->file('image')->store('instagram_posts', 'public');
                ImageController::compressImage($imagePath);
                $incomingFields['image'] = $imagePath;
            }

            $incomingFields['title'] = strip_tags($incomingFields['title']);
            $incomingFields['instagram_url'] = strip_tags($incomingFields['instagram_url']);
            $incomingFields['di_homepage'] = $request->has('di_homepage');

            $post->update($incomingFields);
            
            return response()->json([
                'success' => true,
                'message' => 'Post berhasil diperbarui',
                'data' => $post
            ]);
        }
    }

    public function destroy(InstagramPost $post){
        if (auth()->id() == $post['user_id']){
            $post->delete();
            Storage::disk('public')->delete($post->image);
        
            return response()->json([
                'success' => true,
                'message' => 'Post berhasil dihapus',
                'data' => $post
            ]);
        }
    }
}