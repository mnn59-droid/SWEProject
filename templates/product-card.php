<?php
// One product card. The page that includes this file must set $product first.
$inStock  = $product['stock'] > 0;
$lowStock = $inStock && $product['stock'] <= 5;
?>
<article class="product-card">
    <a href="/product.php?id=<?php echo $product['id']; ?>" class="product-image">
        <img src="/assets/<?php echo e($product['image_path']); ?>"
             alt="<?php echo e($product['product_name']); ?>"
             loading="lazy">
    </a>

    <div class="product-info">
        <span class="product-category"><?php echo e($product['category']); ?></span>
        <h3 class="product-name">
            <a href="/product.php?id=<?php echo $product['id']; ?>"><?php echo e($product['product_name']); ?></a>
        </h3>
        <?php include __DIR__ . '/roast-meter.php'; ?>
        <p class="product-description"><?php echo e($product['description']); ?></p>

        <div class="product-footer">
            <span class="product-price"><?php echo money($product['price']); ?></span>

            <?php if (!$inStock) { ?>
                <span class="badge badge-out">Out of Stock</span>
            <?php } else { ?>
                <?php if ($lowStock) { ?>
                    <span class="badge badge-low">Only <?php echo $product['stock']; ?> left!</span>
                <?php } ?>
                <button type="button" class="btn add-to-cart" data-id="<?php echo $product['id']; ?>">
                    Add to Cart
                </button>
            <?php } ?>
        </div>
    </div>
</article>