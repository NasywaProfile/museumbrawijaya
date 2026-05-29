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

// ----------------------------------------------------
// Setup Zero-Config SQLite Database in /tmp on Vercel
// ----------------------------------------------------
$dbPath = $tmpDir . '/database.sqlite';

putenv("DB_CONNECTION=sqlite");
putenv("DB_DATABASE={$dbPath}");
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = $dbPath;

// If database does not exist, create and initialize it
if (!file_exists($dbPath)) {
    // 1. Create SQLite file
    touch($dbPath);
    
    // 2. Load autoloader
    require_once __DIR__ . '/../vendor/autoload.php';
    
    // 3. Boot Laravel console and run migrations
    $app = require __DIR__ . '/../bootstrap/app.php';
    $consoleKernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    
    // Run migrations
    $consoleKernel->call('migrate', ['--force' => true]);
    
    // Seed default admin and normal user
    \App\Models\User::create([
        'name' => 'Admin Museum',
        'email' => 'admin@gmail.com',
        'whatsapp' => '081234567890',
        'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
    ]);
    
    \App\Models\User::create([
        'name' => 'User Biasa',
        'email' => 'user@gmail.com',
        'whatsapp' => '081234567891',
        'password' => \Illuminate\Support\Facades\Hash::make('user123'),
    ]);
}

// Bootstrap Laravel and handle the HTTP request normally
require_once __DIR__ . '/../public/index.php';
