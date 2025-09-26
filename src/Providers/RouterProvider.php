<?php

namespace AwareWallet\Providers;

use AwareWallet\Config\Configuration;
use AwareWallet\Context\ApplicationContext;
use AwareWallet\Http\Router;

class RouterProvider
{

    public function bootstrap(ApplicationContext $ctx)
    {
        $ctx->share(Router::class, function(ApplicationContext $c) {
            $config = $c->get(Configuration::class);
            $routes = $config->getConfig('routes');
            return new Router($routes);
        });
    }

}
