<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrintingRegistration extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'bookshelf_id', 'exemplars_registered_initially', 'notes',
    ];

    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
