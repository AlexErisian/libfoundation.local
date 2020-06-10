<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PrintingGenre
 *
 * @property int $id
 * @property string $name
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingGenre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingGenre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingGenre query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingGenre whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingGenre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingGenre whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingGenre whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingGenre whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PrintingGenre extends Model
{
    protected $fillable = [
        'name', 'notes',
    ];
}
