<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OauthService
 *
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthService query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $type
 * @property string $access_token
 * @property string $valid_until
 * @property string|null $refresh_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthService whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthService whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthService whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthService whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthService whereValidUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthService whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OauthService whereRefreshToken($value)
 */
class OauthService extends Model
{
    protected $fillable = [
        'type', 'token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
