<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Trip extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'image',
        'destination_id',
        'traveler_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected $dates = ['start_date', 'end_date'];
    
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function traveler()
    {
        return $this->belongsTo(TravelerProfile::class);
    }

    protected static function booted()
    {
        static::saving(function ($trip) {
            if ($trip->end_date && Carbon::parse($trip->end_date)->isPast()) {
                $trip->status = 'completed';
            } else {
                $trip->status = 'scheduled';
            }
        });
    }
    public function getStatusAttribute()
    {
        $now = Carbon::now();
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);

        if ($now->lt($start)) {
            return 'Upcoming';
        } elseif ($now->between($start, $end)) {
            return 'Ongoing';
        }

        return 'Past';
    }

    public function getBadgeClassAttribute()
    {
        return match ($this->status) {
            'Upcoming' => 'badge-info',
            'Ongoing' => 'badge-success',
            'Past'     => 'badge-secondary',
        };
    }
    
}
