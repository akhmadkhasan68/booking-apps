<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function feedbacks() {
        return $this->hasMany(Feedback::class);
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function facilities() {
        return $this->hasMany(RoomFacility::class, 'room_id', 'id');
    }
}
