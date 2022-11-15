<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public const TABLE = 'notifications';
    public const ID_COLUMN = 'id';
    public const CONTENT_COLUMN = 'content';
    public const CREATED_AT_COLUMN = 'created_at';

    protected $table = self::TABLE;

    protected $fillable = [
        self::CONTENT_COLUMN
    ];

    protected $casts = [
        self::CREATED_AT_COLUMN => 'datetime'
    ];

    public function getId(): int
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getContent(): string
    {
        return $this->getAttribute(self::CONTENT_COLUMN);
    }

    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute(self::CREATED_AT_COLUMN);
    }
}
