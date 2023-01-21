<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFacility extends Model
{
    use HasFactory;

    // protected $table = 'room_facilities';
    
    protected $guarded = [];

    public $timestamps = false;

    protected $with = ['facility'];

    protected $fillable = [
    	'facility_id', 'quantity', 'room_id'
    ];

    public function facility() {
        return $this->belongsTo(Facility::class);
    }
    
    public function room() {
        return $this->belongsTo(Room::class);
    }
}
