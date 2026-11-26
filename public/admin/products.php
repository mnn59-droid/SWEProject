<?php 
require_once __DIR__ . '/../../src/bootstrap.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    verifyCsrf();

    $id = (int) ($_POST['id'] ?? 0);
    if ($id > 0){
        deleteProduct($id);
    }
    header('Location: /admin/products.php');
    exit;
}

$products = getAllProducts();

?>
<?php require __DIR__ . '/../../templates/header.php'; ?>
<main class="page admin-orders">
    <div class="admin-bar">
        <h1>Products</h1>
        <nav>
            <a href="/admin/orders.php">Orders</a> .
            <a href="/admin/products.php">Products</a> .
            <a href="/admin/product-form.php">+ Add Product</a> .
            <a href="/admin/logout.php">Logout</a>
        </nav>
    </div>

    <table>
        <thead>
            <tr><th></th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th></th></tr>
        </thead>
        <tbody>
            <?php foreach ($products as $p) { ?>
                <tr>
                    <td><img src="/assets/<?= e($p['image_path']) ?>" alt="" width="48" height="48" style="object-fit:cover;border-radius:6px;"></td>
                    <td><?= e($p['product_name']) ?></td>
                    <td><?= e($p['category']) ?></td>
                    <td><?= money($p['price']) ?></td>
                    <td><?= (int) $p['stock'] ?></td>
                    <td class="status-form">
                        <form method="post" onsubmit="return confirm('Delete this Product? This cannot be undone.')">
                            <?= csrfField() ?>
                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                            <a href="/admin/product-form.php?id=<?= $p['id'] ?>">Edit</a>
                            <button type="submit">Delete</button>
                        </form>
            </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
            </main>

            <?php require __DIR__ . '/../../templates/footer.php'; ?>



    