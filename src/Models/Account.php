<?php

namespace Bi\Users\Models;

use Bi\Users\Enums\AccountTypeEnum;
use Bi\Users\Factories\AccountFactory;
use Illuminate\Database\Eloquent\Model;
use Bi\Users\Interfaces\AccountContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int id
 * @property AccountTypeEnum type
 * @property string uuid
 * @property string full_name
 * @property string username
 * @property bool active
 *
 * @property User[] $users
 */
class Account extends Model implements AccountContract
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'uuid',
        'full_name',
        'username',
        'active',
    ];

    /** @var string[] */
    protected $casts = [
        'type'   => AccountTypeEnum::class,
        'active' => 'boolean',
    ];

    protected static function newFactory(): Factory
    {
        return AccountFactory::new();
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function getId(): int|string
    {
        return $this->id;
    }
}
