<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    protected $fillable = ['programme_module_id', 'title', 'description', 'video_path', 'duration_seconds', 'sort_order', 'is_published'];
    protected function casts(): array { return ['is_published' => 'boolean']; }
    public function module(): BelongsTo { return $this->belongsTo(ProgrammeModule::class, 'programme_module_id'); }
    public function progress(): HasMany { return $this->hasMany(LessonProgress::class); }
}
