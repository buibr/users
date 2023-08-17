<?php


namespace Bi\Users\Traits;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Trait HasAvatar base on spatie/laravel-medialibrary
 */
trait HasAvatar
{
    /**
     * @return string
     */
    public function avatarAsset()
    {
        if ($this->hasMedia()) {
            return $this->getFirstMedia()->getFullUrl('avatar') ?? $this->gravatar();
        }

        return $this->gravatar();
    }

    /**
     * @return string
     */
    protected function gravatar()
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
    }
}
