<?php
declare(strict_types=1);
require_once __DIR__ . '/../src/SaleService.php';
$dsn=getenv('POLARIX_TEST_DSN'); if (!$dsn) { fwrite(STDERR,"Set POLARIX_TEST_DSN to run the integration test.\n"); exit(2); }
$db=new PDO($dsn,getenv('POLARIX_DB_USER')?:'root',getenv('POLARIX_DB_PASSWORD')?:'', [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
$db->exec('CREATE TEMPORARY TABLE products (id INT PRIMARY KEY, price DECIMAL(10,2), stock INT, active TINYINT)');
$db->exec('CREATE TEMPORARY TABLE sales (id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, total DECIMAL(10,2), payment_received DECIMAL(10,2), change_amount DECIMAL(10,2))');
$db->exec('CREATE TEMPORARY TABLE sale_details (id INT AUTO_INCREMENT PRIMARY KEY, sale_id INT, product_id INT, quantity INT, unit_price DECIMAL(10,2), subtotal DECIMAL(10,2))');
$db->exec('INSERT INTO products VALUES (1,10.00,5,1)'); $saleId=(new SaleService($db))->register(7,[['product_id'=>1,'quantity'=>2]],25.00); $stock=(int)$db->query('SELECT stock FROM products WHERE id=1')->fetchColumn();
if ($saleId<1 || $stock!==3) throw new RuntimeException('Integration test failed.'); echo "Integration test passed.\n";
