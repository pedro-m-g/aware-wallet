<?php

namespace AwareWallet\Services\View;

class ViewRenderer
{

    private string $viewsDir;

    public function __construct(string $viewsDir)
    {
        $this->viewsDir = $viewsDir;
    }

    public function render(string $view, array $vars = []): string
    {
        extract($vars, EXTR_SKIP);
        ob_start();
        $file = $this->viewsDir . '/' . $view . '.php';
        if (!file_exists($file)) {
            throw new ViewNotFoundException($this->viewsDir, $view);
        }
        require $file;
        return ob_get_clean();
    }

}
