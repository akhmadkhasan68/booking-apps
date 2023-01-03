<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFacility extends Model
{
    use HasFactory;

    protected $table = 'room_facilities';
    
    protected $guarded = [];

    protected $with = ['facility'];

    public function facility() {
        return $this->belongsTo(Facility::class);
    }
    
    public function room() {
        return $this->belongsTo(Room::class);
    }
}
