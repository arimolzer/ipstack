<?php

return [
    'api_key' => env('IPSTACK_API_KEY'),
    'base_uri' => env('IPSTACK_BASE_URI', 'https://api.ipstack.com/'),

    'testing' => [
        'default_ip' => env('IPSTACK_DEFAULT_TESTING_IP', '134.201.250.155'),
    ],
];
