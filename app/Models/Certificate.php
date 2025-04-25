<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Workshop;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'workshop_id', 'file_path', 'certificate_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificate) {
            // Generate a unique certificate number if not set
            if (!$certificate->certificate_number) {
                $certificate->certificate_number = 'CERT-' . date('Y') . '-' . str_pad(static::count() + 1, 5, '0', STR_PAD_LEFT);
            }
        });
    }
}
