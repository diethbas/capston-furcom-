<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\FurbabiesController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\QRCodeController;
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
    if (auth()->check() && !request()->query('qrProfile')){
        return redirect()->route('profile');
    }
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

Route::get('/marketplace', function () {
    return view('marketplace', [
        'isShowNavBar' => true,
        'isShowFooter' => true,
    ]);
})->name('marketplace')->middleware('auth');

Route::get('/contact', function () {
    return view('contact', [
        'isShowNavBar' => true,
        'isShowFooter' => false,
    ]);
})->name('contact');


Route::middleware(['web'])->group(function () {
    Route::get('/signup', function () {
        return view('signup', [
            'isShowNavBar' => false,
            'isShowFooter' => false,
        ]);
    })->name('signup');


    Route::post('/signup.furparent', [RegistrationController::class, 'storeFurparent'])->name('signup.furparent');

    
    Route::post('/signup.store', [RegistrationController::class, 'store'])->name('signup.store');
    
    
    Route::get('/signup.back', [RegistrationController::class, 'showFurparentForm'])->name('signup.back');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AccountController::class, 'index'])->name('profile');
    Route::get('/profile/{id}', [AccountController::class, 'publicProfile'])->name('profilepublic');
    Route::post('/profile.update', [AccountController::class, 'update'])->name('profile.update');
    Route::post('/follow/{id}', [AccountController::class, 'follow'])->name('profile.follow');
    Route::post('/unfollow/{id}', [AccountController::class, 'unfollow'])->name('profile.unfollow');
    Route::get('/furparent/search/{query}', [AccountController::class, 'findFurparent'])->name('profile.findFurparent');
    Route::get('/furparent/search', [AccountController::class, 'searchDefault'])->name('profile.searchDefault');
    Route::get('/message/tag/read', [AccountController::class, 'tagReadMsg'])->name('message.read');
    Route::get('/notif/tag/read', [AccountController::class, 'tagReadNotif'])->name('notif.read');

    
    Route::get('/furbaby/delete/{id}', [FurbabiesController::class, 'removeFurbaby'])->name('furbaby.delete');
    Route::get('/furbaby/missingTag/{id}', [FurbabiesController::class, 'tagAsMissingOrFound'])->name('furbaby.missing');
    Route::post('/furbaby/upload', [FurbabiesController::class, 'uploadMedia'])->name('media.upload');
    Route::post('/image.upload', [ImageUploadController::class, 'uploadImage'])->name('image.upload');
    Route::post('/image.upload.pet', [ImageUploadController::class, 'uploadImagePet'])->name('image.upload.pet');
    Route::post('/media/delete/{id}', [FurbabiesController::class, 'deleteMedia'])->name('media.delete');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


Route::get('/logout', [AuthController::class, 'gotoLogout'])->name('logout')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.submit')->middleware('auth');


Route::get('/community', [AccountController::class, 'community'])->name('profile.community')->middleware('auth');

Route::get('/furbaby/{id}', [FurbabiesController::class, 'getFurbaby'])->name('furbaby.getById');

Route::get('/furbaby/medias/{id}', [FurbabiesController::class, 'getMediasByFurbaby'])->name('furbaby.medias');

Route::post('/furbaby/add', [FurbabiesController::class, 'newFurbaby'])->name('furbaby.add');

Route::post('/broadcasting/auth', function (Request $request) {
    return auth()->check() ? response()->json(auth()->user()->id) : abort(403);
})->middleware('auth');

Route::get('/qr', [QRCodeController::class, 'generate']);
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
})->middleware('auth');

Route::get('/admin', function () {
    return redirect()->route('admin.furparents');
})->middleware('auth');

Route::get('/admin/furbabies', function () {
    
    if (auth()->check() && !auth()->user()->admin_access){
        return redirect()->route('profile');
    }
    return view('admin_furbaby',[
        'isNoSidebar' => true
    ]);
})->name('admin.furbabies')->middleware('auth');


Route::get('/admin/furparents', function () {
    if (auth()->check() && !auth()->user()->admin_access){
        return redirect()->route('profile');
    }
    return view('admin_furparent',[
        'isNoSidebar' => true
    ]);
})->name('admin.furparents')->middleware('auth');