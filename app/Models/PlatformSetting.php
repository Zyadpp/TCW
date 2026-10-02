<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformSetting extends Model
{
    protected $fillable = [
        'platform_name',
        'primary_phone',
        'secondary_phone',
        'email',
        'description',
        'facebook_url',
        'instagram_url',
        'snapchat_url',
        'tiktok_url',
    ];
    protected function casts(): array { return ['notification_preferences' => 'array']; }
}
