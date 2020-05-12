<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'description', 'content',
        'picture_path', 'is_published', 'published_at',
    ];

    protected $casts = [
        'is_published' => 'bool'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
