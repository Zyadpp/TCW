<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointAction extends Model
{
    protected $fillable = ['type', 'title', 'description', 'points', 'limitations', 'is_active'];
    protected function casts(): array { return ['is_active' => 'boolean']; }
}
