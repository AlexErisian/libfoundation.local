<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Printing
 *
 * @property int $id
 * @property int $printing_author_id
 * @property int $printing_pubhouse_id
 * @property int $printing_type_id
 * @property string $title
 * @property string $slug
 * @property int $publication_year
 * @property string|null $isbn
 * @property string $annotation
 * @property string|null $picture_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\PrintingAuthor $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bookshelf[] $bookshelves
 * @property-read int|null $bookshelves_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrintingComment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrintingGenre[] $genres
 * @property-read int|null $genres_count
 * @property-read \App\Models\PrintingPubhouse $pubhouse
 * @property-read \App\Models\PrintingType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Printing onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing whereAnnotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing whereIsbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing wherePicturePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing wherePrintingAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing wherePrintingPubhouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing wherePrintingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing wherePublicationYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Printing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Printing withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Printing withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Library[] $libraries
 * @property-read int|null $libraries_count
 */
class Printing extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'printing_author_id', 'printing_pubhouse_id', 'printing_type_id',
        'title', 'slug', 'publication_year',
        'isbn', 'annotation', 'picture_path',
    ];

    public function author()
    {
        return $this->belongsTo(PrintingAuthor::class,
            'printing_author_id');
    }

    public function pubhouse()
    {
        return $this->belongsTo(PrintingPubhouse::class,
            'printing_pubhouse_id');
    }

    public function type()
    {
        return $this->belongsTo(PrintingType::class,
            'printing_type_id');
    }

    public function comments()
    {
        return $this->hasMany(PrintingComment::class);
    }

    public function genres()
    {
        return $this->belongsToMany(PrintingGenre::class,
            'printing_genre');
    }

    public function libraries()
    {
        return $this->belongsToMany(Library::class,
            'bookshelves');
    }
}
