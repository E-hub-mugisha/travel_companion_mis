<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuddyFeedback extends Model
{
    protected $fillable = ['buddy_id', 'user_id', 'rating', 'comment'];

    public function buddy()
    {
        return $this->belongsTo(TravelerProfile::class, 'buddy_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
