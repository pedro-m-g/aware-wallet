<?php

namespace AwareWallet\Context;

use RuntimeException;

class MissingDependencyException extends RuntimeException
{

    private string $dependency;

    public function __construct(string $dependency)
    {
        parent::__construct("Missing dependenci in ApplicationContext: $dependency");
    }

    public function dependency()
    {
        return $this->dependency;
    }

}
