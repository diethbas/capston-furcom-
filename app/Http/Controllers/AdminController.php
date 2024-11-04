<?php

namespace App\Http\Controllers;

use App\Models\Furbabies;
use App\Models\Furparents;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Furbabies Functions
    public function fetchFurbabies()
    {
        return response()->json(
            Furbabies::with('furparent')
                ->selectRaw('furbabies.*, CONCAT(furparents.firstname, " ", furparents.lastname) as furparent_name')
                ->join('furparents', 'furbabies.furparentID', '=', 'furparents.id')
                ->get()
        );
    }

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

    public function deleteFurbaby($id)
    {
        Furbabies::destroy($id);
        return response()->json(['success' => true]);
    }

    // Furparents Functions
    public function fetchFurparents()
    {
        return response()->json(Furparents::all());
    }

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
            // Include other fields as necessary
        ]);

        // Hash the password before saving
        $request->merge(['password' => Hash::make($request->password)]);
        Furparents::create($request->all());
        return response()->json(['success' => true]);
    }

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

    public function deleteFurparent($id)
    {
        Furparents::destroy($id);
        return response()->json(['success' => true]);
    }
}
