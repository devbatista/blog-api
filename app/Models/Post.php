<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasUuid;

    protected $fillable = [
        'slug',
        'author_id',
        'title',
        'content',
        'cover',
        'status',
    ];

    public function author(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
