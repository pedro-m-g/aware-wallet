<?php

namespace AwareWallet\Config;

use AwareWallet\Services\Logging\Logger;

class Configuration
{

    private string $configDir;
    private array $cache;
    private Logger $logger;

    public function __construct(string $configDir)
    {
        $this->logger = new Logger(Configuration::class);
        if (!file_exists($configDir) || !is_dir($configDir)) {
            $this->logger->error('Invalid configuration directory: ' . $configDir);
            throw new InvalidConfigurationDirectoryException($configDir);
        }

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
            $this->logger->error('Missing configuration: ' . $configFile);
            throw new MissingConfigurationException($config);
        }
        $configValue = require_once $configFile;
        $this->cache[$config] = $configValue;
        return $configValue;
    }

}
