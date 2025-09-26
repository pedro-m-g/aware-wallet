<?php

namespace AwareWallet;

use AwareWallet\Config\Configuration;
use AwareWallet\Context\ApplicationContext;
use AwareWallet\Http\Router;
use AwareWallet\Providers\ConfigProvider;
use AwareWallet\Providers\RouterProvider;
use AwareWallet\Providers\ViewsProvider;
use AwareWallet\Services\Logging\Logger;

class App
{

    private $providers = [
        ConfigProvider::class,
        RouterProvider::class,
        ViewsProvider::class
    ];

    private ApplicationContext $context;
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
        foreach ($this->providers as $providerClass) {
            $provider = new $providerClass();
            $provider->bootstrap($this->context);
        }
        $this->logger->info('Bootstrapping application: Finish');
    }

    public function run()
    {
        $router = $this->context->get(Router::class);
        $response = $router->dispatch($this->context);
        $response->send();
    }

}
