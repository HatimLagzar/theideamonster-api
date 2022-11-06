<?php

namespace App\Transformers\Task;

use App\Models\Task;

class TaskTransformer
{
    public function transform(Task $task): array
    {
        return [
            'id'          => $task->getId(),
            'content'     => $task->getContent(),
            'type'        => $task->getType(),
            'user_id'     => $task->getUserId(),
            'category_id' => $task->getCategoryId(),
            'created_at'  => $task->getCreatedAt(),
        ];
    }
}