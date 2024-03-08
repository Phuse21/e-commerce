<?php
include("includes/connectionPage.php");
include("functions/common_functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subtotal']) && isset($_POST['vat']) && isset($_POST['totalPrice'])) {
    $_SESSION['subtotal'] = $_POST['subtotal'];
    $_SESSION['vat'] = $_POST['vat'];
    $_SESSION['total_price'] = $_POST['totalPrice'];

    // Log the prices individually
    $subtotal = $_POST['subtotal'];
    $vat = $_POST['vat'];
    $totalPrice = $_POST['totalPrice'];
    error_log("Subtotal: $subtotal, VAT: $vat, Total Price: $totalPrice");

    // Return success response along with logged prices
    http_response_code(200);
    echo json_encode(array('subtotal' => $_SESSION['subtotal'], 'vat' => $_SESSION['vat'], 'totalPrice' => $_SESSION['total_price']));
} else {
    // Return error response
    http_response_code(400);
    echo 'Error: Invalid request.';
}


$productId = isset($_GET['add_to_cart']) ? $_GET['add_to_cart'] : null;

//calling cart function
addToCart($productId);