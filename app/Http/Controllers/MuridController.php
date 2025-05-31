<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Guru;
use App\Models\Murid;
use App\Models\Request as ModelsRequest;
use App\Models\RoomChat;
use Illuminate\Http\Request;

class MuridController extends Controller
{
    public function dashboard(Request $request)
    {
        $search = $request->query('search');

        $daftar_guru = Guru::when($search, function ($query, $search) {
            $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('lokasi', 'like', '%' . $search . '%')
                ->orWhere('keahlian', 'like', '%' . $search . '%');
        })->get();

        $selected_guru = null;
        if ($request->has('detail-guru')) {
            $selected_guru = Guru::find($request->query('detail-guru'));
        }
        $data =  [
            'daftar_guru' => $daftar_guru,
            'selected_guru' => $selected_guru,
            'search' => $search,
            'user_id' => $request->user_id,
            'murid_id' => Murid::where('user_id', $request->user_id)->value('id')
        ];

        return view('murid.dashboard', $data);
    }

    public function permintaan(Request $request)
    {
        $murid_id = Murid::where('user_id', $request->user_id)->value('id');
        $selected_permintaan_id = $request->query('permintaan');

        $data = [
            'user_id'=>$request->user_id,
            'murid_id' => $murid_id,
            'daftar_permintaan' => ModelsRequest::where('murid_id', $murid_id)->get(),
            'selected_permintaan' => $selected_permintaan_id
                ? ModelsRequest::with('guru')->find($selected_permintaan_id)
                : null,
        ];

        return view('murid.permintaan', $data);
    }

    public function chat(Request $request)
    {
        if ($request->has('room_id')) {
            $room_id = $request->query('room_id');
            $room_status = RoomChat::where('id',$room_id)->value('status');
            $chat = Chat::where('room_chat_id', $room_id)->get();
        } else {
            $room_id = null;
            $chat = null;
        }

        $murid_id = Murid::where('user_id', $request->user_id)->value('id');
        $data = [
            'user_id' => $request->user_id,
            'room_chat' => RoomChat::with('guru')->where('murid_id', $murid_id)->get(),
            'room_id' => $room_id,
            'chats' => $chat,
            'room_status'=>$room_status
        ];
        return view('murid.chat', $data);
    }
}
