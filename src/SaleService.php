<?php
declare(strict_types=1);
final class SaleService {
    public function __construct(private PDO $db) {}
    public function register(int $userId, array $items, float $payment): int {
        if (!$items || $payment < 0) throw new InvalidArgumentException('A sale requires products and valid payment.');
        $this->db->beginTransaction();
        try {
            $total = 0.0; $lines = [];
            $product = $this->db->prepare('SELECT id, price, stock FROM products WHERE id = ? AND active = 1 FOR UPDATE');
            foreach ($items as $item) {
                $quantity = filter_var($item['quantity'] ?? null, FILTER_VALIDATE_INT);
                if (!$quantity || $quantity < 1) throw new InvalidArgumentException('Quantity must be greater than zero.');
                $product->execute([(int) $item['product_id']]); $row = $product->fetch();
                if (!$row || (int) $row['stock'] < $quantity) throw new RuntimeException('Product not found or stock is insufficient.');
                $subtotal = (float) $row['price'] * $quantity; $total += $subtotal; $lines[] = [$row, $quantity, $subtotal];
            }
            if ($payment < $total) throw new InvalidArgumentException('Payment is lower than the sale total.');
            $sale = $this->db->prepare('INSERT INTO sales (user_id,total,payment_received,change_amount) VALUES (?,?,?,?)');
            $sale->execute([$userId, $total, $payment, $payment - $total]); $saleId = (int) $this->db->lastInsertId();
            $detail = $this->db->prepare('INSERT INTO sale_details (sale_id,product_id,quantity,unit_price,subtotal) VALUES (?,?,?,?,?)');
            $stock = $this->db->prepare('UPDATE products SET stock = stock - ? WHERE id = ?');
            foreach ($lines as [$row, $quantity, $subtotal]) { $detail->execute([$saleId,$row['id'],$quantity,$row['price'],$subtotal]); $stock->execute([$quantity,$row['id']]); }
            $this->db->commit(); return $saleId;
        } catch (Throwable $error) { if ($this->db->inTransaction()) $this->db->rollBack(); throw $error; }
    }
}
