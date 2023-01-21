<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\Console\Helper\Table;

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
        return $this->hasMany(Facility::class);
    }
    public function room_facilities() {
        return $this->hasMany(RoomFacility::class);
    }

    // protected $table = 'rooms';

    // public function facilities()
    // {
    //     return $this->belongsTo(Facility::class, 'id');
    // }

    // public function room_facilities()
    // {
    //     return $this->belongsTo(RoomFacility::class, 'room_id');
    // }
}
