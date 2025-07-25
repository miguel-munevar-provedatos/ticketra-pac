<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login','check-auth'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:8100'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
