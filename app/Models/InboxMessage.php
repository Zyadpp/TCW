<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InboxMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'body',
        'sent_by_admin',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'sent_by_admin' => 'boolean',
            'read_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
