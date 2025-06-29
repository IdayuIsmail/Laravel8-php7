<?php

return [
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'keycloak' => [
        'driver' => 'keycloak',
        'provider' => 'users',
    ],
    ],
];
