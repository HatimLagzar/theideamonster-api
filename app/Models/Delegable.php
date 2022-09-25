<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Delegable extends ModelUuid
{
    use HasFactory;

    public const ID_COLUMN = 'id';
    public const USER_ID_COLUMN = 'user_id';
    public const PROFILE_ID_COLUMN = 'profile_id';
    public const AVATAR_COLUMN = 'avatar';
    public const CREATED_AT_COLUMN = 'created_at';
    public const UPDATED_AT_COLUMN = 'updated_at';

    protected $fillable = [
        self::USER_ID_COLUMN,
        self::PROFILE_ID_COLUMN,
        self::AVATAR_COLUMN,
    ];

    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getUserId(): string
    {
        return $this->getAttribute(self::USER_ID_COLUMN);
    }

    public function getProfileId(): string
    {
        return $this->getAttribute(self::PROFILE_ID_COLUMN);
    }

    public function getAvatar(): string
    {
        return $this->getAttribute(self::AVATAR_COLUMN);
    }

    public function getCreatedAt(): string
    {
        return $this->getAttribute(self::CREATED_AT_COLUMN);
    }

    public function getUpdatedAt(): string
    {
        return $this->getAttribute(self::UPDATED_AT_COLUMN);
    }

    public function delegableTasks(): HasMany
    {
        return $this->hasMany(
            DelegableTask::class,
            DelegableTask::DELEGABLE_ID_COLUMN,
            self::ID_COLUMN
        );
    }

    public function profile(): HasOne
    {
        return $this->hasOne(
            Profile::class,
            Profile::ID_COLUMN,
            self::PROFILE_ID_COLUMN
        );
    }
}
