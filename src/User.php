<?php

namespace Bi\Users;

use Bi\Users\Traits\HasAvatar;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use Notifiable, MustVerifyEmailTrait, HasFactory, HasRoles, InteractsWithMedia, HasAvatar;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
        'api_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return mixed
     */
    public static function newFactory()
    {
        return Factories\UserFactory::new();
    }

    /**
     * @return void
     */
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

    /**
     * @param Media|null $media
     *
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('avatar')
            ->width(100)
            ->sharpen(10)
            ->nonQueued();
    }

    /**
     * @param string $name
     *
     * @return Media|null
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function updateAvatarFromRequest(string $name)
    {
        if (!request()->hasFile($name)) {
            return null;
        }

        $this->clearMediaCollection();

        return $this->addMediaFromRequest($name)->toMediaCollection();
    }

    /**
     * @param string $name
     * @return User|null
     */
    public function updateRolesFromRequest(string $name)
    {
        if (!request()->filled($name)) {
            return null;
        }

        return $this->syncRoles(request()->input($name));
    }
}
