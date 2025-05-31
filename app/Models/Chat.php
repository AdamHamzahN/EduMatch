<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['room_chat_id', 'user_id', 'pesan'];

    public function roomChat()
    {
        return $this->belongsTo(RoomChat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
