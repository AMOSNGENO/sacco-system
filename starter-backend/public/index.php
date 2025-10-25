<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Skip maintenance mode for testing
/*
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}
*/

// Autoload classes
require __DIR__.'/../vendor/autoload.php';

// Boot the application
$app = require_once __DIR__.'/../bootstrap/app.php';

// Create HTTP kernel
$kernel = $app->make(Kernel::class);

// Capture the request
$request = Request::capture();

// Optional: Force bypass authentication for testing
// You can set a fake authenticated user for every request
// Uncomment below if needed
// auth()->loginUsingId(1); // logs in member with ID 1 automatically

// Handle the request and send response
$response = $kernel->handle($request);
$response->send();

// Terminate kernel
$kernel->terminate($request, $response);
