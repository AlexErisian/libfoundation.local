<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PrintingPubhouse
 *
 * @property int $id
 * @property string $name
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Printing[] $printings
 * @property-read int|null $printings_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingPubhouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingPubhouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingPubhouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingPubhouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingPubhouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingPubhouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingPubhouse whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingPubhouse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PrintingPubhouse extends Model
{
    protected $fillable = [
        'name', 'notes',
    ];

    public function printings()
    {
        return $this->hasMany(Printing::class);
    }
}
