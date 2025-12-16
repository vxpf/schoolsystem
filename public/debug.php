<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Debug Info</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Current Directory: " . __DIR__ . "</p>";
echo "<p>Vendor Autoload exists: " . (file_exists(__DIR__.'/../vendor/autoload.php') ? 'YES' : 'NO') . "</p>";
echo "<p>Bootstrap exists: " . (file_exists(__DIR__.'/../bootstrap/app.php') ? 'YES' : 'NO') . "</p>";

if (file_exists(__DIR__.'/../vendor/autoload.php')) {
    require __DIR__.'/../vendor/autoload.php';
    echo "<p>Autoloader loaded successfully</p>";
    
    if (file_exists(__DIR__.'/../bootstrap/app.php')) {
        try {
            $app = require_once __DIR__.'/../bootstrap/app.php';
            echo "<p>Bootstrap loaded successfully</p>";
            echo "<p>App class: " . get_class($app) . "</p>";
            
            $request = Illuminate\Http\Request::capture();
            echo "<p>Request captured: " . $request->getUri() . "</p>";
            
            $response = $app->handleRequest($request);
            echo "<p>Response generated</p>";
            echo "<hr>";
            echo $response->getContent();
        } catch (Exception $e) {
            echo "<p style='color: red;'>ERROR: " . $e->getMessage() . "</p>";
            echo "<pre>" . $e->getTraceAsString() . "</pre>";
        }
    }
}
