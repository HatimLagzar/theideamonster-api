<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    public const TABLE = 'calendar';
    public const ID_COLUMN = 'id';
    public const BASKET_ID_COLUMN = 'basket_id';
    public const TASK_ID_COLUMN = 'task_id';
    public const STARTS_AT_COLUMN = 'starts_at';
    public const ENDS_AT_COLUMN = 'ends_at';

    protected $table = self::TABLE;

    protected $fillable = [
        self::BASKET_ID_COLUMN,
        self::TASK_ID_COLUMN,
        self::STARTS_AT_COLUMN,
        self::ENDS_AT_COLUMN,
    ];

    public $timestamps = false;

    protected $casts = [
        self::STARTS_AT_COLUMN => 'datetime',
        self::ENDS_AT_COLUMN   => 'datetime',
    ];
}