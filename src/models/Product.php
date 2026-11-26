<?php 
//all database queries for the products
//page calls these functions instead of writing SQL queries directly in the page

//every product in a catalog
function getAllProducts(): array
{
    $sql = 'SELECT id, product_name, description, price, stock, category, image_path, roast_level
    FROM products
    ORDER BY id';
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

function deleteProduct(int $id): void{

    $stmt = db() -> prepare('DELETE FROM products WHERE id = :id');
    $stmt -> execute(['id' => $id]);
}
function createProduct(array $d): void{
    $stmt = db() -> prepare('INSERT INTO products (product_name, description, price, stock, category, image_path, roast_level)
    VALUES (:product_name, :description, :price, :stock, :category, :image_path, :roast_level)');
    $stmt -> execute($d);
}

function updateProduct(int $id, array $d): void{
    $stmt = db() -> prepare('UPDATE products SET product_name = :product_name, description = :description, price = :price,
     stock = :stock, category = :category, image_path = :image_path, roast_level = :roast_level
     WHERE id = :id');
    $d['id'] = $id;
    $stmt -> execute($d);
}

?>