<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Bookshelf
 *
 * @property int $id
 * @property int $library_id
 * @property int $printing_id
 * @property int $exemplars_registered
 * @property int $exemplars_in_stock
 * @property int|null $shelf_number
 * @property int|null $shelf_floor
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Library $library
 * @property-read \App\Models\Printing $printing
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bookshelf onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf whereExemplarsInStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf whereExemplarsRegistered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf whereLibraryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf wherePrintingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf whereShelfFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf whereShelfNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookshelf whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bookshelf withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bookshelf withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LibraryService[] $libraryServices
 * @property-read int|null $library_services_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrintingRegistration[] $printingRegistrations
 * @property-read int|null $printing_registrations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrintingWritingOff[] $printingWritingOffs
 * @property-read int|null $printing_writing_offs_count
 */
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

    public function libraryServices()
    {
        return $this->hasMany(LibraryService::class);
    }

    public function printingRegistrations()
    {
        return $this->hasMany(PrintingRegistration::class);
    }

    public function printingWritingOffs()
    {
        return $this->hasMany(PrintingWritingOff::class);
    }
}
