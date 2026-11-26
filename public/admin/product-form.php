<?php
require_once __DIR__ . '/../../src/bootstrap.php';
requireAdmin();

$id      = (int) ($_GET['id'] ?? 0);
$product = $id > 0 ? getProductById($id) : null;
if ($id > 0 && $product === null) {          
    header('Location: /admin/products.php');
    exit;
}


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
        'image_path'   => $product['image_path'] ?? '',
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
        $errors['roast_level'] = 'Roast level must be 1 – 5.';
    }
    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    $upload  = $_FILES['image'] ?? null;
    $newExt  = null;

    if ($upload && $upload['error'] === UPLOAD_ERR_OK) {
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($upload['tmp_name']);   
        if (!isset($allowed[$mime])) {
            $errors['image'] = 'Only JPG, PNG or WebP images are allowed.';
        } elseif ($upload['size'] > 2 * 1024 * 1024) {                  
            $errors['image'] = 'Image must be 2 MB or smaller.';
        } else {
            $newExt = $allowed[$mime];
        }
    } elseif ($upload && $upload['error'] !== UPLOAD_ERR_NO_FILE) {
        $errors['image'] = 'Upload failed. Try a smaller image.';
    } elseif ($form['image_path'] === '') {
        $errors['image'] = 'Please choose an image.';                       
    }

    if (empty($errors)) {
        if ($newExt !== null) {
            $fileName = bin2hex(random_bytes(8)) . '.' . $newExt;
            $target   = __DIR__ . '/../assets/img/products/' . $fileName;
            if (!move_uploaded_file($upload['tmp_name'], $target)) {                          
                exit('Could not save the image.');
            }
            $form['image_path'] = 'img/products/' . $fileName;
        }
                 

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
<div class="page admin-form">
  <div class="admin-bar">
    <h1><?= $id > 0 ? 'Edit product' : 'Add product' ?></h1>
    <nav>
      <a href="/admin/orders.php">Orders</a> ·
      <a href="/admin/products.php">Products</a> ·
      <a href="/admin/logout.php">Logout</a>
    </nav>
  </div>
  <p><a href="/admin/products.php" class="back-link">← Back to products</a></p>

  <form method="post" enctype="multipart/form-data"   novalidate>
    <?= csrfField() ?>

    <?php
    $fields = [
        'product_name' => 'Name',
        'category'     => 'Category',
        'price'        => 'Price ($)',
        'stock'        => 'Stock',
        'roast_level'  => 'Roast level (1 light – 5 dark)',
        
    ];
    foreach ($fields as $name => $label) { ?>
      <label><?= $label ?>
        <input type="text" name="<?= $name ?>" value="<?= e((string) $form[$name]) ?>">
      </label>
      <?php if (isset($errors[$name])) { ?><p class="error"><?= e($errors[$name]) ?></p><?php } ?>
    <?php } ?>

            <?php if ($form['image_path'] !== '') { ?>
        <p><img src="/assets/<?= e($form['image_path']) ?>" alt="" width="96" style="border-radius:8px"></p>
        <?php } ?>
        <label>Product image (JPG, PNG or WebP, max 2 MB)
        <input type="file" name="image" accept="image/jpeg,image/png,image/webp">
        </label>
        <?php if (isset($errors['image'])) { ?><p class="error"><?= e($errors['image']) ?></p><?php } ?>

    <label>Description
      <textarea name="description" rows="4"><?= e($form['description']) ?></textarea>
    </label>

    <button type="submit"><?= $id > 0 ? 'Save changes' : 'Add product' ?></button>
  </form>
</div>
<?php require __DIR__ . '/../../templates/footer.php'; ?>