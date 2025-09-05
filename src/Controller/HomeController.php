<?php

namespace AwareWallet\Controller;

use AwareWallet\Http\Response;

class HomeController
{

    public function index()
    {
        return new Response(200, '<h1>Hello Controller</h1>', [
            'Content-Type' => 'text/html'
        ]);
    }

}
