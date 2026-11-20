<?php
function placeOrder(string $firstname, string $lastname, string $email): int
{
    $pdo  = db();
    $cart = getCart();

    if (empty($cart)) {
        throw new RuntimeException('Your cart is empty.');
    }

    try {
        $pdo->beginTransaction();

        // 1. Lock each product row and check stock
        $lines    = [];
        $subtotal = 0;

        $lock = $pdo->prepare(
            'SELECT id, product_name, price, stock FROM products WHERE id = :id FOR UPDATE'
        );

        foreach ($cart as $productId => $quantity) {
            $lock->execute(['id' => $productId]);
            $product = $lock->fetch();

            if($product === false) {
                throw new RuntimeException("The Coffee in your cart is no longer available.");
            }
            if($product['stock'] < $quantity) {
                throw new RuntimeException("Not enough stock for product {$product['product_name']}. Only {$product['stock']} left.");
            }
            $subtotal += $product['price'] * $quantity;
            $lines[] = ['product' => $product, 'quantity' => $quantity];
        }

        // 3. Calculate tax and total
        $tax   = round($subtotal * TAX_RATE, 2);
        $total = round($subtotal + $tax, 2);    
        // 4. Save the order (yours)
        $insertOrder = $pdo->prepare(
            'INSERT INTO orders (firstname, lastname, customer_email, subtotal, tax, total)
             VALUES (:firstname, :lastname, :email, :subtotal, :tax, :total)
             RETURNING id'
        );
        $insertOrder->execute([
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'email'     => $email,
            'subtotal'  => round($subtotal, 2),
            'tax'       => $tax,
            'total'     => $total,
        ]);
        $orderId = $insertOrder->fetchColumn();

        //   INSERT INTO order_items (order_id, product_id, product_name, quantity, unit_price)
        //   UPDATE products SET stock = stock - :qty WHERE id = :id
        //   foreach ($lines as $line) { execute both }
        $insertItem = $pdo->prepare(
            'INSERT INTO order_items (order_id, product_id, product_name, quantity, unit_price)
             VALUES (:order_id, :product_id, :product_name, :quantity, :unit_price)'
        );
        $updateStock = $pdo->prepare(
            'UPDATE products SET stock = stock - :quantity WHERE id = :id'
        );
        foreach ($lines as $line) {
            $insertItem->execute([
                'order_id'     => $orderId,
                'product_id'   => $line['product']['id'],
                'product_name' => $line['product']['product_name'],
                'quantity'     => $line['quantity'],
                'unit_price'   => $line['product']['price'],
            ]);
            $updateStock->execute([
                'quantity' => $line['quantity'],
                'id'       => $line['product']['id'],
            ]);
        }

        $pdo->commit();
        return (int) $orderId;

    } catch (Throwable $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        throw $e;
    }
}
?>