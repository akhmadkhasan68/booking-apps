<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeedbackMedia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "feedback_medias";
    protected $guarded = [];

    public function feedback() {
        return $this->belongsTo(Feedback::class);
    }
}
