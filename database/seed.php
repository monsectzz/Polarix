<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

$db = db();
$user = $db->prepare('INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)');
$user->execute(['Demo Employee', 'employee@polarix.test', password_hash('Polarix123!', PASSWORD_DEFAULT), 'employee']);

$product = $db->prepare('INSERT INTO products (name, price, stock, minimum_stock) VALUES (?, ?, ?, ?)');
$product->execute(['Strawberry Ice Pop', 15.00, 20, 5]);

echo "Seed data created.\n";
echo "Demo login: employee@polarix.test / Polarix123!\n";
