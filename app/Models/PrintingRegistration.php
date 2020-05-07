<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrintingRegistration extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'exemplars_registered_initially', 'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
