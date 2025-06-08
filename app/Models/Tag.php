<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Traits\HasUuid;

class Tag extends Model
{
    use HasUuid;
    
    public $timestamps = false;

    protected $fillable = ['name'];

    public function posts(): BelongsToMany 
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
    }
}
