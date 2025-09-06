<?php

namespace AwareWallet;

use AwareWallet\Config\Configuration;
use AwareWallet\Context\ApplicationContext;
use AwareWallet\Http\Request;
use AwareWallet\Http\Router;

class App
{

    private ApplicationContext $context;
    private $providers = [];

    public function __construct()
    {
        $this->context = new ApplicationContext();
        $this->bootstrap();
    }

    private function bootstrap()
    {
        foreach ($this->providers as $provider) {
            $provider->bootstrap($this->context);
        }
    }

    public function run()
    {
        $configuration = new Configuration(__DIR__ . '/../config');
        $routes = $configuration->getConfig('routes');
        $router = new Router($routes);
        $request = new Request();
        $response = $router->dispatch($this->context);
        $response->send();
    }

}
