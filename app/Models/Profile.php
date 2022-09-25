<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends ModelUuid
{
    use HasFactory;

    public const ID_COLUMN = 'id';
    public const NAME_COLUMN = 'name';
    public const JOB_COLUMN = 'job';

    protected $fillable = [
        self::NAME_COLUMN,
        self::JOB_COLUMN,
    ];

    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }
}
