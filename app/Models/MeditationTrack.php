<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeditationTrack extends ModelUuid
{
    use HasFactory;

    public const TABLE = 'meditation_tracks';
    public const ID_COLUMN = 'id';
    public const NAME_COLUMN = 'name';
    public const DURATION_COLUMN = 'duration';
    public const TRACK_FILENAME_COLUMN = 'track_filename';
    public const CREATED_AT_COLUMN = 'created_at';
    public const UPDATED_AT_COLUMN = 'updated_at';

    protected $table = self::TABLE;

    protected $fillable = [
        self::NAME_COLUMN,
        self::DURATION_COLUMN,
        self::TRACK_FILENAME_COLUMN,
    ];

    protected $casts = [
        self::CREATED_AT_COLUMN => 'datetime'
    ];

    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getDuration(): string
    {
        return $this->getAttribute(self::DURATION_COLUMN);
    }

    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute(self::CREATED_AT_COLUMN);
    }

    public function getTrackFileName(): string
    {
        return $this->getAttribute(self::TRACK_FILENAME_COLUMN);
    }
}
