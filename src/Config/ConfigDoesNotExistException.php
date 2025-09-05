<?php

class ConfigDoesNotExistException extends RuntimeException
{

    private string $config;

    public function __construct(string $config)
    {
        parent::__construct('Config not found: ' . $config);
        $this->config = $config;
    }

    public function config()
    {
        return $this->config;
    }

}
