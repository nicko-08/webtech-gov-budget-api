<?php

use Knuckles\Scribe\Config\AuthIn;
use Knuckles\Scribe\Config\Defaults;
use Knuckles\Scribe\Extracting\Strategies;

use function Knuckles\Scribe\Config\configureStrategy;

return [
    'title' => 'Government Budget API Documentation',

    'description' => 'API for managing government budgets, expenses, and analytics for government units.',

    'intro_text' => <<<'INTRO'
        This documentation provides all the information you need to work with the Government Budget API.

        <aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right.</aside>
    INTRO,

    'base_url' => config('app.url'),

    'routes' => [
        [
            'match' => [
                'prefixes' => ['api/v1/*'],
                'domains' => ['*'],
            ],
            'include' => [],
            'exclude' => [
                'GET /health',
                'sanctum/*',
            ],
        ],
    ],

    'type' => 'laravel',
    'theme' => 'default',

    'laravel' => [
        'add_routes' => true,
        'docs_url' => '/docs',
        'assets_directory' => null,
        'middleware' => [],
    ],

    'try_it_out' => [
        'enabled' => true,
        'base_url' => null,
        'use_csrf' => false,
        'csrf_url' => '/sanctum/csrf-cookie',
    ],

    'auth' => [
        'enabled' => true,
        'default' => true,
        'in' => AuthIn::BEARER->value,
        'name' => 'Authorization',
        'use_value' => env('SCRIBE_AUTH_KEY'),
        'placeholder' => '{YOUR_TOKEN}',
        'extra_info' => 'You can retrieve your token by making a POST request to <code>/api/v1/login</code> endpoint.',
    ],

    'example_languages' => [
        'bash',
        'javascript',
        'php',
        'python',
    ],

    'postman' => [
        'enabled' => true,
        'overrides' => [
            'info.name' => 'Government Budget API',
            'info.description' => 'API for managing government budgets and expenses',
        ],
    ],

    'openapi' => [
        'enabled' => true,
        'version' => '3.0.3',
        'overrides' => [
            'info.title' => 'Government Budget API',
            'info.description' => 'API for managing government budgets, expenses, and analytics',
            'info.version' => '1.0.0',
        ],
    ],

    'groups' => [
        'default' => 'Endpoints',
        'order' => [
            'Analytics',
            'Authentication',
            'Budgets',
            'Budget Items',
            'Expenses',
            'Budget Categories',
            'Fiscal Years',
            'Government Units',
            'Users',
        ],
    ],

    'logo' => false,
    'last_updated' => 'Last updated: {date:F j, Y}',

    'examples' => [
        'faker_seed' => 1234,
        'models_source' => ['factoryCreate', 'factoryMake', 'databaseFirst'],
    ],

    'strategies' => [
        'metadata' => [
            ...Defaults::METADATA_STRATEGIES,
        ],
        'headers' => [
            ...Defaults::HEADERS_STRATEGIES,
            Strategies\StaticData::withSettings(data: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]),
        ],
        'urlParameters' => [
            ...Defaults::URL_PARAMETERS_STRATEGIES,
        ],
        'queryParameters' => [
            ...Defaults::QUERY_PARAMETERS_STRATEGIES,
        ],
        'bodyParameters' => [
            ...Defaults::BODY_PARAMETERS_STRATEGIES,
        ],
        'responses' => configureStrategy(
            Defaults::RESPONSES_STRATEGIES,
            Strategies\Responses\ResponseCalls::withSettings(
                only: ['GET *'],
                config: [
                    'app.debug' => false,
                ]
            )
        ),
        'responseFields' => [
            ...Defaults::RESPONSE_FIELDS_STRATEGIES,
        ],
    ],

    'database_connections_to_transact' => [config('database.default')],

    'fractal' => [
        'serializer' => null,
    ],
];
