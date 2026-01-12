<?php
require 'vendor/autoload.php';
$pdo = new PDO('mysql:host=localhost;dbname=schoolsystem', 'root', '');
$stmt = $pdo->query('SELECT name, email, student_number, role FROM users LIMIT 20');
foreach($stmt as $row) {
    echo $row['name'] . ' | ' . $row['email'] . ' | ' . $row['student_number'] . ' | ' . $row['role'] . PHP_EOL;
}
