<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookshelf extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'library_id', 'printing_id',
        'exemplars_registered', 'exemplars_in_stock',
        'shelf_number', 'shelf_floor', 'notes',
    ];

    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public function printing()
    {
        return $this->belongsTo(Printing::class);
    }
}
