<?php
require_once __DIR__ . '/../../src/bootstrap.php';
requireAdmin();

$orders = getAllOrders();
$itemsByOrder = getItemsByOrder();
?>
<?php require __DIR__ . '/../../templates/header.php'; ?>
<main class="page admin-orders">
    <div class="admin-bar">
        <h1>Orders</h1>
        <a href="/admin/logout.php">Logout</a>
    </div>

    <?php if (empty($orders)) { ?>
        <p>No orders found.</p>
    <?php } else { ?>
        <table>
            <thead>
                <tr><th>#</th><th>Date</th><th>Customer</th><th>Items</th><th>Total</th><th>Status</th></tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) { ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                <td><?= date('M j, Y g:i a', strtotime($order['created_at'])) ?></td>
                <td>
                    <?= e($order['firstname']) ?> <?= e($order['lastname']) ?><br>
                    <small><?= e($order['customer_email']) ?></small>
                </td>
                <td>
                    <?php foreach ($itemsByOrder[$order['id']] ?? [] as $item){ ?>
                    <?= e($item['product_name']) ?> x <?= $item['quantity'] ?><br>
                    <?php } ?>
                </td>
                <td><?= money($order['total']) ?></td>
                <td><?= e($order['status']) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
    </main>
<?php require __DIR__ . '/../../templates/footer.php'; ?>

