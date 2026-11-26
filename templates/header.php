<?php
//shared top of every page
$shopName = "Marvin's Coffee";
$pageTitle = isset($pageTitle) ? $pageTitle : $shopName;
$cartCount = cartCount();
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
        <div class="header-inner">
            <a href="/" class="brand">
            <span class="brand-icon" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><ellipse cx="12" cy="12" rx="6.5" ry="9" transform="rotate(35 12 12)"/><path d="M8.5 17.5c2-3 5-7 7-11"/></svg>
            </span>
            <span class="wordmark"><?php echo e($shopName) ?></span>
            </a>

            <?php $navCategories = getAllCategories(); ?>
            <?php $currentCat = $_GET['category'] ?? ''; ?>
            <nav class="site-nav" id="site-nav">
                <a href="/" <?= $currentCat === '' ? 'class="active"' : '' ?>>All coffee</a>
                <?php foreach ($navCategories as $navCat) { ?>
                    <a href="/?category=<?= urlencode($navCat) ?>" <?= $currentCat === $navCat ? 'class="active"' : '' ?>><?= e($navCat) ?></a>
                <?php } ?>
            </nav>

            <a href="/cart.php" class="cart-link" aria-label="Cart">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 4h2l2.4 10.2a1 1 0 0 0 1 .8h8.8a1 1 0 0 0 1-.8L20 8H6.2"/><circle cx="9" cy="19" r="1.3"/><circle cx="17" cy="19" r="1.3"/></svg>
            <span id="cart-count" class="cart-badge"><?php echo e($cartCount) ?></span>   
            </a>

            <button type="button" class="menu-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="site-nav">  
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            </button>
        </div>
    </header>
        <main class="container">