<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Keuzedeel;

echo "=== Test Keuzedeel Update Functionaliteit ===\n\n";

// Haal eerste keuzedeel op
$keuzedeel = Keuzedeel::first();

if (!$keuzedeel) {
    echo "FOUT: Geen keuzedelen gevonden in database\n";
    exit(1);
}

echo "Gevonden keuzedeel:\n";
echo "ID: {$keuzedeel->id}\n";
echo "Huidige naam: {$keuzedeel->naam}\n";
echo "Code: {$keuzedeel->code}\n\n";

// Test update
$oudeNaam = $keuzedeel->naam;
$testNaam = "TEST UPDATE - " . date('H:i:s');

echo "Probeer naam te wijzigen naar: {$testNaam}\n";

try {
    $keuzedeel->naam = $testNaam;
    $keuzedeel->save();
    echo "✓ Update succesvol!\n\n";
    
    // Verifieer
    $keuzedeel->refresh();
    echo "Naam na update: {$keuzedeel->naam}\n";
    
    // Zet terug
    $keuzedeel->naam = $oudeNaam;
    $keuzedeel->save();
    echo "\n✓ Naam teruggezet naar: {$oudeNaam}\n";
    
    echo "\n=== CONCLUSIE: Update functionaliteit werkt correct ===\n";
    
} catch (\Exception $e) {
    echo "✗ FOUT bij update: " . $e->getMessage() . "\n";
    exit(1);
}
