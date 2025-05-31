<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\RoomChat;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'murid_id' => ['required'],
            'guru_id' => ['required'],
            'pesan' => ['required']
        ]);

        $createrequest = ModelsRequest::create($data);

        if ($createrequest) {
            return redirect()->back()->with('success', 'Permintaan kerjasama berhasil dikirim!');
        }
    }

    public function accepted(Request $request)
    {
        $data = $request->validate([
            'murid_id' => ['required'],
            'guru_id' => ['required'],
        ]);

        $request = ModelsRequest::findOrFail($request->request_id);
        $request->status = 'diterima';
        $accepted = $request->save();

        if ($accepted) {
            RoomChat::create($data);
        }
        return back()->with('success', 'Permintaan berhasil diterima.');
    }

    public function rejected(Request $request)
    {
        $request = ModelsRequest::findOrFail($request->request_id);
        $request->status = 'ditolak';
        $request->save();

        return back()->with('error', 'Permintaan ditolak.');
    }
}
