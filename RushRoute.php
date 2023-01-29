<?php

namespace App;

class RushRoute {
    public function __construct(
        public readonly string $relative_url,
        public readonly string $absolute_url,
        public readonly string $http_verb,
        public readonly string $method_name,
    ) {}
}
