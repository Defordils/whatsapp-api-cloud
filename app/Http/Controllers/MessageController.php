<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;




class MessageController extends Controller
{
    public function send(Request $request)
    {

        $request->validate([
            'chatroom_id' => 'required|exists:chatrooms, id',
            'message' => 'mullable|string',
            'attachment' => 'nullable|file|max:10240'
        ]);


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

        event(new MessageSent($message));

        return response()->json($message);
    }

    public function list($chatroomId)
    {
        return Message::where('chatroom_id', $chatroomId)->paginate(10);
    }
    
}
