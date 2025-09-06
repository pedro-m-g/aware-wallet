<?php

use AwareWallet\Controller\HomeController;

return [
    ['GET', '/', HomeController::class, 'index'],
    ['GET', '/:name', HomeController::class, 'welcome']
];
