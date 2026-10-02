<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'instructor_name',
        'start_date',
        'end_date',
        'max_seats',
        'available_seats',
        'status',
    ];

    protected function casts(): array
    {
        return [
        'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function enrollments(): HasMany { return $this->hasMany(ProgrammeEnrollment::class); }
    public function modules(): HasMany { return $this->hasMany(ProgrammeModule::class)->orderBy('sort_order'); }
}
