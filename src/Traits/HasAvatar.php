<?php


namespace Bi\Users\Traits;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
/**
 * Trait HasAvatar base on spatie/laravel-medialibrary
 */
trait HasAvatar
{
    public function avatarAsset(): string
    {
        if ($this->hasMedia()) {
            return $this->getFirstMedia()->getFullUrl('avatar') ?? $this->gravatar();
        }

        return $this->gravatar();
    }

    protected function gravatar(): string
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
    }

    public function updateAvatarFromRequest(string $name): ?Media
    {
        if (!request()->hasFile($name)) {
            return null;
        }

        $this->clearMediaCollection();

        return $this->addMediaFromRequest($name)->toMediaCollection();
    }
}
