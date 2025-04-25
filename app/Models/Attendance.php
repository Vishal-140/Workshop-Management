<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Workshop;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'workshop_id', 'is_present', 'check_in_time'];

    protected $casts = [
        'check_in_time' => 'datetime',
        'is_present' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
}
