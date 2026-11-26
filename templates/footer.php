</main>

<footer class="site-footer">
  <div class="footer-grid footer-inner">
    <div class="footer-brand">
      <p class="footer-wordmark"><?= e($shopName) ?></p>
      <p>Small-batch coffee, roasted to order. Building our own coffee line, one bag at a time.</p>
    </div>

    <nav aria-label="Shop links">
      <h4>Shop</h4>
      <a href="/">All coffee</a>
      <?php foreach (getAllCategories() as $footCat) { ?>
        <a href="/?category=<?= urlencode($footCat) ?>"><?= e($footCat) ?></a>
      <?php } ?>
    </nav>

    <nav aria-label="Help links">
      <h4>Help</h4>
      <a href="/cart.php">Your cart</a>
      <a href="/checkout.php">Checkout</a>
      <a href="mailto:<?= e(ADMIN_EMAIL) ?>">Contact us</a>
    </nav>
  </div>

    <p class="footer-bottom footer-inner">
            © <?= date('Y') ?> <?= e($shopName) ?>. All rights reserved.
            <a href="/admin/login.php" class="staff-link">Staff login</a>
    </p>
</footer>

<script src="/assets/js/cart.js"></script>
<script src="/assets/js/menu.js"></script>
<script src="/assets/js/hero.js"></script>
</body>
</html>