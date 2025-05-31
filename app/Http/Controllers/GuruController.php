<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Guru;
use App\Models\Request as ModelsRequest;
use App\Models\RoomChat;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function chat(Request $request)
    {
        if ($request->has('room_id')) {
            $room_id = $request->query('room_id');
            $room_status = RoomChat::where('id',$room_id)->value('status');
            $chat = Chat::where('room_chat_id', $room_id)->get();
        } else {
            $room_id = null;
            $chat = null;
            $room_status = null;
        }

        $guru_id = Guru::where('user_id', $request->user_id)->value('id');
        $data = [
            'user_id' => $request->user_id,
            'room_chat' => RoomChat::with('murid')->where('guru_id', $guru_id)->get(),
            'room_id' => $room_id,
            'chats' => $chat,
            'room_status'=>$room_status
        ];
        return view('guru.chat', $data);
    }

     public function permintaan(Request $request)
    {
        $guru_id = Guru::where('user_id', $request->user_id)->value('id');
        $selected_permintaan_id = $request->query('permintaan');

        $data = [
            'user_id'=>$request->user_id,
            'guru_id' => $guru_id,
            'daftar_permintaan' => ModelsRequest::where('guru_id', $guru_id)->get(),
            'selected_permintaan' => $selected_permintaan_id
                ? ModelsRequest::with('murid')->find($selected_permintaan_id)
                : null,
        ];

        return view('guru.permintaan', $data);
    }
}
