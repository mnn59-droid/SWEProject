<?php
require_once __DIR__ . '/../src/bootstrap.php';
clearCart();                                   // start fresh

echo '<pre>';
echo "add 2 of #1:        "; var_dump(addToCart(1, 2));      // NULL
echo "add 999 of #1:      "; var_dump(addToCart(1, 999));    // NULL, capped at stock
echo "add #9999:          "; var_dump(addToCart(9999, 1));   // "We don't have the product"
echo "add 0 of #2:        "; var_dump(addToCart(2, 0));      // "Quantity must be..."
echo "update #1 to 3:     "; var_dump(updateCartItem(1, 3)); // NULL, cart now 3
echo "add 1 of #2:        "; var_dump(addToCart(2, 1));
echo "update #2 to 0:     "; var_dump(updateCartItem(2, 0)); // NULL, #2 removed
echo "\ncart:  "; print_r(getCart());                      // expect [1 => 3]
echo "count: " . cartCount();                               // expect 3
echo '</pre>';
echo '<pev>';
print_r(cartSummary());
echo '</prev>';
?>