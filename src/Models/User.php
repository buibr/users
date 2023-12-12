<?php

namespace Bi\Users\Models;

use Bi\Users\Traits\HasAvatar;
use Spatie\MediaLibrary\HasMedia;
use Bi\Users\Factories\UserFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $api_token
 * @property string $remember_token
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 *
 * @static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @static \Illuminate\Database\Eloquent\Builder|NRBUser permission($permissions)
 * @static \Illuminate\Database\Eloquent\Builder|User query()
 * @static \Illuminate\Database\Eloquent\Builder|NRBUser role($roles, $guard = null)
 *
 */
class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use Notifiable;
    use MustVerifyEmailTrait;
    use HasFactory;
    use HasRoles;
    use InteractsWithMedia;
    use HasAvatar;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
        'api_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    protected static function boot(): void
    {
        parent::boot();

        static::updating(function (User $user) {
            if (array_key_exists('email', $user->getChanges())) {
                $user->email_verified_at = null;
                $user->sendEmailVerificationNotification();
            }
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('avatar')
            ->width(100)
            ->sharpen(10)
            ->nonQueued();
    }

    public function updateRolesFromRequest(string $inputKey): ?self
    {
        if (!request()->filled($inputKey)) {
            return null;
        }

        $inputValue = request()->input($inputKey);

        return $this->syncRoles($inputValue);
    }
}
