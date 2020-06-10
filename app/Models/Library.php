<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Library
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string|null $notes
 * @property string|null $picture_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bookshelf[] $bookshelves
 * @property-read int|null $bookshelves_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LibraryService[] $libraryServices
 * @property-read int|null $library_services_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrintingRegistration[] $printingRegistrations
 * @property-read int|null $printing_registrations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrintingWritingOff[] $printingWritingOffs
 * @property-read int|null $printing_writing_offs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Library newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Library newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Library onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Library query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Library whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Library whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Library whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Library whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Library whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Library whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Library wherePicturePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Library whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Library withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Library withoutTrashed()
 * @mixin \Eloquent
 */
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
