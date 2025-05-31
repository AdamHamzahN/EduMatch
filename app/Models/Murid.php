<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    protected $table = 'murids';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'nama', 'lokasi', 'bidang_keahlian', 'profile_singkat', 'foto_profile', 'foto_kartu_identitas'];
    public $timestamps = true;
}
