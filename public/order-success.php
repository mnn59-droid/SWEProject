<?php
require_once __DIR__ . '/../src/bootstrap.php';

//no order redirect to home
$orderId = $_SESSION['last_order_id'] ?? null;
if(!$orderId) {
    header('Location: /');
    exit;
}
//load the order(prepare , execute and fetch)
$loadOrder = db()->prepare('SELECT firstname, customer_email, total FROM orders WHERE id = :id');
//store the row in $order
$loadOrder->execute(['id' => $orderId]);
$order = $loadOrder->fetch();
if($order === false) {
    header('Location: /');
    exit;
}   

//forget the id, refresh or a later visit doesn't show it again
unset($_SESSION['last_order_id']);
$pageTitle = 'Order confirmation';
include __DIR__ . '/../templates/header.php';

?>
<div class="page">
    <h1 class="page-title">Thank you, <?php echo e($order['firstname']); ?>!</h1>
    <p>Your  order<strong> #<?php echo e($orderId); ?></strong> has been placed successfully.</p>
    <p>Total: <?php echo money($order['total']); ?></p>
    <p>A confirmation will go to <?php echo e($order['customer_email']); ?>.</p>
    <a href="/" class="btn btn-primary">Continue shopping</a>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>