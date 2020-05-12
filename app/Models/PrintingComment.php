<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrintingComment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'printing_id', 'user_id', 'text',
    ];

    public function printing()
    {
        return $this->belongsTo(Printing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
