<?php

// 1. Point to the vendor autoload
require __DIR__ . '/../vendor/autoload.php';

// 2. Fix the pathing for Vercel's read-only filesystem
$storagePaths = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/sessions',
];
foreach ($storagePaths as $path) {
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
}

// 3. Load the Laravel Application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 4. Run the Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);