<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ImageUploadController;
use App\Models\Furparents;
use App\Models\Thread;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home', [
        'isShowNavBar' => true,
        'isShowFooter' => true,
    ]);
})->name('home');

Route::get('/about', function () {
    return view('about', [
        'isShowNavBar' => true,
        'isShowFooter' => true,
    ]);
})->name('about');

Route::get('/contact', function () {
    return view('contact', [
        'isShowNavBar' => true,
        'isShowFooter' => false,
    ]);
})->name('contact');

// Signup Routes
Route::middleware(['web'])->group(function () {
    Route::get('/signup', function () {
        return view('signup', [
            'isShowNavBar' => false,
            'isShowFooter' => false,
        ]);
    })->name('signup');

    // Step 1: Furparents form route
    Route::post('/signup.furparent', [RegistrationController::class, 'storeFurparent'])->name('signup.furparent');

    // Step 3: Handle Furbaby form submission
    Route::post('/signup.store', [RegistrationController::class, 'store'])->name('signup.store');
    
    
    Route::get('/signup.back', [RegistrationController::class, 'showFurparentForm'])->name('signup.back');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AccountController::class, 'index'])->name('profile');
    Route::post('/profile.update', [AccountController::class, 'update'])->name('profile.update');
});

// Profile Route

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Logout Routes
Route::get('/logout', [AuthController::class, 'gotoLogout'])->name('logout')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.submit')->middleware('auth');

// Community Route
Route::get('/community', function () {
    return view('community', ['furparents' => Furparents::query()->where('id', '!=', session('user.furparentID'))->get()]);
})->name('community')->middleware('auth');

Route::post('/image.upload', [ImageUploadController::class, 'uploadImage'])->name('image.upload');

Route::post('/broadcasting/auth', function (Request $request) {
    return auth()->check() ? response()->json(auth()->user()->id) : abort(403);
})->middleware('auth');;
Route::post('/pusher/auth', function (Request $request) {
    if (auth()->check()) {
        // Retrieve the socket_id and channel_name from the request
        $socket_id = $request->input('socket_id');
        $channel_name = $request->input('channel_name');

        // Concatenate the socket_id and channel_name
        $string_to_sign = $socket_id . ':' . $channel_name;

        // Generate the HMAC SHA256 hash using your Pusher app secret
        $app_secret = '08ca3518d89fd2f91ebc';  // Replace with your actual Pusher app secret
        $signature = hash_hmac('sha256', $string_to_sign, $app_secret);

        // Format the response with the app key and generated signature
        $app_key = '779fb510a04cfb256485';  // Replace with your actual Pusher app key
        $auth_string = $app_key . ':' . $signature;

        // Return the signature in the required format
        return response()->json([
            'auth' => $auth_string
        ]);  // Laravel generates the auth signature automatically
    }
})->middleware('auth');;