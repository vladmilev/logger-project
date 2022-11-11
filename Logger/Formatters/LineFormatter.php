<?php
namespace Logger\Formatters;

use Logger;

class LineFormatter implements FormatterInterface
{
    private string $message_format;

    private string $date_format;

    public function __construct(string $message_format = "%date%  %level_code%  %level%  %message%", string $date_format = "Y-m-d H:i:s")
    {
        $this->message_format = $message_format;
        $this->date_format = $date_format;
    }

    /*
    * $message_format => '%date%  [%level_code%]  [%level%]  %message%',
    */
    public function format(int $level, string $message): string
    {
        return self::formatLine($level, $message, sprintf("%03d", $level), $this->date_format, $this->message_format);
    }

    private static function formatLine(
                    int $level,
                    string $message,
                    string $code = null,
                    string $date_format = "Y-m-d H:i:s",
                    string $message_format = "%date%  %level_code%  %level%  %message%" ): string
    {
        $output = $message_format;

        if (!$code)
            $code = sprintf("%03d", $level);

        if (strpos($output, '%date%') !== false)
            $output = str_replace('%date%', date($date_format), $output);

        if (strpos($output, '%level_code%') !== false)
            $output = str_replace('%level_code%', $code, $output);

        if (strpos($output, '%level%') !== false)
            $output = str_replace('%level%', Logger\LogLevel::NAME_LEVELS[$level], $output);

        if (strpos($output, '%message%') !== false)
            $output = str_replace('%message%', $message, $output);

        return $output.PHP_EOL;
    }
}
