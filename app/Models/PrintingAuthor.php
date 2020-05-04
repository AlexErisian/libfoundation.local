<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintingAuthor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'born_in', 'died_in', 'notes',
    ];
}
