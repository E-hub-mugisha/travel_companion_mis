<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuddyRequest extends Model
{
    protected $fillable = ['receiver_id', 'trip_id', 'message', 'status', 'requester_id'];

    public function travelerProfile()
    {
        return $this->belongsTo(TravelerProfile::class, 'receiver_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
