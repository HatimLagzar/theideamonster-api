<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends ModelUuid
{
    use HasFactory;

    public const TABLE = 'tasks';

    public const ID_COLUMN = 'id';
    public const CONTENT_COLUMN = 'content';
    public const USER_ID_COLUMN = 'user_id';
    public const CATEGORY_ID_COLUMN = 'category_id';
    public const DONE_COLUMN = 'done';

    public const STRING_TYPE = 1;
    public const AUDIO_TYPE = 1;

    protected $table = self::TABLE;
    protected $fillable = [
        self::CONTENT_COLUMN,
        self::USER_ID_COLUMN,
        self::CATEGORY_ID_COLUMN,
        self::DONE_COLUMN,
    ];

    protected $casts = [
        self::DONE_COLUMN => 'bool'
    ];

    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getContent(): string
    {
        return $this->getAttribute(self::CONTENT_COLUMN);
    }

    public function getUserId(): string
    {
        return $this->getAttribute(self::USER_ID_COLUMN);
    }

    public function getCategoryId(): string
    {
        return $this->getAttribute(self::CATEGORY_ID_COLUMN);
    }

    public function isDone(): bool
    {
        return $this->getAttribute(self::DONE_COLUMN);
    }
}
