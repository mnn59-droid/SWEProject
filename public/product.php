<?php

require_once __DIR__ . '/../src/bootstrap.php';

//read ?id from the url and look the product up in the database
$id = (int) ($_GET['id'] ?? 0);
$product = $id ? getProductById($id) : null;

//unknown id: send 404 response and show error page
if($product === null){
    http_response_code(404);
    $pageTitle = 'Product Not Found';
    include __DIR__ . '/../templates/header.php';


?>
<h1 class="page-title">Product Not Found</h1>
<p class="page-subtitle">The product you are looking for does not exist.</p>
<?php
include __DIR__ . '/../templates/footer.php';
exit;
}

$inStock = $product['stock'] > 0;
$lowStock = $product['stock'] <= 5 && $product['stock'] > 0;

$pageTitle = $product['product_name'];
include __DIR__ . '/../templates/header.php';
?>

<a href="/" class="back-link">&larr; Back to Shop</a>
<article class="product-detail">
<img class="product-detail-image"
src="/assets/<?php echo e($product['image_path']); ?>"
alt="<?php echo e($product['product_name']); ?>">

<div class="product-detail-info">
    <span class ="product-category"><?php echo e($product['category']); ?></span>
    <h1 class="page-title"><?php echo e($product['product_name']); ?></h1>
    <p class="product-detail-price"><?php echo money($product['price']); ?></p>
    <p class = "product-detail-description"><?php echo e($product['description']); ?></p>

    <?php if (!$inStock) { ?>
        <span class="badge badge-out">Out of Stock</span>
    <?php } else { ?>
    <p class="stock-note">
        <?php if ($lowStock) { ?>
            Hurry! Only <?php echo $product['stock']; ?> left in stock.
            ?>
            left</span>
        <?php } else { ?>
        <?php echo $product['stock']; ?> in stock</span>
        <?php } ?>
    </p>

    <div class = "add-to-cart-row">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>">
        <button type="button" class="btn add-to-cart" data-id="<?php echo $product['id']; ?>">
            Add to Cart
        </button>
    </div>  
        <?php } ?>
</div>
    </article>

    <?php include __DIR__ . '/../templates/footer.php'; ?>