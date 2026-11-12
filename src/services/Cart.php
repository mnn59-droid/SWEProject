<?php 
//ALL items in the cart
function getCart(): array{
    return $_SESSION['cart'] ?? [];
} 
function cartCount(): int{
   return array_sum(getCart());
}
function addToCart(int $productId, int $quantity): ?string{
    if($quantity < 1){ return "Quantity must be greater than 0";}
    $product = getProductById($productId);
    if($product === null ){  return "We don't have the product";}
    if($product['stock'] < 1){ return "Product out of stock!";}

    $current = $_SESSION['cart'][$productId] ?? 0;
    $newQuantity = $current + $quantity;
    $_SESSION['cart'][$productId] = min($newQuantity,$product['stock']);
    return null;
}
function removeFromCart(int $productId): void{
    unset($_SESSION['cart'][$productId]);
}
function clearCart(): void{
    $_SESSION['cart'] = [];
}
function updateCartItem(int $productId, int $quantity): ?string{
    if($quantity < 1){
        removeFromCart($productId);
        return null;
    }
    $product = getProductById($productId);
    if($product === null){return "We don't have the product";}
    if($product['stock']<1){ return "Product out of stock!";}
   
    $_SESSION['cart'][$productId] = min($quantity,$product['stock']);
    return null;
}
?>