<?php

namespace AwareWallet;

use AwareWallet\Http\Request;
use AwareWallet\Services\Routing\Router;

class App
{

    public function run()
    {
        $request = new Request();
        $router = new Router([]);
        $response = $router->dispatch($request);
        $response->send();
    }

}
