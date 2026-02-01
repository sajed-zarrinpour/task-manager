<?php
namespace App\Domain\Task\Enum;

enum TaskStatus : string {
    case PENDING = 'pending';
    case INPROGRESS = 'in_progress';
    case DONE='done';
}