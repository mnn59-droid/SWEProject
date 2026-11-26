<?php
require_once __DIR__ . '/../../src/bootstrap.php';
requireAdmin();

$id      = (int) ($_GET['id'] ?? 0);
$product = $id > 0 ? getProductById($id) : null;
if ($id > 0 && $product === null) {          
    header('Location: /admin/products.php');
    exit;
}

// Starting values: the product being edited, or blanks for a new one
$form = $product ?? [
    'product_name' => '', 'description' => '', 'price' => '', 'stock' => '',
    'category' => '', 'image_path' => '', 'roast_level' => 3,
];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();                                 

    $form = [
        'product_name' => trim($_POST['product_name'] ?? ''),
        'description'  => trim($_POST['description'] ?? ''),
        'price'        => trim($_POST['price'] ?? ''),
        'stock'        => trim($_POST['stock'] ?? ''),
        'category'     => trim($_POST['category'] ?? ''),
        'image_path'   => trim($_POST['image_path'] ?? ''),
        'roast_level'  => trim($_POST['roast_level'] ?? ''),
    ];

    $price = filter_var($form['price'], FILTER_VALIDATE_FLOAT);
    $stock = filter_var($form['stock'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
    $roast = filter_var($form['roast_level'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 5]]);

    if (mb_strlen($form['product_name']) < 2 || mb_strlen($form['product_name']) > 150) {
        $errors['product_name'] = 'Name must be 2–150 characters.';
    }
    if ($price === false || $price <= 0) {
        $errors['price'] = 'Enter a price greater than 0.';
    }
    if ($stock === false) {                 
        $errors['stock'] = 'Stock must be a whole number, 0 or more.';
    }
    if ($form['category'] === '') {
        $errors['category'] = 'Category is required.';
    }
    if ($roast === false) {
        $errors['roast_level'] = 'Roast level must be 1–5.';
    }
    if ($form['image_path'] === '') {
        $errors['image_path'] = 'Image path is required (upload comes in 9.7).';
    }

    if (empty($errors)) {
        $data = $form;
        $data['price'] = $price;
        $data['stock'] = $stock;
        $data['roast_level'] = $roast;

        if ($id > 0) {
            updateProduct($id, $data);
        } else {
            createProduct($data);                     
        }
        header('Location: /admin/products.php');
        exit;
    }
}
?>
<?php require __DIR__ . '/../../templates/header.php'; ?>
<main class="page checkout-container">
  <h1><?= $id > 0 ? 'Edit product' : 'Add product' ?></h1>
  <p><a href="/admin/products.php">← Back to products</a></p>

  <form method="post" novalidate>
    <?= csrfField() ?>

    <?php
    $fields = [
        'product_name' => 'Name',
        'category'     => 'Category',
        'price'        => 'Price ($)',
        'stock'        => 'Stock',
        'roast_level'  => 'Roast level (1 light – 5 dark)',
        'image_path'   => 'Image path (e.g. img/products/guatemala.jpg)',
    ];
    foreach ($fields as $name => $label) { ?>
      <label><?= $label ?>
        <input type="text" name="<?= $name ?>" value="<?= e((string) $form[$name]) ?>">
      </label>
      <?php if (isset($errors[$name])) { ?><p class="error"><?= e($errors[$name]) ?></p><?php } ?>
    <?php } ?>

    <label>Description
      <textarea name="description" rows="4"><?= e($form['description']) ?></textarea>
    </label>

    <button type="submit"><?= $id > 0 ? 'Save changes' : 'Add product' ?></button>
  </form>
</main>
<?php require __DIR__ . '/../../templates/footer.php'; ?>