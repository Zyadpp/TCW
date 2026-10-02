<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MastermindMessage extends Model
{
    use HasFactory;

    protected $fillable = ['mastermind_group_id', 'sender_name', 'body'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(MastermindGroup::class, 'mastermind_group_id');
    }
}
