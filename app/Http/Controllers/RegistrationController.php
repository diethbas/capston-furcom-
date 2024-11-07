<?php

namespace App\Http\Controllers;

use App\Models\Furbabies;
use App\Models\Furparents;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    // Step 1: Store Furparent Data in Session
    public function storeFurparent(Request $request)
    {
        // Validate the furparent form data
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:furparents,email',
            'mobile_number' => 'required|unique:furparents,mobile_number',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
        ]);

        // Store validated Furparent data in session
        session()->put('furparent', $validatedData);
        // Setting a flag in the session, next step
        session()->put('isFurbabyForm', true);

        return redirect()->route('signup');
    }

    // Step 2: Store Furbaby and Furparent in Database
    public function store(Request $request)
    {
        // Validate the furbaby form data
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        // Retrieve furparent data from session
        $furparentData = session('furparent');
        // Checking if furparent data exists
        if (!$furparentData) {
            return redirect()->route('signup.furparent')->withErrors('Please complete Step 1 before continuing.');
        }

        $img = "/";

        // Create the furparent record
        $furparent = Furparents::create([
            'firstname' => $furparentData['firstname'],
            'lastname' => $furparentData['lastname'],
            'email' => $furparentData['email'],
            'mobile_number' => $furparentData['mobile_number'],
            'city' => $furparentData['city'],
            'province' => $furparentData['province'],
            'img' => $img,
            'password' => Hash::make($furparentData['password']),
        ]);

        // Create the furbaby record linked to the furparent
        Furbabies::create([
            'furparentID' => $furparent->id,
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'img' => $img,
            'ismissing' => false,
            'description' => $request->input('description'),
        ]);

        // Clear session data after saving
        session()->forget('furparent');
        session()->forget('isFurbabyForm');

        // Redirect to the profile page with a success message
        return redirect()->route('profile')->with('success', 'Registration successful! Welcome to the Furparent family.');
    }

    // Resetting the Registration Flow
    public function showFurparentForm()
    {
        session()->forget('isFurbabyForm');
        return redirect()->route('signup');
    }
}
