<?php

namespace AwareWallet\Config;

use RuntimeException;

class MissingConfigurationException extends RuntimeException
{

    private string $config;

    public function __construct(string $config)
    {
        parent::__construct('Missing configuration: ' . $config);
        $this->config = $config;
    }

    public function config()
    {
        return $this->config;
    }

}
