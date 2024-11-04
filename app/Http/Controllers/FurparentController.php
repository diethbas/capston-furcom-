<?php

namespace App\Http\Controllers;

use App\Models\Furbabies;
use App\Models\Furparents;
use App\Models\Troops;
use Illuminate\Http\Request;

class FurparentController extends Controller
{
    // Fetch details of a furparent from the database and returning them as a JSON response.
    public function getDetails($id) {
        $furparent = Furparents::query()->where('id', $id)->first(['firstname', 'lastname', 'img']);
        
        return response()->json([
            'success' => true,
            'furparent' => $furparent
        ], 200);
    }
}
