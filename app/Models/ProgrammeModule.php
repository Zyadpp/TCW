<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgrammeModule extends Model
{
    protected $fillable = ['programme_id', 'title', 'description', 'sort_order'];
    public function programme(): BelongsTo { return $this->belongsTo(Programme::class); }
    public function lessons(): HasMany { return $this->hasMany(Lesson::class)->orderBy('sort_order'); }
}
