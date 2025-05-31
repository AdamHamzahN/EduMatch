<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';
    protected $primaryKey = 'id';
    protected $fillable = ['guru_id', 'murid_id', 'pesan', 'status'];
    public $timestamps = true;

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
        public function murid()
    {
        return $this->belongsTo(Murid::class);
    }}
