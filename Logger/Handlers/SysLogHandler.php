<?php
namespace Logger\Handlers;

use Logger;

class SysLogHandler extends Handler
{

    public function log(int $level, string $message): bool
    {
        $result = parent::log($level, $message);
        if (!$result)
            return false;

        // открыть syslog, включить в сообщение ID процесса
        openlog("logger", LOG_PID | LOG_PERROR, LOG_USER);

        // отправить сообщение журнала
        $access = date("Y/m/d H:i:s");
        $result= syslog(LOG_DEBUG, "LOGGER: $access  - Debug message");

        closelog();

        return $result;
    }

}