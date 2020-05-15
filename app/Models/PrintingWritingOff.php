<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrintingWritingOff extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'bookshelf_id',
        'exemplars_written_off', 'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class);
    }
}
