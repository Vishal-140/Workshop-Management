<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Workshop;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['workshop_id', 'file_path', 'material_link'];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
}
