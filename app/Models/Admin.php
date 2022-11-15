<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    public const TABLE = 'admins';
    public const ID_COLUMN = 'id';
    public const NAME_COLUMN = 'name';
    public const EMAIL_COLUMN = 'email';
    public const PASSWORD_COLUMN = 'password';

    protected $table = self::TABLE;

    protected $fillable = [
        self::NAME_COLUMN,
        self::EMAIL_COLUMN,
        self::PASSWORD_COLUMN,
    ];
}
