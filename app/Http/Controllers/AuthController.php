<?php

namespace App\Http\Controllers;

use App\Models\Furparents;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    
    // Show the login form
    public function showLoginForm()
    {
        return view('login',
        [
            'isShowNavBar' => false,
            'isShowFooter' => false,
        ]);
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        
        // Check the user’s credentials.
        $credentials = $request->only('email', 'password');

        // Log the user in by checking their email and password against in the database.
        if (Auth::attempt($credentials)) {
            $furparent = Auth::user();
            $id = auth()->user()->id;

            // Generate a token for the authenticated user stored in the session under the key 't'
            $token = $furparent->createToken('token:'.$request->email.'id:'.$id)->plainTextToken;
            session()->put('t', $token);
            // Stores the user's details
            session()->put('user', [
                'firstname' => auth()->user()->firstname,
                'lastname' => auth()->user()->lastname,
                'img' => auth()->user()->img,
                'furparentID' => auth()->user()->id,
                'email' => auth()->user()->email,
                'mobile_number' => auth()->user()->mobile_number
            ]);

            // Retrieving the latest messages    
            $latestMessage = Messages::select('messages.messageID', 'messages.senderID', 'messages.message', 'messages.created_at', 'furparents.firstname', 'furparents.lastname', 'furparents.img')
            ->join(DB::raw('(SELECT threadID, MAX(created_at) as latest_created FROM messages GROUP BY threadID) latest_messages'), function($join) {
            $join->on('messages.threadID', '=', 'latest_messages.threadID')
                ->on('messages.created_at', '=', 'latest_messages.latest_created');
            })
            ->join('furparents', 'furparents.id', '=', 'messages.senderID')
            ->join('threads', 'threads.threadID', '=', 'messages.threadID')
            ->get()
            ->toArray();
            // Storing latest messages in the session
            session()->put('latestMessage', $latestMessage);
            // Return success JSON response
            return redirect()->route('login')->with('success', 'You have successfully login');
        }

        // Return failure response for invalid credentials
        return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
    }

    // Handle logout request
    public function logout(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Clear the session data
        Session::flush();

        // Redirect to login page
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
    // Initiate the logout process
    public function gotoLogout()
    {
        $request = new Request();
        return $this->logout($request);
    }
}
