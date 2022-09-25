<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DelegableTask extends ModelUuid
{
    use HasFactory;

    public const DELEGABLE_ID_COLUMN = 'delegable_id';
    public const TASK_ID_COLUMN = 'task_id';

    protected $fillable = [
        self::DELEGABLE_ID_COLUMN,
        self::TASK_ID_COLUMN,
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, Task::ID_COLUMN, self::TASK_ID_COLUMN);
    }

    public function delegable(): BelongsTo
    {
        return $this->belongsTo(Delegable::class, self::DELEGABLE_ID_COLUMN, Delegable::ID_COLUMN);
    }
}
