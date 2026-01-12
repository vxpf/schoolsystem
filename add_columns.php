<?php
$pdo = new PDO('sqlite:database/database.sqlite');
$pdo->exec('ALTER TABLE keuzedeel_user ADD COLUMN eerder_gedaan BOOLEAN DEFAULT 0');
$pdo->exec('ALTER TABLE keuzedeel_user ADD COLUMN eerder_markering TEXT');
echo "Kolommen toegevoegd!";
