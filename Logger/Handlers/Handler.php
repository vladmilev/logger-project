<?php
namespace Logger\Handlers;

use Logger;
use Logger\Formatters;

class Handler implements HandlerInterface
{
    protected array $levels = [];
    protected bool $is_enabled = true;
    protected mixed $formatter = null;

    public function getIsEnabled(): bool
    {
        return $this->is_enabled;
    }

    public function setIsEnabled(bool $enabled): void
    {
        $this->is_enabled = $enabled;
    }

    public function getLevels(): array
    {
        return $this->levels;
    }

    public function getFormatter(): mixed
    {
        return $this->formatter;
    }

    public function __construct(array $options)
    {
        if (array_key_exists("is_enabled", $options)) {
            $this->setIsEnabled($options["is_enabled"]);
        }

        if (array_key_exists("levels", $options)) {
            foreach($options["levels"] as $level)
                $this->levels[] = $level;
        } else {
            $this->levels = [
                Logger\LogLevel::LEVEL_ERROR,
                Logger\LogLevel::LEVEL_INFO,
                Logger\LogLevel::LEVEL_DEBUG,
                Logger\LogLevel::LEVEL_NOTICE
            ];
        }

        if (array_key_exists("formatter", $options)) {
            if ($options["formatter"] instanceof Formatters\FormatterInterface)
                $this->formatter = $options["formatter"];
        }
    }

    public function log(int $level, string $message): bool
    {
        if (!$this->getIsEnabled())
            return false;
        if (!in_array($level, $this->getLevels()))
            return false;

        return true;
    }
}