<?php

namespace AwareWallet;

use AwareWallet\Config\Configuration;
use AwareWallet\Http\Request;
use AwareWallet\Services\Routing\Router;

class App
{

    public function run()
    {
        $configuration = new Configuration(__DIR__ . '/../config');
        $routes = $configuration->getConfig('routes');
        $router = new Router($routes);
        $request = new Request();
        $response = $router->dispatch($request);
        $response->send();
    }

}
