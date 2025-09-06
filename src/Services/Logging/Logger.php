<?php

namespace AwareWallet\Services\Logging;

class Logger
{

    private string $className;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    private function log(string $message, int $level)
    {
        error_log("[$this->className] $message", $level);
    }

    public function error(string $message)
    {
        $this->log($message, LOG_ERR);
    }

    public function warning(string $message)
    {
        $this->log($message, LOG_WARNING);
    }

    public function info(string $message)
    {
        $this->log($message, LOG_INFO);
    }

}
