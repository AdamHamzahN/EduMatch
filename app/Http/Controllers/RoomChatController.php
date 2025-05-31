<?php

namespace App\Http\Controllers;

use App\Models\RoomChat;
use Illuminate\Http\Request;

class RoomChatController extends Controller
{
    public function selesai(Request $request)
    {
        RoomChat::where('id', $request->room_chat_id)->update([
            'status' => 'deal'
        ]);

        return back();
    }
}
