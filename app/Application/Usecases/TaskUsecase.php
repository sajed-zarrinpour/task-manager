<?php
namespace App\Application\Usecases;

use App\Domain\Task\Task;
use App\Infrastructure\Models\Task as TaskRepository;
use App\Infrastructure\Models\User;

final class TaskUsecase {
    public function __construct(private Task $task) {}
    public function getTask():Task {
        return $this->task;
    }
    public function setTask(Task $task):void{
        $this->task = $task;
    }

    public function AssignTaskTo(User $user):bool {
        TaskRepository::update($this->task, ['user_id'=>$user->id]);
    }
}