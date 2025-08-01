<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/Main Classes/Cart.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'] ?? null;
$product_id = $data['product_id'] ?? null;

if (!$user_id || !$product_id) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'User ID and Product ID are required.']);
    exit;
}

$cart = new Cart();
$success = $cart->removeFromCart($user_id, $product_id);

if ($success) {
    echo json_encode(['success' => true, 'message' => 'Product removed from cart.']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to remove product from cart.']);
}
