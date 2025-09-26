<?php

namespace AwareWallet\Providers;

use AwareWallet\Config\Configuration;
use AwareWallet\Context\ApplicationContext;
use AwareWallet\Services\View\ViewRenderer;

class ViewsProvider
{

    public function bootstrap(ApplicationContext $ctx)
    {
        $ctx->share(ViewRenderer::class, function(ApplicationContext $c) {
            $config = $c->get(Configuration::class);
            $viewsConfig = $config->getConfig('views');
            $viewsDir = $viewsConfig['viewsDir'];
            return new ViewRenderer($viewsDir);
        });
    }

}
