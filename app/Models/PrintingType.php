<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintingType extends Model
{
    protected $fillable = [
        'name', 'notes',
    ];

    public function printings()
    {
        return $this->hasMany(Printing::class);
    }
}
