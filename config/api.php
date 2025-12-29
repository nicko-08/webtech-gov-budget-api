<?php

return [
    'rate_limits' => [
        'default' => env('API_RATE_LIMIT', 60),
        'auth' => env('API_RATE_LIMIT_AUTH', 10),
        'analytics' => env('API_RATE_LIMIT_ANALYTICS', 120),
    ],
];
