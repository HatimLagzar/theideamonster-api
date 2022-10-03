<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Milestone extends ModelUuid
{
    use HasFactory;

    public const ID_COLUMN = 'id';
    public const USER_ID_COLUMN = 'user_id';
    public const BASKET_ID_COLUMN = 'basket_id';
    public const ENDS_AT_COLUMN = 'ends_at';
    public const IS_DONE_COLUMN = 'is_done';
    public const PERCENTAGE_COLUMN = 'percentage';
    public const CREATED_AT_COLUMN = 'created_at';
    public const UPDATED_AT_COLUMN = 'updated_at';

    protected $casts = [
        self::ENDS_AT_COLUMN => 'date',
        self::IS_DONE_COLUMN => 'boolean'
    ];

    protected $fillable = [
        self::USER_ID_COLUMN,
        self::BASKET_ID_COLUMN,
        self::ENDS_AT_COLUMN,
    ];

    protected $with = [
        'basket'
    ];

    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function basket(): HasOne
    {
        return $this->hasOne(Category::class, Category::ID_COLUMN, self::BASKET_ID_COLUMN);
    }

    public function getUserId(): string
    {
        return $this->getAttribute(self::USER_ID_COLUMN);
    }

    public function getBasketId(): string
    {
        return $this->getAttribute(self::BASKET_ID_COLUMN);
    }

    public function getEndsAt(): Carbon
    {
        return $this->getAttribute(self::ENDS_AT_COLUMN);
    }

    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute(self::CREATED_AT_COLUMN);
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->getAttribute(self::UPDATED_AT_COLUMN);
    }

    public function isDone(): bool
    {
        return $this->getAttribute(self::IS_DONE_COLUMN);
    }

    public function getPercentage(): int
    {
        return $this->getAttribute(self::PERCENTAGE_COLUMN);
    }
}
