<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/AuthService.php';
require_once __DIR__ . '/../src/SaleService.php';

$db = db();
$user = (new AuthService($db))->login('employee' . chr(64) . 'polarix.test', 'Polarix123!');
if (!$user) throw new RuntimeException('Login failed.');
$saleId = (new SaleService($db))->register((int) $user['id'], [['product_id' => 1, 'quantity' => 2]], 40.00);
$stock = (int) $db->query('SELECT stock FROM products WHERE id = 1')->fetchColumn();
echo "Login OK; sale #{$saleId}; remaining stock: {$stock}\n";
