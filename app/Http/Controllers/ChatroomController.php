<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="Chatrooms")
 */
class ChatroomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @OA\Post(
     *     path="/api/chatroom/create",
     *     tags={"Chatrooms"},
     *     summary="Create a new chatroom",
     *     description="Allows a user to create a chatroom.",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"id", "name", "max_members"},
     *
     *             @OA\Property(property="name", type="string", example="General"),
     *             @OA\Property(property="max_members", type="integer", example=50)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Chatroom created successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="name", type="string", example="General"),
     *             @OA\Property(property="max_members", type="integer", example=50)
     *         )
     *     ),
     *
     *     @OA\Response(response=400, description="Validation error")
     * )
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'max_members' => 'nullable|integer',
        ]);

        $chatroom = Chatroom::create([
            'name' => 'required|string',
            'max_members' => 'nullable|integer',
        ]);

        return response()->json($chatroom, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/chatroom",
     *     tags={"Chatrooms"},
     *     summary="List all chatrooms",
     *     description="Retrieve a list of all chatrooms with pagination.",
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of chatrooms returned",
     *
     *         @OA\JsonContent(
     *             type="array",
     *
     *             @OA\Items(
     *
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="General"),
     *                 @OA\Property(property="max_members", type="integer", example=50)
     *             )
     *         )
     *     )
     * )
     */
    public function list(Request $request)
    {
        $chatrooms = Chatroom::paginate(10);

        return response()->json($chatrooms);
    }

    /**
     * @OA\Post(
     *     path="/api/chatroom/{id}/leave",
     *     tags={"Chatrooms"},
     *     summary="Leave a chatroom",
     *     description="Allows a user to leave a chatroom.",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of the chatroom to leave",
     *         required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="User successfully left the chatroom",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="You have successfully left the chatroom")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Chatroom not found",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="error", type="string", example="Chatroom not found")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="User is not a member of the chatroom",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="error", type="string", example="You are not a member of this chatroom")
     *         )
     *     )
     * )
     */
    public function leave(Request $request, $id)
    {
        $chatroom = Chatroom::findOrFail($id);

        // Assuming the logic for leaving the chatroom is implemented
        return response()->json(['message' => 'Left chatroom successfully']);
    }

    /**
     * @OA\Post(
     *     path="/api/chatroom/{id}/enter",
     *     tags={"Chatrooms"},
     *     summary="Enter a chatroom",
     *     description="Allows a user to join a chatroom.",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Chatroom ID",
     *         required=true,
     *
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Entered chatroom successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Entered chatroom successfully")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Chatroom not found",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="error", type="string", example="Chatroom not found")
     *         )
     *     )
     * )
     */
    public function enter($id)
    {
        $chatroom = Chatroom::findOrFail($id);

        // Assuming the logic for entering the chatroom is implemented
        return response()->json(['message' => 'Entered chatroom successfully']);
    }
}
