<?php

namespace src\controllers;

class AppController
{
    private string $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function baseUrl(): string
    {
        return "http://$_SERVER[HTTP_HOST]";
    }

    protected function currentPath(): string
    {
        $path = trim($_SERVER['REQUEST_URI'], '/');
        return parse_url($path, PHP_URL_PATH);
    }

    protected function isAjax(): bool
    {
        return 'xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '');
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = []): void
    {
        $templatePath = 'public/views/' . $template . '.php';
        $output = 'File not found';

        if (file_exists($templatePath)) {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }
}