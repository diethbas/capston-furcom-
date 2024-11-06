<?php

namespace App\Http\Controllers;

use App\Models\Furbabies;
use App\Models\Medias;
use Exception;
use Illuminate\Http\Request;

class FurbabiesController extends Controller
{
    public function newFurbaby(Request $request) {
        try{
            
            $request->validate([
                'furbaby_name' => 'required|string|max:255',
                'furbaby_age' => 'required|integer|min:0',
                'furbaby_description' => 'nullable|string',
                'furbaby_profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000', 
            ]);

            $imagePath = '/';
            if ($request->hasFile('furbaby_profile_pic')) {
                $imageName = time() . '.' . $request->furbaby_profile_pic->extension();
                $request->furbaby_profile_pic->move(public_path('images'), $imageName);

                $imagePath = '/images/' . $imageName;
            }
            
            Furbabies::create([
                'furparentID' => session('user.furparentID'),
                'name' => $request->input('furbaby_name'),
                'age' => $request->input('furbaby_age'),
                'img' => $imagePath,
                'ismissing' => false,
                'description' => $request->input('furbaby_description'),
            ]);


            // Redirect and Flashing a success message
            $success = 'new baby added';
            return redirect()->route('profile')
            ->with('success', $success)
            ->with('successMessage', 'You have successfully added a new furbaby.');
        }
        catch(Exception $error){
            dd($error);
        }
    } 

    public function uploadMedia(Request $request)
    {
        try {
            $request->validate([
                'furbabyID' => 'required|integer|min:0',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
            ]);

            $imagePath = '/';
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);

                $imagePath = '/images/' . $imageName;
            }

            Medias::create([
                'furbabyID' => $request->furbabyID,
                'img' => $imagePath,
            ]);

            return response()->json([
                'success' => true
            ], 200);

        }
        catch(Exception $error){
            dd($error);
        }
        
    }

    public function deleteMedia($id) {
        $row = Medias::query()->where('mediaID', $id)->delete();
        
        return response()->json([
            'success' => true,
            'media' => $row
        ], 200);
    }
    
    public function getMediasByFurbaby($id){
        $medias = Medias::query()->where('furbabyID', $id)->get(['furbabyID', 'img', 'mediaID']);

        $items = [];
        foreach ($medias as $item) {
            $new = [
                'img' => $item->img,
                'mediaID' => $item->mediaID
            ];
            $items[] = $new;
        }
        
        return response()->json([
            'success' => true,
            'medias' => $items
        ], 200);
    }

    public function removeFurbaby($id){
        $furbaby = Furbabies::query()->where('furbabyID', $id)->delete();
        return response()->json([
            'success' => true,
            'furbaby' => $furbaby
        ], 200);
    }

    public function getFurbaby($id){
        $furbaby = Furbabies::query()->where('furbabyID', $id)->first(['furbabyID', 'furparentID', 'name', 'age', 'description', 'img', 'ismissing']);
        
        return response()->json([
            'success' => true,
            'furbaby' => $furbaby
        ], 200);
    }

    public function tagAsMissingOrFound($id){
        $furbaby = Furbabies::query()->where('furbabyID', $id)->first(['furbabyID', 'name', 'age', 'description', 'img', 'ismissing']);
        
        if ($furbaby){
            $furbaby = Furbabies::where('furbabyID', $id)
            ->update(['ismissing' => !$furbaby->ismissing]);

            $furbaby = Furbabies::query()->where('furbabyID', $id)->first(['furbabyID', 'name', 'age', 'description', 'img', 'ismissing']);
        }
        return response()->json([
            'success' => true,
            'furbaby' => $furbaby
        ], 200);
    }
    public function getFurbabies($id) {
        $furbabies = Furbabies::where('furparentID', $id)
        ->latest()
        ->get(['furbabyID', 'name', 'age', 'description', 'img', 'ismissing']);

        $items = [];
        foreach ($furbabies as $item) {
            $item = [
                'furbabyID' => $item->furbabyID,
                'name' => $item->name,
                'age' => $item->age,
                'description' => $item->description,
                'img' => $item->img,
                'ismissing' => $item->ismissing,
            ];
            $items[] = $item;
        }
        return $items;
    }
}
