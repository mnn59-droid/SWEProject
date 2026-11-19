<?php 
require_once __DIR__ . '/../src/bootstrap.php';

$summary = cartSummary();
if (empty($summary['items'])){
    header('Location: /cart.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

}

$pageTitle = 'Checkout';
include __DIR__ . '/../templates/header.php';
?>
<div class="page">
    <h1 class="page-title">Checkout</h1>

    <div class="checkout-container">
        <form method="post" action="/checkout.php" class="checkout-form">
            <h2>Your details</h2>

            <div class="form-row">
                <div class="form-group">
                    <label for="firstname">First name</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last name</label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>
                </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary checkout-btn">Place order</button>
        </form>
        
        <aside class="cart-summary">
    <h2>Order summary</h2>

    <?php foreach ($summary['items'] as $item) { ?>
        <div class="summary-item">
            <span><?php echo e($item['quantity']); ?> × <?php echo e($item['product']['product_name']); ?></span>
            <span><?php echo money($item['line_total']); ?></span>
        </div>
    <?php } ?>
    
        <div class="summary-item">
            <span>Subtotal</span>
            <span><?php echo money($summary['subtotal']); ?></span>
        </div>
        <div class="summary-item">
            <span>Tax (6.625%)</span>
            <span><?php echo money($summary['tax']); ?></span>
        </div>

    <div class="summary-total">
        <span>Total</span>
        <span><?php echo money($summary['total']); ?></span>
    </div>
</aside>    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>