<?php

namespace AwareWallet\Config;

use RuntimeException;

class InvalidConfigDirectoryException extends RuntimeException
{

    private string $dir;

    public function __construct(string $dir)
    {
        parent::__construct('Invalid configuration directory: ' . $dir);
        $this->dir = $dir;
    }

    public function directory()
    {
        return $this->dir;
    }

}
