<?php

namespace App\Http\Controllers;

use App\Models\Furbabies;
use App\Models\Furparents;
use App\Models\Threads;
use App\Models\Troops;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //Retrieving Furbabies and their Furparents
    public function fetchFurbabies()
    {
        return response()->json(
            Furbabies::with('furparent')
                ->selectRaw('furbabies.*, CONCAT(furparents.firstname, " ", furparents.lastname) as furparent_name')
                ->join('furparents', 'furbabies.furparentID', '=', 'furparents.id')
                ->get()
        );
    }
    //Adding a New Furbaby
    public function addFurbaby(Request $request)
    {
        $request->validate([
            'furparentID' => 'required|integer',
            'name' => 'required|string',
            'age' => 'required|integer',
            'description' => 'nullable|string',
            'img' => 'nullable|string',
            'ismissing' => 'required|boolean',
        ]);

        Furbabies::create($request->all());
        return response()->json(['success' => true]);
    }
    // Editing an Existing Furbaby
    public function editFurbaby($id, Request $request)
    {
        try {
            $furbaby = Furbabies::findOrFail($id);
            $request->validate([
                'furparentID' => 'required|integer',
                'name' => 'required|string',
                'age' => 'required|integer',
                'description' => 'nullable|string',
                'img' => 'nullable|string',
                'ismissing' => 'required|boolean',
            ]);

            $furbaby->update($request->all());
            return response()->json(['success' => true]);
        } catch (Exception $error) {
            dd($error);
        }
    }
    //Deleting a Furbaby
    public function deleteFurbaby($id)
    {
        Furbabies::destroy($id);
        return response()->json(['success' => true]);
    }

    //Retrieving All Furparents
    public function fetchFurparents()
    {
        return response()->json(Furparents::all());
    }
    //Adding a New Furparent
    public function addFurparent(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'mobile_number' => 'nullable|string',
            'city' => 'nullable|string',
            'province' => 'nullable|string',
            'password' => 'required|string',
            'admin_access' => 'required|boolean',
            'img' => 'nullable|string',
            // Include other fields as necessary
        ]);

        // Hash the password before saving
        $request->merge(['password' => Hash::make($request->password)]);
        Furparents::create($request->all());
        return response()->json(['success' => true]);
    }
    //Editing an Existing Furparent
    public function editFurparent($id, Request $request)
    {
        try {
            $furparent = Furparents::findOrFail($id);
            $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|email',
                'mobile_number' => 'nullable|string',
                'city' => 'nullable|string',
                'province' => 'nullable|string',
                'admin_access' => 'required|boolean',
                'img' => 'nullable|string',
                // Validate other fields as necessary
            ]);

            // Optionally update password
            if ($request->filled('password')) {
                $request->merge(['password' => Hash::make($request->password)]);
            }
            $furparent->update($request->all());
            return response()->json(['success' => true]);
        } catch (Exception $error) {
            dd($error);
        }
    }
    //Deleting a Furparent
    public function deleteFurparent($id)
    {
        Furparents::destroy($id);

        Troops::where('friend_id', $id)->delete();

        Threads::where('recipientID1', $id)
        ->orWhere('recipientID2', $id)
        ->delete();
        
        return response()->json(['success' => true]);
    }
}
