<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;
    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class, "career_id");
    }
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, "semester_id");
    }
}
