<?php

namespace AwareWallet;

use AwareWallet\Config\Configuration;
use AwareWallet\Context\ApplicationContext;
use AwareWallet\Http\Router;
use AwareWallet\Services\Logging\Logger;

class App
{

    private ApplicationContext $context;
    private $providers = [];
    private Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger(App::class);
        $this->context = new ApplicationContext();
        $this->bootstrap();
    }

    private function bootstrap()
    {
        $this->logger->info('Bootstrapping application: Start');
        foreach ($this->providers as $provider) {
            $provider->bootstrap($this->context);
        }
        $this->logger->info('Bootstrapping application: Finish');
    }

    public function run()
    {
        $configuration = new Configuration(__DIR__ . '/../config');
        $routes = $configuration->getConfig('routes');
        $router = new Router($routes);
        $response = $router->dispatch($this->context);
        $response->send();
    }

}
