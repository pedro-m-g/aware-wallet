<?php

namespace AwareWallet\Providers;

use AwareWallet\Config\Configuration;
use AwareWallet\Context\ApplicationContext;

class ConfigProvider
{

    public function bootstrap(ApplicationContext $ctx)
    {
        $ctx->share(Configuration::class, function() {
            return new Configuration(
                __DIR__ . '/../../config');
        });
    }

}
