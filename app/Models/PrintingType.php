<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PrintingType
 *
 * @property int $id
 * @property string $name
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Printing[] $printings
 * @property-read int|null $printings_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingType whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
