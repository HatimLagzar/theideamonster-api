<?php

namespace App\Services\Domain\Task;

use App\Models\Task;
use App\Models\User;
use App\Services\Core\Task\TaskService;
use Illuminate\Http\UploadedFile;

class CreateTaskService
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function create(User $user, int $type, string $categoryId, ?string $content, ?UploadedFile $audioFile): Task
    {
        if ($type === Task::AUDIO_TYPE) {
            $content = $audioFile->hashName();
            $audioFile->storeAs('public/tasks_audios/', $content);
            $content = url('storage/tasks_audios/' . $content);
        }

        return $this->taskService->create([
            Task::CONTENT_COLUMN     => $content,
            Task::USER_ID_COLUMN     => $user->getId(),
            Task::CATEGORY_ID_COLUMN => $categoryId,
            Task::TYPE_COLUMN        => $type,
        ]);
    }
}