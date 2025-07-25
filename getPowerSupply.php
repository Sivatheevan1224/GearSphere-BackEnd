<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once "Main Classes/Compare_product.php";

try {
    $compareProduct = new Compare_product();
    $psus = $compareProduct->getAllPowerSuppliesWithDetails();

    echo json_encode([
        "success" => true,
        "data" => $psus
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Failed to fetch power supplies: " . $e->getMessage()
    ]);
}
