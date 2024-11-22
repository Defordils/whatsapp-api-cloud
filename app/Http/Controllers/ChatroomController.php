<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use Illuminate\Http\Request;

class ChatroomController extends Controller
{
    public function create(Request $request)
    {
        $chatroom = Chatroom::create(['name' => $request->name, 'max_members' => $request->max_members]);
        return response()->json($chatroom);
    }

    public function list()
    {
        return Chatroom::paginate(10);
    }
}
