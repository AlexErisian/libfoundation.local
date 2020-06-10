<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PrintingRegistration
 *
 * @property int $id
 * @property int $user_id
 * @property int $bookshelf_id
 * @property int $exemplars_registered_initially
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bookshelf $bookshelf
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingRegistration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingRegistration newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PrintingRegistration onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingRegistration query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingRegistration whereBookshelfId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingRegistration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingRegistration whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingRegistration whereExemplarsRegisteredInitially($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingRegistration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingRegistration whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingRegistration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PrintingRegistration whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PrintingRegistration withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PrintingRegistration withoutTrashed()
 * @mixin \Eloquent
 */
class PrintingRegistration extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'bookshelf_id', 'exemplars_registered_initially', 'notes',
    ];

    public function bookshelf()
    {
        return $this->belongsTo(Bookshelf::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
