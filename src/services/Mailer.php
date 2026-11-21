<?php 
function orderEmailParams(int $orderId): ?array{
    $pdo = db();

    //the order
    $stmt = $pdo -> prepare('SELECT firstname, lastname, customer_email, subtotal, tax, total
    FROM orders WHERE id = :id');
    $stmt -> execute(['id' => $orderId]);
    $order = $stmt -> fetch();
    if($order === false) {
        return null;
    }
    //its items
    $stmt = $pdo -> prepare('SELECT product_name, quantity, unit_price
    FROM order_items WHERE order_id = :id ORDER BY id');

    $stmt -> execute(['id' => $orderId]);
    $items = $stmt -> fetchAll();

    //one line per item
    $lines = [];
    foreach($items as $item){
        $lines [] = e($item['product_name'])
        . ' × ' . $item['quantity']
        . ' @ ' . money($item['unit_price']);
    }
    //return the params

    return [
        'to_email' => ADMIN_EMAIL,
        'order_id' => $orderId,
        'customer_name' => $order['firstname'] . ' ' . $order['lastname'],
        'customer_email' => $order['customer_email'],
        'items' => implode('<br>', $lines),
        'subtotal' => money($order['subtotal']),
        'tax' => money($order['tax']),
        'total' => money($order['total'])

    ];
}
function sendOrderEmail(int $orderId): bool{
    try{
        $params = orderEmailParams($orderId);
        if($params === null){
            error.log("sendOrderEmail: Order #$orderId not found");
            return false;
        }

        $payload = [
            'service_id' => EMAILJS_SERVICE_ID,
            'template_id' => EMAILJS_TEMPLATE_ID,
            'user_id' => EMAILJS_PUBLIC_KEY,
            'accessToken' => EMAILJS_PRIVATE_KEY,
            'template_params' => $params
        ];

        $ch = curl_init('https://api.emailjs.com/api/v1.0/email/send');
        curl_setopt_array($ch,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_TIMEOUT => 10
        ]);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr = curl_error($ch);

        if($status !== 200){
            error_log("EMAILJS failed for order #$orderId: HTTP $status, response: $response, curl error: $curlErr");
            return false;

        }
        return true;
    }catch(Throwable $e){
        error.log('sendOrderEmail error: ' . $e->getMessage());
        return false;
    }
}


?>