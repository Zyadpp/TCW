<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MastermindGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cover_image',
        'instructor_name',
        'members_count',
        'status',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(MastermindMessage::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'mastermind_group_user')->withPivot('role')->withTimestamps();
    }
}
