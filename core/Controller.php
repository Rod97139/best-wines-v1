<?php

namespace Core;

use Core\Partials\StartSession;

abstract class Controller
{

    public function __construct()
    {
        StartSession::start();
    }

    public function renderView(string $view_name, array $params = []): void
    {
        extract($params);
        ob_start();
        require_once "src/views/$view_name.php";
        // StartSession::start();
        $content = ob_get_clean();
        require_once 'src/views/layout.php';
    }
}
