<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request){
        $IncomingFields = $request->validate([
            'loginname' => ['required'],
            'loginpassword' => ['required']
        ]);

        if (auth()->guard()->attempt(['name' => $IncomingFields['loginname'], 'password' => $IncomingFields['loginpassword']])){
            $request->session()->regenerate();
        }

        return redirect('/dashboard');
    }

    public function redirectDashboard(){
        return view('dashboard');
    }
    
    public function logout(){
        @auth()->guard()->logout();
        return redirect('/');
    }
    
    public function register(Request $request){
        $IncomingFields = $request->validate([
            "name" => ["required", "min:3"],
            "password" => ["required", "min:8"],
        ]);

    $IncomingFields['password'] = bcrypt($IncomingFields['password']);
    $IncomingFields['email'] = 'kilaubuild@gmail.com';
    // $admin = User::create($IncomingFields);
    // auth()->guard()->login($admin);
    return response()->json(['status' => 'success']);
    }


}
