<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function daftarGuru(){
        return view('admin.daftar-guru');
    }

    public function daftarMurid(){
        return view('admin.daftar-murid');
    }
}
