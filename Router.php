<?php

namespace app;
// Router Class
class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];
    public Database $db;

    public function __construct()
    // Db Connect
    {
        $this->db = new Database();
    }
    public function get($url, $fn)
    // Get Route
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    // Post Route
    {
        $this->postRoutes[$url] = $fn;
    }
    // Route function
    public function resolve()
    {
        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];
        // Get URL
        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }
        // If URL found. Run Func
        if ($fn) {
            call_user_func($fn, $this);
        } else {
            // Else Page not found
            echo "Page Not Found";
        }
    }
    // Render php view file with data
    public function renderView($view, $params = [])
    {

        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once __DIR__ . "/views/$view.php";
        // input data into the layout template
        $content = ob_get_clean();
        include_once  __DIR__ . "/views/layout.php";
    }
}
