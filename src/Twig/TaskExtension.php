<?php


namespace App\Twig;


use App\Manager\TaskManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TaskExtension extends AbstractExtension
{
    /**
     * @var TaskManager
     */
    private $taskManager;

    public function __construct(TaskManager $taskManager)
    {
        $this->taskManager = $taskManager;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('deleteTaskAllowed', [$this, 'deleteTaskAllowed']),
        ];
    }

    public function deleteTaskAllowed($task)
    {
        return $this->taskManager->allowDeleteTask($task);
    }
}