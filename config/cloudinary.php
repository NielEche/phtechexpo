<?php

return [
    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key' => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
        'baseUrl'    => env('CLOUDINARY_BASE_URL', 'http://res.cloudinary.com/'.env('CLOUDINARY_CLOUD_NAME')),
        'secureUrl'  => env('CLOUDINARY_SECURE_URL', 'https://res.cloudinary.com/'.env('CLOUDINARY_CLOUD_NAME')),
        'apiBaseUrl' => env('CLOUDINARY_API_BASE_URL', 'https://api.cloudinary.com/v1_1/'.env('CLOUDINARY_CLOUD_NAME')),
    ],
];