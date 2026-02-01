<?php
namespace App\Domain\Task;

use App\Domain\Task\Enum\TaskStatus;
use App\Infrastructure\Http\Controllers\UserController;
use App\Infrastructure\Models\User;
use Carbon\Carbon;

class Task {
    public function __construct(
        public string $title, // (required)
        public User $user,
        public TaskStatus $status, // (pending, in_progress, done)
        public ?string $description, // (optional)
        public Carbon $due_date,// (optional)
    ) {
    }

    // Getter methods and other domain logic
    public function getTitle() : string {
        return $this->title;
    }

    public function setTitle(string $title) : void {
        $this->title = $title;
    }

    public function getUser() : User {
        return $this->user;
    }

    public function setUser(User $user) : void {
        $this->user = $user;
    }

    public function getStatus() : TaskStatus {
        return $this->status;
    }

    public function setStatus(TaskStatus $status) : void {
        $this->status = $status;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function setDescription(string $description) : void {
        $this->description = $description;
    }

    public function getDueDate() : Carbon {
        return $this->due_date;
    }

    public function setDueDate(Carbon $due_date) : void {
        $this->due_date = $due_date;
    }

    public function toArray():array {
        $task = [
            'title' => $this->title,
            'status' => $this->status,
            'user_id'=> $this->user->id,
            'description'=>$this->description,
            'due_date'=>$this->due_date,
        ];
        return $task;
    }
}