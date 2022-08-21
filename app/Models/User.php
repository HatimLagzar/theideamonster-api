<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends AuthenticatableUuid
{
    use HasApiTokens, HasFactory, Notifiable;

    public const MALE_GENDER = 1;
    public const FEMALE_GENDER = 2;

    public const NORMAL_TYPE = 1;

    public const FIRST_NAME_COLUMN = 'first_name';
    public const LAST_NAME_COLUMN = 'last_name';
    public const EMAIL_COLUMN = 'email';
    public const PASSWORD_COLUMN = 'password';
    public const VERIFICATION_TOKEN_COLUMN = 'verification_token';
    public const TYPE_COLUMN = 'type';
    public const GENDER_COLUMN = 'gender';
    public const REMEMBER_TOKEN_COLUMN = 'remember_token';
    public const EMAIL_VERIFIED_AT_COLUMN = 'email_verified_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::FIRST_NAME_COLUMN,
        self::LAST_NAME_COLUMN,
        self::EMAIL_COLUMN,
        self::PASSWORD_COLUMN,
        self::GENDER_COLUMN,
        self::TYPE_COLUMN,
        self::VERIFICATION_TOKEN_COLUMN,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        self::PASSWORD_COLUMN,
        self::REMEMBER_TOKEN_COLUMN,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        self::EMAIL_VERIFIED_AT_COLUMN => 'datetime',
    ];
}
