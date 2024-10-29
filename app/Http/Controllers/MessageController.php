<?php

namespace App\Http\Controllers;
use App\Models\Messages;
use App\Events\MessageSent;
use App\Models\Threads;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Creates a thread between authenticated user and other user 
    public function getThread(Request $request, $talkToID){
        $sendToID = $talkToID;
        $senderID = auth()->id();
        // Finding or Creating the Thread
        $thread = Threads::query()->where(function($query) use($sendToID) {
            $query->where('recipientID1', $sendToID)
            ->orWhere('recipientID2', $sendToID);
        })
        ->where(function($query) use($senderID) {
            $query->where('recipientID1', $senderID)
            ->orWhere('recipientID2', $senderID);
        })
        ->first();    
        // Creating a Thread if None Exists:
        if (!$thread) {
            // Create the message in the database
            $thread = Threads::create([
                'recipientID1' => $sendToID,
                'recipientID2' => $senderID
            ]);
        }

        // Return the messages as JSON
        return response()->json([
            'success' => true,
            'thread' => $thread
        ], 200);
    }

    // Retrieves the most recent 50 messages
    public function getMessages(Request $request, $threadID){
        $latestMessages = Messages::where('threadID', $threadID)  // Filter by thread ID
        ->latest()  // Order by latest first
        ->take(50)  // Limit to the latest 50 messages
        ->get();

        // Return the messages as JSON
        return response()->json([
            'success' => true,
            'messages' => $latestMessages
        ], 200);
    }


    public function sendMessage(Request $request)
    {
        // Validate the request
        $request->validate([
            'message' => 'required',
            'sendTo' => 'required|exists:furparents,id',
        ]);
        // Finding or Creating a Thread:
        $sendToID = $request->sendTo;
        $senderID = auth()->id();
        $thread = Threads::query()->where(function($query) use($sendToID) {
            $query->where('recipientID1', $sendToID)
            ->orWhere('recipientID2', $sendToID);
        })
        ->where(function($query) use($senderID) {
            $query->where('recipientID1', $senderID)
            ->orWhere('recipientID2', $senderID);
        })
        ->first();    
        // Creating a Message
        if ($thread) {
            // Create the message in the database
            $message = Messages::create([
                'threadID' => $thread->threadID,
                'senderID' => $senderID,
                'message' => $request->message,
                'date' => now()
            ]);
        }
        else {
            // Create the message in the database
            $thread = Threads::create([
                'recipientID1' => $sendToID,
                'recipientID2' => $senderID
            ]);

            $message = Messages::create([
                'threadID' => $thread->threadID,
                'senderID' => $senderID,
                'message' => $request->message
            ]);
        }

        // Broadcast the MessageSent event to all users except the sender
        event(new MessageSent($request->message, $senderID, $thread->threadID, now(), $sendToID, session('user.firstname'), session('user.lastname')));

        // Return the created message as a response
        return response()->json(['message' => $message], 201);
    }
}
