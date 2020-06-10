<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Readercard
 *
 * @property int $id
 * @property int $code
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Readercard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Readercard newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Readercard onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Readercard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Readercard whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Readercard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Readercard whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Readercard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Readercard whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Readercard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Readercard withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Readercard withoutTrashed()
 * @mixin \Eloquent
 */
class Readercard extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code', 'notes',
    ];
}
