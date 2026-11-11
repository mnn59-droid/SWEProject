<?php 
//all database queries for the products
//page calls these functions instead of writing SQL queries directly in the page

//every product in a catalog
function getAllProducts(): array
{
    $sql = 'SELECT id, product_name, description, price, stock, category, image_path FROM products ORDER BY id';
    return db()->query($sql)->fetchAll();
}

//one product by its id or null if not found
function getProductById(int $id): ?array
{
    $sql = 'SELECT id, product_name, description, price, stock, category, image_path FROM products WHERE id = :id';
    $stmt = db()->prepare($sql);
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch();
    return $product ?: null;
}
///the list of categories in the catalog
function getAllCategories(): array
{
    return db()->query('SELECT DISTINCT category FROM products ORDER BY category')->fetchAll(PDO::FETCH_COLUMN);
}
?>