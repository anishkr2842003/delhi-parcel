<?php
include("admin/config.php");

// var_dump($_POST);
// die();

// Retrieve form data
// $order_id = $_POST['order_id'];
// $invoice = $_POST['invoice'];
// $label = $_POST['label'];
// $seller_id = $_POST['seller_id'];
$service_type = $_POST['service_type'];
$title = $_POST['title'];
$sender_name = $_POST['sender_name'];
$sender_number = $_POST['sender_number'];
$sender_email = $_POST['sender_email'];
$sender_address = $_POST['sender_address'];
$senderPincode = $_POST['senderPincode'];
$receiver_name = $_POST['receiver_name'];
$receiver_number = $_POST['receiver_number'];
$receiver_email = $_POST['receiver_email'];
$receiver_address = $_POST['receiver_address'];
$receiverPincode = $_POST['receiverPincode'];
$insurance = isset($_POST['insurance']) ? 1 : 0;
$price = $_POST['price'];
$payment_mode = $_POST['payment_methods'];

// var_dump($_POST);
// die();


$fetchLastOrderId = "SELECT id FROM orders ORDER BY id DESC LIMIT 1";
$resultLastOrderId = mysqli_query($conn, $fetchLastOrderId);

if ($resultLastOrderId && mysqli_num_rows($resultLastOrderId) > 0) {
    $row = mysqli_fetch_assoc($resultLastOrderId);
    $lastOrderId = $row['id'];
} else {
    $lastOrderId = 0; // If no orders exist, start from 0
}

$newOrderId = $lastOrderId + 1;
$order_id = "DP" . $newOrderId;


$seller_id = 0; // means this is self user

$sql = "INSERT INTO orders (order_id, seller_id, sender_name, sender_number, sender_email, sender_address, sender_pincode, receiver_name, receiver_number, receiver_email, receiver_address, receiver_pincode, service_type, service_title, insurance, price, payment_mode )
        VALUES ('$order_id', $seller_id, '$sender_name', '$sender_number', '$sender_email', '$sender_address', '$senderPincode', '$receiver_name', '$receiver_number', '$receiver_email', '$receiver_address', '$receiverPincode', '$service_type', '$title', '$insurance', $price, '$payment_mode')";

if (mysqli_query($conn, $sql)) {
    echo "Order created successfully";
} else {
    echo "Error";
}
