<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function feedbacks() {
        return $this->hasMany(Feedback::class);
    }
    
    public function booking() {
        return $this->hasMany(Booking::class);
    }
    
    public function division() {
        return $this->belongsTo(Division::class);
    }
}
