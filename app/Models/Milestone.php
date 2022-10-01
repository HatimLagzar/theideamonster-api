<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Milestone extends ModelUuid
{
    use HasFactory;

    public const ID_COLUMN = 'id';
    public const USER_ID_COLUMN = 'user_id';
    public const BASKET_ID_COLUMN = 'basket_id';
    public const ENDS_AT_COLUMN = 'ends_at';

    protected $casts = [
        self::ENDS_AT_COLUMN => 'date'
    ];

    protected $fillable = [
        self::USER_ID_COLUMN,
        self::BASKET_ID_COLUMN,
        self::ENDS_AT_COLUMN,
    ];
}
