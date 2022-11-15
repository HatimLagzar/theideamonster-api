<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public const TABLE = 'notifications';
    public const ID_COLUMN = 'id';
    public const CONTENT_COLUMN = 'content';

    protected $table = self::TABLE;

    protected $fillable = [
        self::CONTENT_COLUMN
    ];
}
