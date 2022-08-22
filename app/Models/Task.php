<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends ModelUuid
{
    use HasFactory;

    public const TABLE = 'tasks';

    public const ID_COLUMN = 'id';
    public const NAME_COLUMN = 'name';
    public const USER_ID_COLUMN = 'user_id';
    public const CATEGORY_ID_COLUMN = 'category_id';

    protected $table = self::TABLE;
    protected $fillable = [
        self::NAME_COLUMN,
        self::USER_ID_COLUMN,
        self::CATEGORY_ID_COLUMN,
    ];

    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getUserId(): string
    {
        return $this->getAttribute(self::USER_ID_COLUMN);
    }

    public function getCategoryId(): string
    {
        return $this->getAttribute(self::CATEGORY_ID_COLUMN);
    }
}
