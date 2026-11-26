<?php
require_once __DIR__ . '/../src/bootstrap.php';
$category = trim($_GET['category'] ?? '');
$sort = $_GET['sort'] ?? 'featured';
$products = getProducts($category, $sort);
$categories = getAllCategories();

$pageTitle = 'Shop';
include __DIR__ . '/../templates/header.php';

?>

<h1 class="page-title">Welcome to <?php echo e($shopName) ?></h1>
<p class="page-subtitle"><?php echo count($products) ?> products available</p>


<form method="GET" class="shop-filters">
<label>Category
    <select name="category" onchange="this.form.submit()">
      <option value="">All</option>
      <?php foreach ($categories as $c) { ?>
        <option value="<?= e($c) ?>" <?= $c === $category ? 'selected' : '' ?>><?= e($c) ?></option>
      <?php } ?>
    </select>
  </label>
  <label>Sort by
    <select name="sort" onchange="this.form.submit()">
      <?php foreach (PRODUCT_SORTS as $key => $opt) { ?>
        <option value="<?= $key ?>" <?= $key === $sort ? 'selected' : '' ?>><?= e($opt[0]) ?></option>
      <?php } ?>
    </select>
  </label>
  <noscript><button type="submit">Apply</button></noscript></form>

<?php if (empty($products)) { ?>
  <p>No products in this category yet.</p>
<?php } ?>


<section class="product-grid">
    <?php foreach ($products as $product) { ?>
        <?php include __DIR__ . '/../templates/product-card.php'; ?>
    <?php } ?>
    </section>

    <?php include __DIR__ . '/../templates/footer.php'; ?>
