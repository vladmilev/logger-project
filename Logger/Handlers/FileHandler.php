<?php
namespace Logger\Handlers;

use Logger;
use Logger\LogLevel;

class FileHandler extends Handler
{
    private string $filename = '';

    public function __construct(array $options)
    {
        parent::__construct($options);

        if (array_key_exists("filename", $options)) {
            $this->filename = $options["filename"];
        }
    }

    public function log(int $level, string $message): bool
    {
        $result = parent::log($level, $message);
        if (!$result)
            return false;

        if ($this->filename) {
            $file = fopen($this->filename, "a");

            /* @var FormatterInterface|null $formatter */
            if ($formatter = $this->getFormatter()) {
                $output = $formatter->format($level, $message);
            } else {
                $output = $message;
            }

            $result = fwrite($file, $output);

            fclose($file);
        }
        return $result;
    }

    public function info(string $message): void
    {
        $this->log(LogLevel::LEVEL_INFO, $message);
    }
}