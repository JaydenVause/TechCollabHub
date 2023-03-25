<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Message extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'chat_id',
        'user_id',
        'message_body'
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function chat(): BelongsTo
    {
        return $this->BelongsTo(Chat::class);
    }


}
