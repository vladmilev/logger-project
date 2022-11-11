<?php
namespace Logger;

use Logger\Handlers\HandlerInterface;

class Logger
{
    private array $handlers = [];
  
    public function addHandler(HandlerInterface $handler): void
    {
        $this->handlers[] = $handler;
    }

    public function log(int $level, string $message): void
    {
        foreach ($this->handlers as $handler) {
            if ($handler instanceof HandlerInterface) {
                if (in_array($level, $handler->getLevels())) {
                    $handler->log($level, $message);
                }
            }
        }
    }
    
    public function error(string $message): void
    {
        $this->log(LogLevel::LEVEL_ERROR, $message);
    }

    public function info(string $message): void
    {
        $this->log(LogLevel::LEVEL_INFO, $message);
    }

    public function debug(string $message): void
    {
        $this->log(LogLevel::LEVEL_DEBUG, $message);
    }

    public function notice(string $message): void
    {
        $this->log(LogLevel::LEVEL_NOTICE, $message);
    }
}
