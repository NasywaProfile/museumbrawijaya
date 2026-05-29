<?php

// Set temporary write paths to /tmp since Vercel's root directory is read-only
$tmpDir = '/tmp';

// Set environment variables for compilation and caching to use /tmp
putenv("APP_CONFIG_CACHE={$tmpDir}/config.php");
putenv("APP_EVENTS_CACHE={$tmpDir}/events.php");
putenv("APP_PACKAGES_CACHE={$tmpDir}/packages.php");
putenv("APP_ROUTES_CACHE={$tmpDir}/routes.php");
putenv("APP_SERVICES_CACHE={$tmpDir}/services.php");
putenv("VIEW_COMPILED_PATH={$tmpDir}");

$_ENV['APP_CONFIG_CACHE'] = "{$tmpDir}/config.php";
$_ENV['APP_EVENTS_CACHE'] = "{$tmpDir}/events.php";
$_ENV['APP_PACKAGES_CACHE'] = "{$tmpDir}/packages.php";
$_ENV['APP_ROUTES_CACHE'] = "{$tmpDir}/routes.php";
$_ENV['APP_SERVICES_CACHE'] = "{$tmpDir}/services.php";
$_ENV['VIEW_COMPILED_PATH'] = $tmpDir;

// Set stateless drivers for Vercel unless overridden in environment variables
if (!getenv('SESSION_DRIVER')) {
    putenv('SESSION_DRIVER=cookie');
    $_ENV['SESSION_DRIVER'] = 'cookie';
}

if (!getenv('CACHE_STORE')) {
    putenv('CACHE_STORE=array');
    $_ENV['CACHE_STORE'] = 'array';
}

if (!getenv('LOG_CHANNEL')) {
    putenv('LOG_CHANNEL=stderr');
    $_ENV['LOG_CHANNEL'] = 'stderr';
}

// Bootstrap Laravel
require __DIR__ . '/../public/index.php';
