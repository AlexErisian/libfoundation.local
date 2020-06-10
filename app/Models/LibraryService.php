<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\LibraryService
 *
 * @property int $id
 * @property int $user_id
 * @property int $readercard_id
 * @property int $bookshelf_id
 * @property int $exemplars_given
 * @property string $given_up_to
 * @property string|null $returned_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bookshelf $bookshelf
 * @property-read \App\Models\Readercard $readercard
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LibraryService onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService whereBookshelfId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService whereExemplarsGiven($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService whereGivenUpTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService whereReadercardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService whereReturnedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LibraryService whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LibraryService withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LibraryService withoutTrashed()
 * @mixin \Eloquent
 */
class LibraryService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'readercard_id', 'bookshelf_id',
        'exemplars_given', 'given_up_to', 'returned_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function readercard()
    {
        return $this->belongsTo(Readercard::class);
    }

    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class);
    }
}
