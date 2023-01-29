<?php

Route::macro('rush', function(string $path, string $class) {

$path = rtrim($path, '/\\');

  // Take the root path, and register the routes, including any public methods.
  Route::get($path, [$class, 'render']);

  (new RushRouteInspector)->inspectClass($class, $path)
    ->each(function($route) use ($path, $class) {
        Route::{strtolower($route->http_verb)}($route->relative_url, [$class, $route->method_name]);
    });
});
