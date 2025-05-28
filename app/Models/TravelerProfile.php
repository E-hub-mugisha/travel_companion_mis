<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelerProfile extends Model
{
    //
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $fillable = [
        'user_id',
        'bio',
        'interests',
        'destination_id',
        'travel_preferences',
        'travel_budget',
        'travel_duration',
        'travel_companions',
        'travel_experience',
        'travel_style',
        'travel_photos',
        'start_date',
        'end_date',
        'price',
        'is_active',
        'is_verified',
        'is_featured',

    ];
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function trips()
    {
        return $this->hasMany(Trip::class, 'traveler_id');
    }
    public function buddyFeedback()
    {
        return $this->hasMany(BuddyFeedback::class, 'buddy_id');
    }
    public function feedbacks()
    {
        return $this->hasMany(BuddyFeedback::class, 'user_id');
    }
}
