<?php

function cartSummary():  array{
    $items = [];
    $subtotal = 0;
    
    foreach(getCart() as $productId => $quantity){
        $product = getProductById($productId);
        if($product === null){removeFromCart($productId);}else{
            $lineTotal = $quantity * $product['price'];
            $subtotal += $lineTotal;
            $items[] =[
                'product' => $product,
                'quantity' => $quantity,
                'line_total' => $lineTotal
            ];
        }   
    }
    $tax = round(TAX_RATE * $subtotal, 2);
    return [
        'items' => $items,
        'subtotal' => round($subtotal,2),
        'tax' => $tax,
        'total' => round($subtotal + $tax ,2) 
    ];
}
?>