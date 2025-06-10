<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasUuid;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'slug',
        'author_id',
        'title',
        'content',
        'cover',
        'status',
    ];

    public function scopePublished($query): Builder
    {
        return $query->where('status', 'PUBLISHED');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public static function byTags(array $tagIds): Builder
    {
        return self::whereHas('tags', function($query) use ($tagIds) {
            $query->whereIn('tags.id', $tagIds);
        });
    }
}
