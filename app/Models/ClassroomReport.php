<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassroomReport extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }


    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }
}
