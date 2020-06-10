<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PrintingComment
 *
 * @property int $id
 * @property int $printing_id
 * @property int $user_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Printing $printing
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingComment newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PrintingComment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingComment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingComment wherePrintingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingComment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingComment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PrintingComment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PrintingComment withoutTrashed()
 * @mixin \Eloquent
 */
class PrintingComment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'printing_id', 'user_id', 'text',
    ];

    public function printing()
    {
        return $this->belongsTo(Printing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
