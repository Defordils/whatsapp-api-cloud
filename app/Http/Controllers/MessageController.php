<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="Messages")
 */
class MessageController extends Controller
{
/**
 * @OA\Post(
 *     path="/api/message/send",
 *     tags={"Messages"},
 *     summary="Send a message",
 *     description="Send a text or file attachment to chatroom.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"chatroom_id", "message"},
 *             @OA\Property(property="chatroom_id", type="integer", example=1),
 *             @OA\Property(property="message", type="string", example="Hello world"),
 *             @OA\Property(property="attachment", type="string", format="binary", example="file.jpg")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Message sent successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="chatroom_id", type="integer", example=1),
 *             @OA\Property(property="user_id", type="integer", example=2),
 *             @OA\Property(property="message", type="string", example="Hello world"),
 *             @OA\Property(property="attachment_path", type="string", example="file.jpg")
 *         )
 *     ),
 *     @OA\Response(response=400, description="Validation error")
 * )
 */
public function sendMessage(Request $request)
{
    $request->validate([
        'chatroom_id' => 'required|exists:chatrooms,id',
        'message' => 'nullable|string',
        'attachment' => 'nullable|file',
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

    return response()->json($message, 201);
}

/**
 * @OA\Get(
 *     path="/api/message/chatroom/{id}/messages",
 *     tags={"Messages"},
 *     summary="List messages in a chatroom",
 *     description="Retrieve all messages for a specific chatroom.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Chatroom ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of messages returned",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Message")
 *         )
 *     )
 * )
 */
public function listMessage($chatroomId)
{
    $messages = Message::where('chatroom_id', $chatroomId)->paginate(10);

    return response()->json($messages);
}

}