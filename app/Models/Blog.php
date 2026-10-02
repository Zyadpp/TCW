<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'overview', 'cover_image', 'status', 'is_pinned', 'published_at'];
    protected function casts(): array { return ['is_pinned' => 'boolean', 'published_at' => 'date']; }
}
