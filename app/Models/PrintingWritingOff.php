<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PrintingWritingOff
 *
 * @property int $id
 * @property int $user_id
 * @property int $bookshelf_id
 * @property int $exemplars_written_off
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bookshelf $bookshelf
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingWritingOff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingWritingOff newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PrintingWritingOff onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingWritingOff query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingWritingOff whereBookshelfId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingWritingOff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingWritingOff whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingWritingOff whereExemplarsWrittenOff($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingWritingOff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingWritingOff whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingWritingOff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingWritingOff whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PrintingWritingOff withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PrintingWritingOff withoutTrashed()
 * @mixin \Eloquent
 */
class PrintingWritingOff extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'bookshelf_id',
        'exemplars_written_off', 'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class);
    }
}
