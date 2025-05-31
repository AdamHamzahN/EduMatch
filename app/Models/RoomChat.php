<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomChat extends Model
{
    protected $fillable = ['guru_id', 'murid_id', 'status'];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function murid()
    {
        return $this->belongsTo(Murid::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function users()
    {
        return User::whereIn('id', [
            $this->guru->user_id,
            $this->murid->user_id
        ])->get();
    }
}
