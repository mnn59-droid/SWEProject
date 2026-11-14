<?php
require_once __DIR__ . '/../src/bootstrap.php';

$summary = cartSummary();
$pageTitle = 'Your cart';
include __DIR__ . '/../templates/header.php';
?>

<div class = "page">
    <h1 class="page-title"> My Cart</h1>
    <?php if (empty($summary['items'])){ ?>
    <p>Please Select items to continue </p>
    <a href= /public/index.php >Shop</a>

    <?php } else { ?>
    <table class="cart-table">
            <thead>
                    cart items
            </thead>
<tbody>
    <?php foreach ($summary['items'] as $item) { ?> 
<tr>
    <td class= "cart-product">
        <img src="/assets/<?php echo e($item['product']['image_path']); ?>"
            alt="<?php echo e($item['product']['product_name']); ?>"
            width="64">
            <span><?php echo e($item['product']['product_name']); ?></span>
    </td>
    <td class="price">
        <?php echo money($item['product']['price']); ?>
    </td>
    <td>
        <input type="number" class="qty-input"
            value="<?php echo e($item['quantity']); ?>"
            min="0"
            max="<?php echo e($item['product']['stock']); ?>"
            data-id="<?php echo e($item['product']['id']); ?>">
            data-price="<?php echo e($item['product']['price']); ?>"
    </td>
    <td><?php echo money($item['line_total']); ?> </td>
    <td> 
        <button type="button" class="remove-item" data-id="<?php echo e($item['product']['id']); ?>">Remove</button>
    </td>
    <td class="line-total"><?php echo money($item['line_total']); ?> </td>
</tr>
<?php } ?>
</tbody>
</table>
    <div class="cart-totals">
        <p>Subtotal: <span id="cart-subtotal"><?php echo money($summary['subtotal']); ?></span></p>
        <p>Tax (6.625%): <span id="cart-tax"><?php echo money($summary['tax']); ?></span></p>
        <p><strong>Total: <span id="cart-total"><?php echo money($summary['total']); ?></span></strong></p>
        <a href="/checkout.php" class="btn btn-primary">Checkout</a>
</div>

<?php } ?>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
