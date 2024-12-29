<?php
session_start();

include("../config.php");

// var_dump($_POST);
// die();

// Retrieve form data
$service_type = $_POST['service_type'];
$service_title = $_POST['service_title'];
$seller_id = $_POST['seller_id'];

$fetchSeller = "SELECT * FROM seller WHERE id = $seller_id";
$fetchSellerQuery = mysqli_query($conn, $fetchSeller);

$fetchSellerResult = mysqli_fetch_assoc($fetchSellerQuery);

$sender_name = $_POST['sender_name'];
$sender_number = $_POST['sender_number'];
$sender_email = $_POST['sender_email'];
$sender_address = $_POST['sender_address'];
$senderPincode = $_POST['senderPincode'];
$receiver_name = $fetchSellerResult['fullName'];
$receiver_number = $fetchSellerResult['phone'];
$receiver_email = $fetchSellerResult['email'];
$receiver_address = $fetchSellerResult['fullAddress'];
$receiverPincode = $fetchSellerResult['pincode'];
$insurance = isset($_POST['insurance']) ? 1 : 0;
$price = $_POST['price'];
$payment_mode = $_POST['payment_methods'];
$parcel_type = "pickup";



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

// $seller_id = $_SESSION['seller_id'];

$sql = "INSERT INTO orders (order_id, seller_id, sender_name, sender_number, sender_email, sender_address, sender_pincode, receiver_name, receiver_number, receiver_email, receiver_address, receiver_pincode, service_type, service_title, insurance, price, payment_mode, parcel_type)
        VALUES ('$order_id', $seller_id, '$sender_name', '$sender_number', '$sender_email', '$sender_address', '$senderPincode', '$receiver_name', '$receiver_number', '$receiver_email', '$receiver_address', '$receiverPincode', '$service_type', '$service_title', '$insurance', $price, '$payment_mode', '$parcel_type')";

if ($conn->query($sql) === TRUE) {
    echo "Order saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
