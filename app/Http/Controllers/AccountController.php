<?php

namespace App\Http\Controllers;
use App\Models\Messages;
use App\Events\MessageSent;
use App\Models\Furparents;
use App\Models\Threads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    // Show the login form
    public function index(){
        
        $id = session('user.furparentID');
        $firstname = session('user.firstname');
        $lastname = session('user.lastname');
        $img = session('user.img');
        $email = session('user.email');
        
        return view('profile')
        ->with('id', $id)
        ->with('firstname', $firstname)
        ->with('lastname', $lastname)
        ->with('img', $img)
        ->with('email', $email);
    }
    
    // Update user Profile
    public function update(Request $request){
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile_number' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        // Fetch current user’s session data and Update the user’s detail
        $id = session('user.furparentID');
        $firstname = session('user.firstname');
        $lastname = session('user.lastname');
        $img = session('user.img');
        $email = session('user.email');
        $furparent = Furparents::where('id', $id)->update([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'mobile_number' => $validatedData['mobile_number']
        ]);
        
        // Password update 
        if ($validatedData['password'] != '********' ){
            $furparent = Furparents::where('id', $id)->update([
                'password' => Hash::make($validatedData['password']),
            ]);
        }

        // Retrieving updated data
        $furparent = Furparents::where('id', $id)->first();

        // Updating the session
        session()->put('user', [
            'firstname' => $furparent->firstname,
            'lastname' => $furparent->lastname,
            'img' => $furparent->img,
            'furparentID' => $furparent->id,
            'email' => $furparent->email,
            'mobile_number' => $furparent->mobile_number
        ]);
        
        // Redirect and Flashing a success message
        $success = 'updated';
        return redirect()->route('profile')
        ->with('success', $success);
    }
}
