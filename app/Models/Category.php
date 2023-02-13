<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends ModelUuid
{
    use HasFactory;

    public const TABLE = 'categories';

    public const ID_COLUMN = 'id';
    public const NAME_COLUMN = 'name';
    public const USER_ID_COLUMN = 'user_id';
    public const LOGO_COLUMN = 'logo';

    protected $table = self::TABLE;
    protected $fillable = [
        self::NAME_COLUMN,
        self::USER_ID_COLUMN,
        self::LOGO_COLUMN,
    ];

    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getLogo(): ?string
    {
        return $this->getAttribute(self::LOGO_COLUMN);
    }

    public function getLogoFullPath(): ?string
    {
        if (!$this->getLogo()) {
            return null;
        }

        return url('storage/baskets_logos/' . $this->getLogo());
    }

    public function getUserId(): string
    {
        return $this->getAttribute(self::USER_ID_COLUMN);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, Task::CATEGORY_ID_COLUMN, self::ID_COLUMN);
    }

    public function getCreatedAt()
    {
        return $this->getAttribute(self::CREATED_AT);
    }
}
