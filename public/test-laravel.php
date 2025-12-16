<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html><html><head><title>Laravel Test</title></head><body>";
echo "<h1>Laravel Diagnostics</h1>";

// Test 1: PHP Version
echo "<h2>1. PHP Version</h2>";
echo "<p>PHP Version: " . phpversion() . "</p>";

// Test 2: Check paths
echo "<h2>2. File Paths</h2>";
echo "<p>Current directory: " . __DIR__ . "</p>";
echo "<p>Parent directory: " . dirname(__DIR__) . "</p>";

// Test 3: Check if vendor exists
echo "<h2>3. Vendor Autoload</h2>";
$vendorPath = __DIR__.'/../vendor/autoload.php';
echo "<p>Vendor path: " . $vendorPath . "</p>";
echo "<p>Vendor exists: " . (file_exists($vendorPath) ? '✓ YES' : '✗ NO') . "</p>";

// Test 4: Check if bootstrap exists
echo "<h2>4. Bootstrap</h2>";
$bootstrapPath = __DIR__.'/../bootstrap/app.php';
echo "<p>Bootstrap path: " . $bootstrapPath . "</p>";
echo "<p>Bootstrap exists: " . (file_exists($bootstrapPath) ? '✓ YES' : '✗ NO') . "</p>";

// Test 5: Try to load Laravel
echo "<h2>5. Loading Laravel</h2>";
try {
    if (file_exists($vendorPath)) {
        require $vendorPath;
        echo "<p>✓ Autoloader loaded</p>";
        
        if (file_exists($bootstrapPath)) {
            $app = require_once $bootstrapPath;
            echo "<p>✓ Bootstrap loaded</p>";
            echo "<p>App class: " . get_class($app) . "</p>";
            
            // Try to handle a request
            $request = Illuminate\Http\Request::capture();
            echo "<p>✓ Request captured: " . $request->getUri() . "</p>";
            
            try {
                $response = $app->handleRequest($request);
                echo "<p>✓ Response generated</p>";
                echo "<p>Response status: " . $response->getStatusCode() . "</p>";
                echo "<hr><h2>6. Actual Response Content:</h2>";
                echo $response->getContent();
            } catch (Exception $e) {
                echo "<p style='color: red;'>✗ Error handling request: " . $e->getMessage() . "</p>";
                echo "<pre>" . $e->getTraceAsString() . "</pre>";
            }
        } else {
            echo "<p style='color: red;'>✗ Bootstrap file not found</p>";
        }
    } else {
        echo "<p style='color: red;'>✗ Vendor autoload not found</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Fatal error: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "</body></html>";
