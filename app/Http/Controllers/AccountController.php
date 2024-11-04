<?php

namespace App\Http\Controllers;
use App\Models\Messages;
use App\Events\MessageSent;
use App\Models\Furparents;
use App\Models\Medias;
use App\Models\Notifications;
use App\Models\Threads;
use App\Models\Troops;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
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
        
        $troopList = $this->getTroopList($id);
        $notifications = $this->getNotifications($id);
        $unreadNotifCount = count(array_filter($notifications, function($item) {
            return !$item['isread']; // Check if isread is false
        }));
        $messages = $this->getMessages($id);
        $unreadMessageCount = count(array_filter($messages, function($item) {
            return !$item['isread'] && $item['isread'] == session('user.furparentID'); // Check if isread is false
        }));

        $furbabiesController = new FurbabiesController();
        $furbabies = $furbabiesController->getFurbabies($id);
        $medias = $this->getMediasByFurparent($id);
        return view('profile')
        ->with('id', $id)
        ->with('firstname', $firstname)
        ->with('lastname', $lastname)
        ->with('img', $img)
        ->with('email', $email)
        ->with('troop', $troopList)
        ->with('notifications', $notifications)
        ->with('notificationUnreadCount', $unreadNotifCount)
        ->with('messages', $messages)
        ->with('messageUnreadCount', $unreadMessageCount)
        ->with('furbabies', $furbabies)
        ->with('medias', $medias);
    }
    public function tagReadNotif(){
        
        $userId = session('user.furparentID');
        $affectedRows = Notifications::where('furparentID', $userId)
        ->where('isread', false)
        ->update(['isread' => true]);

        return response()->json([
            'success' => true,
            'affected' => $userId
        ], 200);
    }
    public function tagReadMsg(){
        $userId = session('user.furparentID');
        $affectedRows = Threads::where('isreadTo', $userId)->update([
            'isread' => true
        ]);
        return response()->json([
            'success' => true,
            'affected' => $affectedRows
        ], 200);
    }

    public function community() {         
        $id = session('user.furparentID');
        $notifications = $this->getNotifications($id);
        $unreadNotifCount = count(array_filter($notifications, function($item) {
            return !$item['isread']; // Check if isread is false
        }));
        $messages = $this->getMessages($id);
        $unreadMessageCount = count(array_filter($messages, function($item) {
            return !$item['isread'] && $item['isread'] == session('user.furparentID'); // Check if isread is false
        }));
        $medias = $this->getMediasByFurparent($id);
        return view('community')
        ->with('furparents', Furparents::query()->where('id', '!=', session('user.furparentID'))->get())
        ->with('notifications', $notifications)
        ->with('notificationUnreadCount', $unreadNotifCount)
        ->with('messages', $messages)
        ->with('messageUnreadCount', $unreadMessageCount)
        ->with('medias', $medias);
    }


    public function publicProfile($id){
        
        $furparent = Furparents::where('id', $id)->first();
        
        $furbabiesController = new FurbabiesController();
        $furbabies = $furbabiesController->getFurbabies($id);
        
        if ($furparent) {
            if (session('user.furparentID') && $furparent->id == session('user.furparentID')) {
                return redirect()->route('profile');
            }
            else {
                $isfollow = false;
                $notifications = [];
                $unreadNotifCount = 0;
                $messages = [];
                $unreadMessageCount = 0;
                $medias = [];
                if (session('user.furparentID')) {
                    $get = Troops::where('furparent_id', session('user.furparentID'))
                    ->where('friend_id', $furparent->id)
                    ->first();

                    if ($get && $get->id > 0) {
                        $isfollow = true;
                    }                
                    $notifications = $this->getNotifications(session('user.furparentID'));
                    $unreadNotifCount = count(array_filter($notifications, function($item) {
                        return !$item['isread']; // Check if isread is false
                    }));
                    $messages = $this->getMessages(session('user.furparentID'));
                    $unreadMessageCount = count(array_filter($messages, function($item) {
                        return !$item['isread'] && $item['isread'] == session('user.furparentID'); // Check if isread is false
                    }));
                    $medias = $this->getMediasByFurparent($id);
                }

                $troopList = $this->getTroopList($furparent->id);
                return view('profilepublic')
                ->with('id', $furparent->id)
                ->with('firstname', $furparent->firstname)
                ->with('lastname', $furparent->lastname)
                ->with('img', $furparent->img)
                ->with('email', $furparent->email)
                ->with('isfollow', $isfollow)
                ->with('troop', $troopList)
                ->with('notifications', $notifications)
                ->with('notificationUnreadCount', $unreadNotifCount)
                ->with('messages', $messages)
                ->with('messageUnreadCount', $unreadMessageCount)
                ->with('furbabies', $furbabies)
                ->with('medias', $medias);
            }
        }
        else {
            return redirect()->route('home');
        }
    }

    public function follow($id){
        
        if (session('user.furparentID')) {
            $get = Troops::where('furparent_id', session('user.furparentID'))
                        ->where('friend_id', $id)
                        ->first();

            if (!($get && $get->id > 0)) {
                Troops::create([
                    'furparent_id' => session('user.furparentID'),
                    'friend_id' => $id,
                ]);
                $desc = "<a href='/profile/".$id."'><p class='ml-2  text-gray-400 truncate max-w-xs'>".session('user.firstname'). ' '. session('user.lastname')." added you!</p></a>";
                $notif = Notifications::where('description', $desc)
                ->where('furparentID', $id)
                ->first();
                
                if (!$notif){
                    Notifications::create([
                        'description' => $desc,
                        'isread' => false,
                        'furparentID' => $id
                    ]);
                }
            }
        }
        return view()->with('success', true);

    }

    public function unfollow($id){
        
        if (session('user.furparentID')) {
            $get = Troops::where('furparent_id', session('user.furparentID'))
                        ->where('friend_id', $id)
                        ->first();
            if ($get && $get->id > 0) {
                Troops::where('furparent_id', session('user.furparentID'))
                ->where('friend_id', $id)
                ->delete();

                $desc = "<a href='/profile/".$id."'><p class='ml-2  text-gray-400 truncate max-w-xs'>".session('user.firstname'). ' '. session('user.lastname')." added you!</p></a>";
                Notifications::where('description', $desc)
                ->where('furparentID', $id)
                ->delete();
            }
        }
        return view()->with('success', true);
    }
    public function searchDefault() {
        return $this->findFurparent('');
    }
    public function findFurparent($keyword) {
        $search = [];
        if ($keyword){
            $search = Furparents::where('firstname', 'like', '%'.$keyword.'%')
            ->orWhere('lastname', 'like', '%'.$keyword.'%')
            ->orWhere('email', 'like', '%'.$keyword.'%')
            ->orWhere(DB::raw("CONCAT(firstname, ' ', lastname)"), 'like', '%'.$keyword.'%')
            ->select('id', 'firstname', 'lastname', 'email', 'img')
            ->take(8)
            ->get();
        }
        else {
            $search = Furparents::latest()
            ->take(8)
            ->get();
        }
        return response()->json($search, 200);
    }

    public function getTroopList($id) {
        $troops = Troops::query()->where('furparent_id', $id)->get();
        $furparentList = [];
        foreach ($troops as $item) {
            $parent = Furparents::query()->where('id', $item['friend_id'])->first();

            $new = [
                'id' => $parent->id,
                'firstname' => $parent->firstname,
                'lastname' => $parent->lastname,
                'email' => $parent->email,
                'city' => $parent->city,
                'province' => $parent->province,
                'img' => $parent->img,
            ];
            $furparentList[] = $new;
        }
        return $furparentList;
    }

    public function getMediasByFurparent($id){
        DB::enableQueryLog();
        $medias = Medias::select('medias.img', 'medias.mediaID')
            ->latest('medias.created_at')
            ->join('furbabies', 'furbabies.furbabyID', '=', 'medias.furbabyID')
            ->join('furparents', 'furparents.id', '=', 'furbabies.furparentID')
            ->where('furparents.id', $id)
            ->get();

        $items = [];
        foreach ($medias as $item) {
            $new = [
                'img' => $item->img,
                'mediaID' => $item->mediaID
            ];
            $items[] = $new;
        }
        
        // dd(DB::getQueryLog());
        return $items;
    }

    public function getNotifications($id) {
        $notifications = Notifications::where('furparentID', $id)
        ->select('description', 'isread', 'created_at')
        ->latest()
        ->take(10)
        ->get();
        $notifs = [];
        foreach ($notifications as $item) {
            $new = [
                'description' => $item['description'],
                'isread' => $item['isread'],
                'created_at' => $item['created_at'],
            ];
            $notifs[] = $new;
        }
        return $notifs;
    }

    public function getMessages($id) {
        $me = session('user.furparentID');
        $messages = Threads::where(function($query) use($me) {
            $query->where('recipientID1', $me)
            ->orWhere('recipientID2', $me);
        })
        ->has('messages')->with(['latestMessage', 'furparent1', 'furparent2'])
        ->latest() 
        ->take(10)
        ->get();
        $msgs = [];
        foreach ($messages as $item) {
            $latestMessage = $item->latestMessage;
            $furparentTalkTo = null;
            $sender = null;
            if ($item->furparent1->id == session('user.furparentID')){
                $furparentTalkTo = $item->furparent2;
            }
            else {
                $furparentTalkTo = $item->furparent1;
            }
            if ($latestMessage->senderID == $item->furparent1->id){
                $sender = $item->furparent1;
            }
            else {
                $sender = $item->furparent2;
            }
            $new = [
                'isread' => $item->isread, 
                'isreadTo' => $item->isreadTo, 
                'threadID' => $item->threadID,
                'latestMessage' => $latestMessage ? $latestMessage->message : null, 
                'messageID' => $latestMessage ? $latestMessage->messageID : null, 
                'created_at' => $latestMessage ? $latestMessage->created_at : null, 
                'lastMessageIsFromMe' =>  $latestMessage ? $latestMessage->senderID == session('user.furparentID') : false,
                'talkTo_firstname' => $furparentTalkTo->firstname, 
                'talkTo_lastname' => $furparentTalkTo->lastname, 
                'talkTo_id' => $furparentTalkTo->id, 
                'talkTo_email' => $furparentTalkTo->email, 
                'talkTo_img' => $furparentTalkTo->img, 
                'sender_firstname' => $sender->firstname, 
                'sender_lastname' => $sender->lastname, 
                'sender_id' => $sender->id, 
                'sender_email' => $sender->email, 
                'sender_img' => $sender->img, 
            ];
    
            $msgs[] = $new;
        }
        return $msgs;
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
