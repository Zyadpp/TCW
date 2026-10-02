<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    protected $fillable = ['description', 'video_path', 'original_name', 'visibility', 'status', 'views'];
}
