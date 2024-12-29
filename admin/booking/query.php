<?php

include("../config.php");

// change order satus

if (isset($_POST['action']) && $_POST['action'] == 'changeOrderStatus') {
    $orderId = $_POST['orderIdedit'];
    $orderStatus = $_POST['orderStatus'];
    $status_message = isset($_POST['messageedit']) ? $_POST['messageedit'] : '';

    // Fetch the order details to check payment_mode
    $sql = "SELECT payment_mode, price, assign_to FROM orders WHERE order_id = '$orderId'";
    $result = mysqli_query($conn, $sql);
    $order = mysqli_fetch_assoc($result);

    if ($orderStatus == 'Item Picked Up') {
        $sql = "UPDATE orders SET order_status = '$orderStatus', status_message = '$status_message', parcel_type = 'delivery' WHERE order_id = '$orderId'";
    } elseif ($orderStatus == 'Delivered' || $orderStatus == 'Returned') {
        $sql = "UPDATE orders SET order_status = '$orderStatus', status_message = '$status_message', parcel_type = '' WHERE order_id = '$orderId'";

        // Check if the order status is 'Delivered' and payment_mode is 'cod'
        if ($orderStatus == 'Delivered' && $order['payment_mode'] == 'cod') {
            $delivery_boy_id = $order['assign_to'];
            $amount = $order['price'];

            // Insert into delivery_history table
            $history_sql = "INSERT INTO delivery_history (order_id, delivery_boy_id, amount) VALUES ('$orderId', $delivery_boy_id, $amount)";
            mysqli_query($conn, $history_sql);

            // Update total collected amount for the delivery boy
            // $update_sql = "UPDATE delivery_boys SET total_collected = total_collected + $amount WHERE id = $delivery_boy_id";
            // mysqli_query($conn, $update_sql);
        }
    } else {
        $sql = "UPDATE orders SET order_status = '$orderStatus', status_message = '$status_message', parcel_type = 'delivery' WHERE order_id = '$orderId'";
    }

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Order status updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error in updating order status: ' . $conn->error));
    }
    exit;
}




