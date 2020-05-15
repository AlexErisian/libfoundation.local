<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibraryService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'readercard_id', 'bookshelf_id',
        'exemplars_given', 'given_up_to', 'returned_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function readercard()
    {
        return $this->belongsTo(Readercard::class);
    }

    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class);
    }
}
