<?php


namespace App\Manager;


use App\Entity\Task;
use Symfony\Component\Security\Core\Security;

class TaskManager
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function allowDeleteTask(Task $task): bool
    {
        switch ($task) {
            case ($task->getUser() !== null && $task->getUser() === $this->security->getUser()):
            case ($task->getUser() === null && $this->security->isGranted('ROLE_ADMIN')):
                $deleteAllowed = true;
                break;
            default:
                $deleteAllowed = false;
                break;
        }

        return $deleteAllowed;
    }
}