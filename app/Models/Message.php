<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Crypter;

class Message extends Model
{
    public $casts = [
        'received' => 'datetime',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function getMessageAttribute($encryptedValue): string
    {
        return (new Crypter())->decrypt($encryptedValue);
    }
}
