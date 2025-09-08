<?php

namespace AwareWallet\Config;

use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{

    public function testGetExistingConfiguration()
    {
        $configuration = new Configuration(__DIR__);
        $config = $configuration->getConfig('config-test');
        $value = $config['config'];
        $this->assertSame('value', $value);
    }

    public function testGetNonExistingConfigDirectory()
    {
        $this->expectException(InvalidConfigurationDirectoryException::class);
        new Configuration(__DIR__ . '/non-existent');
    }

    public function testGetNonExistentConfigFile()
    {
        $this->expectException(MissingConfigurationException::class);
        $configuration = new Configuration(__DIR__);
        $configuration->getConfig('non-existent-config');
    }

}
