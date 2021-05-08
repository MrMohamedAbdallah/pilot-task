<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Show user information on the dashboard
     */
    public function show(){
        $user = Auth::user();

        return view('dashboard', compact('user'));
    }


    /**
     * Update user information
     */
    public function update(Request $request){
        $request->validate([
            'profile_pic'   => 'nullable|image|max:2048',
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone'         => 'required|regex:/(01)[0-9\-]{9}/',
            'job_title'     => 'required|string|min:3',
            'password'      => 'nullable|string|confirmed|min:8',
        ]);

        $user = Auth::user();

        $filePath = $user->profile_pic;

        // Upload user profile picture if there's one and delete if the user requests so
        if($request->delete_pic){

            // Delete the image from the disk
            Storage::delete($filePath);
            
            $filePath = null;
        } else if($request->hasFile('profile_pic')){
            // Delete the old image from the disk
            Storage::delete($filePath);

            $filePath = $request->file('profile_pic')->store('public/avatars');
        }

        $user->update([
            'profile_pic'  => $filePath,
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'         => $request->phone,
            'job_title'    => $request->job_title,
            'password'     => $request->password ? Hash::make($request->password) : $user->password
        ]);

        Session::flash('success', 'Your settings have been updated successfully');

        return redirect()->route('dashboard');
    }
}
