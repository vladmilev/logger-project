<?php
namespace Logger\Handlers;

interface HandlerInterface
{
    public function getLevels(): array;
    public function log(int $level, string $message): bool;
}