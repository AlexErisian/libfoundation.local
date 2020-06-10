<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PrintingAuthor
 *
 * @property int $id
 * @property string $name
 * @property string|null $born_in
 * @property string|null $died_in
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Printing[] $printings
 * @property-read int|null $printings_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingAuthor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingAuthor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingAuthor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingAuthor whereBornIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingAuthor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingAuthor whereDiedIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingAuthor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingAuthor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingAuthor whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingAuthor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function printings()
    {
        return $this->hasMany(Printing::class);
    }
}
