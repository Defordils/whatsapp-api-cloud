<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;



event(new MessageSent($message));

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $filePath = null;

        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('attachments', 'public');
        }

        $message = Message::create([
            'chatroom_id' => $request->chatroom_id,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'attachment_path' => $filePath,
        ]);

        return response()->json($message);
    }

    public function list($chatroomId)
    {
        return Message::where('chatroom_id', $chatroomId)->paginate(10);
    }
    
}
