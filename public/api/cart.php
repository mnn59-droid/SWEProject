<?php
require_once __DIR__ . '/../../src/bootstrap.php';
header('content-Type: application/json');

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
	http_response_code(405);
	echo json_encode(['success' => false,'error' => 'Method not allowed']);
	exit;
}
$input = json_decode (file_get_contents('php://input'), true) ?? [];

$action = $input['action'] ?? '';
$productId = (int) ($input['product_id'] ?? 0);
$quantity = (int) ($input['quantity'] ?? 1);

switch($action){
    case 'add':
        $error = addToCart($productId,$quantity);

        break;
    case 'update':
        $error = updateCartItem($productId,$quantity);

        break;
    case 'remove': 
        removeFromCart($productId);
        $error = null;
        break;
    default:
    $error = 'Unknown action';

}
if($error){
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $error]);
    exit;
}
$summary = cartSummary();
echo json_encode([
    'success' => true,
    'cart_count' => cartCount(),
    'subtotal' => $summary['subtotal'],
    'tax' => $summary['tax'],
    'total' => $summary['total']
]);
?>