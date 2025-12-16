<?php
// Direct test zonder Laravel routing
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html>";
echo "<html lang='nl'>";
echo "<head><meta charset='UTF-8'><title>Direct Test</title></head>";
echo "<body style='font-family: Arial; padding: 20px;'>";
echo "<h1>✓ PHP werkt!</h1>";
echo "<p>Als je dit ziet, werkt Apache en PHP correct.</p>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<hr>";

// Nu Laravel laden
echo "<h2>Laravel Test:</h2>";

try {
    require __DIR__.'/../vendor/autoload.php';
    echo "<p>✓ Autoloader geladen</p>";
    
    $app = require_once __DIR__.'/../bootstrap/app.php';
    echo "<p>✓ Laravel app geladen</p>";
    
    // Maak een test request voor de root route
    $_SERVER['REQUEST_URI'] = '/';
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    
    $request = Illuminate\Http\Request::capture();
    echo "<p>✓ Request gemaakt voor: " . $request->getPathInfo() . "</p>";
    
    $response = $app->handleRequest($request);
    echo "<p>✓ Response ontvangen (Status: " . $response->getStatusCode() . ")</p>";
    
    echo "<hr><h2>Laravel Response:</h2>";
    echo "<div style='border: 2px solid #ccc; padding: 10px; background: #f9f9f9;'>";
    echo $response->getContent();
    echo "</div>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'><strong>ERROR:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre style='background: #ffe6e6; padding: 10px; overflow: auto;'>";
    echo htmlspecialchars($e->getTraceAsString());
    echo "</pre>";
}

echo "</body></html>";
