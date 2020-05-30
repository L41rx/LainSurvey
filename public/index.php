<?php
require_once __DIR__.'/../vendor/autoload.php';

// routing.
$routes = [
    '' => 'homepage',
    'submit' => 'submit',
    'stats' => 'stats',
    'sunglasses' => 'sunglasses',
    '404' => '404'
];

$maybe_route = ltrim($_SERVER['REQUEST_URI'], '/');
if (strpos($maybe_route, '?') !== false)
    $maybe_route = substr($maybe_route, 0, strpos($maybe_route, "?"));

if (isset($routes[$maybe_route])) {
    $route = $maybe_route;
    require_once __DIR__.'/../pages/'.$routes[$maybe_route].'.php';
} else {
    $failed_route = $maybe_route;
    require_once __DIR__.'/../pages/404.php';
}