<?php

namespace AwareWallet\Config;

use ConfigDoesNotExistException;

class Configuration
{

    private string $configDir;
    private array $cache;

    public function __construct(string $configDir)
    {
        $this->configDir = $configDir;
        $this->cache = [];
    }

    public function getConfig(string $config)
    {
        if (array_key_exists($config, $this->cache)) {
            return $this->cache[$config];
        }
        $configFile = $this->configDir . '/' . $config . '.php';
        if (!file_exists($configFile)) {
            throw new ConfigDoesNotExistException($config);
        }
        $configValue = require_once $configFile;
        $this->cache[$config] = $configValue;
        return $configValue;
    }

}
