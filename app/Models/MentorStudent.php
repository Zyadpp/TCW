<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorStudent extends Model
{
    protected $table = 'mentor_student';
    protected $fillable = ['mentor_id', 'student_id', 'assigned_at'];
    protected function casts(): array { return ['assigned_at' => 'datetime']; }
    public function mentor(): BelongsTo { return $this->belongsTo(User::class, 'mentor_id'); }
    public function student(): BelongsTo { return $this->belongsTo(User::class, 'student_id'); }
}
