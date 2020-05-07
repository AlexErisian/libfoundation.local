<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Printing extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'publication_year',
        'isbn', 'annotation', 'picture_path',
    ];

    public function author()
    {
        return $this->belongsTo(PrintingAuthor::class,
            'printing_author_id');
    }

    public function pubhouse()
    {
        return $this->belongsTo(PrintingPubhouse::class,
            'printing_pubhouse_id');
    }

    public function type()
    {
        return $this->belongsTo(PrintingType::class,
            'printing_type_id');
    }

    public function comments()
    {
        return $this->hasMany(PrintingComment::class);
    }
}
