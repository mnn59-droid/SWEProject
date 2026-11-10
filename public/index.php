<?php

require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/bootstrap.php';
$products = db()->query('SELECT product_name, price, stock FROM products ORDER BY id')->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Database  test</title>
    </head>
    <body>
        <h1> <?php echo count($products) ?> Product found</h1>
        <ul>
            <?php foreach($products as $product): ?>
                <li>
                    <?php echo e($product['product_name']) ?> - <?php echo money($product['price']) ?> - <?php echo e($product['stock']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>