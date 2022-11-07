<?php

namespace App\Transformers\Task;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskTransformer
{
    public function transform(Task $task): array
    {
        $urlArr = explode('/', $task->getContent());

        return [
            'id'          => $task->getId(),
            'content'     => $task->isAudio() ? base64_encode(file_get_contents(storage_path('app/public/tasks_audios/' . end($urlArr)))) : $task->getContent(),
            'type'        => $task->getType(),
            'user_id'     => $task->getUserId(),
            'category_id' => $task->getCategoryId(),
            'created_at'  => $task->getCreatedAt(),
        ];
    }

    /**
     * @param Collection|Task[] $tasks
     * @return Collection
     */
    public function transformMany(Collection $tasks): Collection
    {
        return $tasks->transform(function (Task $task) {
            return $this->transform($task);
        });
    }
}