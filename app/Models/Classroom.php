<?php

namespace App\Models;

use App\Models\ClassroomReport;
use App\Models\ClassroomSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classroom extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    public function student(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }

    public function classroomReport(): HasMany
    {
        return $this->hasMany(ClassroomReport::class);
    }

    public function classroomSchedule(): HasMany
    {
        return $this->hasMany(ClassroomSchedule::class);
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function picRoom(): BelongsTo
    {
        return $this->belongsTo(PicRoom::class);
    }
}
