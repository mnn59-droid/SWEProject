<?php
require_once __DIR__ . '/../src/bootstrap.php';
$products = getAllProducts();

$pageTitle = 'Shop';
include __DIR__ . '/../templates/header.php';

?>

<h1 class="page-title">Welcome to <?php echo e($shopName) ?></h1>
<p class="page-subtitle"><?php echo count($products) ?> products available</p>

<section class="product-grid">
    <?php foreach ($products as $product) { ?>
        <?php include __DIR__ . '/../templates/product-card.php'; ?>
    <?php } ?>
    </section>

    <?php include __DIR__ . '/../templates/footer.php'; ?>
