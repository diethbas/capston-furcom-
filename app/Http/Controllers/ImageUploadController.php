<?php

namespace App\Http\Controllers;

use App\Models\Furparents;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        // Validate the image file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000', // 2MB max
        ]);

        // Store the uploaded image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        // Generating the Image URL
        $path = asset('images/' . $imageName);
        // Updating the User’s Profile with the Image URL
        Furparents::where('id', session('user.furparentID'))->update([
            'img' => $path
        ]);
        // Updating the Session with the New Image Path
        session()->put('user.img', $path);
        // Return the image URL as a JSON response
        return response()->json([
            'image_url' => $path
        ]);
    }
}