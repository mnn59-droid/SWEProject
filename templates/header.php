<?php
//shared top of every page
$shopName = "Catura Coffee";
$pageTitle = isset($pageTitle) ? $pageTitle : $shopName;
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;//total items in cart

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo e($pageTitle) ?></title>
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <header class="site-header">
            <a href="/" class="logo"><?php echo e($shopName) ?></a>
            <nav class="site-nav">
                <a href="/">Shop</a>
                <a href="/cart.php" class="cart-link">
                    Cart(<span class="cart-count"><?php echo e($cartCount) ?></span>)
                </a>
            </nav>
        </header>
        <main class="container">