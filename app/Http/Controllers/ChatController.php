<?php

namespace App\Http\Controllers;

use App\Events\ChatSent;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required'],
            'pesan' => ['required'],
            'room_chat_id' => ['required']
        ]);

        $chat = Chat::create($data);
        broadcast(new ChatSent($chat))->toOthers();
        return back();
    }
}
