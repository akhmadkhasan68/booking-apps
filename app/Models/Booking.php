<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function member() {
        return $this->belongsTo(Member::class);
    }
    
    public function room() {
        return $this->belongsTo(Room::class);
    }
}
