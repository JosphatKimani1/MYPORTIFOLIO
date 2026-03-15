<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    */

    'paths' => [
        resource_path('views'),
    ],

    'compiled' => env(
    'VIEW_COMPILED_PATH',
    filter_var(realpath(storage_path('framework/views')), FILTER_DEFAULT) ?: storage_path('framework/views')
),
    // ... other settings ...
];