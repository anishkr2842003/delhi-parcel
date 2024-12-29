<?php

include("../config.php");

// change order satus

if (isset($_POST['action']) && $_POST['action'] == 'changeOrderStatus') {

    $orderId = $_POST['orderIdedit2'];
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


//----------------------------------------------------------------------------------//	
//                               DELIVERY BOY SECTION                                   //
//----------------------------------------------------------------------------------//
// add Delivery
if (isset($_POST['action']) && $_POST['action'] == 'adddelivery') {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $fullAddress = $_POST['fullAddress'];
    $pinCode = $_POST['pinCode'];
    $password = $_POST['password'];
    $added_by = $_POST['delivery_id'];

    $sql = "INSERT INTO delivery (name, email, mobile, address, pincode, added_by, password) VALUES ('$fullName','$email','$phone', '$fullAddress', '$pinCode', '$added_by', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Delivery added successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error in adding delivery : ' . $conn->error));
    }
    exit;
}

// update delivery status
if (isset($_POST['action']) && $_POST['action'] == 'updateDeliveryStatus') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE delivery SET status = $status WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Delivery updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating delivery : ' . $conn->error));
    }
    exit;
}

// update seller login email and password
if (isset($_POST['action']) && $_POST['action'] == 'updateDelivery') {
    $loginId = $_POST['loginId'];
    $editName = $_POST['editName'];
    $loginEmail2 = $_POST['loginEmail2'];
    $editMobile = $_POST['editMobile'];
    $editAddress = $_POST['editAddress'];
    $editPincode = $_POST['editPincode'];
    $loginPassword2 = $_POST['loginPassword2'];

    $sql = "UPDATE delivery SET name = '$editName', email = '$loginEmail2', mobile = '$editMobile', address = '$editAddress', pincode = '$editPincode', password = '$loginPassword2' WHERE id = $loginId";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Delivery updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating delivery details : ' . $conn->error));
    }
    exit;
}
