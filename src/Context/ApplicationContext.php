<?php

namespace AwareWallet\Context;

class ApplicationContext
{

    private $context = [];

    public function set(string $className, callable $factory)
    {
        $this->context[$className] = $factory;
    }

    public function share(string $className, callable $factory)
    {
        $instance = null;
        $this->context[$className] = function(ApplicationContext $context) use ($factory, &$instance) {
            if ($instance == null) {
                $instance = $factory($context);
            }
            return $instance;
        };
    }

    public function get(string $className)
    {
        if (!array_key_exists($className, $this->context)) {
            throw new MissingDependencyException($className);
        }
        $factory = $this->context[$className];
        return $factory($this);
    }

}
