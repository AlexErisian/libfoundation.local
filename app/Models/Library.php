<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Model
{
    use SoftDeletes;

    protected $fillable = [
       'name', 'address', 'notes', 'picture_path'
    ];

    public function bookshelves()
    {
        return $this->hasMany(Bookshelf::class);
    }

    public function libraryServices()
    {
        return $this->hasManyThrough(LibraryService::class, Bookshelf::class);
    }

    public function printingRegistrations()
    {
        return $this->hasManyThrough(PrintingRegistration::class,Bookshelf::class);
    }

    public function printingWritingOffs()
    {
        return $this->hasManyThrough(PrintingWritingOff::class,Bookshelf::class);
    }
}
