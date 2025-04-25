<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Workshop extends Model
{
    protected $fillable = [
        'title',
        'date',
        'start_time',
        'end_time',
        'instructor',
        'level',
        'description',
        'topics',
        'duration',
        'capacity'
    ];

    protected $casts = [
        'date' => 'datetime',
        'topics' => 'array'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'registrations');
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function getStatusAttribute()
    {
        $now = Carbon::now();
        $workshopDateTime = $this->date->copy()->setTimeFromTimeString($this->start_time);
        $workshopEndDateTime = $this->date->copy()->setTimeFromTimeString($this->end_time);

        if ($now > $workshopEndDateTime) {
            return 'completed';
        } elseif ($now >= $workshopDateTime && $now <= $workshopEndDateTime) {
            return 'ongoing';
        } else {
            return 'upcoming';
        }
    }
}
