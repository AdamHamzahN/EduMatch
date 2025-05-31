<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'gurus';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'nama', 'lokasi','keahlian','profile_singkat','foto_profile','foto_ktp'];
    public $timestamps = true;
}
