<?php

namespace App\Models;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PicRoom extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function classroom(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }
}
