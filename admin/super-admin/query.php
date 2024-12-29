<?php

include("../config.php");
//----------------------------------------------------------------------------------//	
//                               SERVICES SECTION                                   //
//----------------------------------------------------------------------------------//
// add services
if (isset($_POST['action']) && $_POST['action'] == 'addService') {
    $servicesTitle = $_POST['servicesTitle'];
    $servicesPrice = $_POST['servicesPrice'];
    $service_type = $_POST['service_type'];

    if ($service_type == "super_express") {
        $sql = "INSERT INTO services (title, price, service_type) VALUES ('$servicesTitle', '$servicesPrice', 'Super-Express')";
    } else if ($service_type == "express") {
        $sql = "INSERT INTO services (title, price, service_type) VALUES ('$servicesTitle', '$servicesPrice', 'Express')";
    } else {
        $sql = "INSERT INTO services (title, price, service_type) VALUES ('$servicesTitle', '$servicesPrice', 'Standred')";
    }

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Services added successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error adding services : ' . $conn->error));
    }
    exit;
}

// update services
if (isset($_POST['action']) && $_POST['action'] == 'updateService') {
    $servicesId = $_POST['servicesId2'];
    $servicesTitle = $_POST['servicesTitle2'];
    $servicesPrice = $_POST['servicesPrice2'];
    // $service_type = $_POST['service_type'];

    $sql = "UPDATE services SET title = '$servicesTitle', price = '$servicesPrice' WHERE id = $servicesId";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Services updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating services : ' . $conn->error));
    }
    exit;
}

// update services status
if (isset($_POST['action']) && $_POST['action'] == 'updateServicesStatus') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE services SET status = $status WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Services updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating services : ' . $conn->error));
    }
    exit;
}

// delete services
if (isset($_POST['action']) && $_POST['action'] == 'deleteServices') {
    $id = $_POST['id'];

    $sql = "DELETE FROM services WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Services delete successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting services : ' . $conn->error));
    }
    exit;
}

//----------------------------------------------------------------------------------//	
//                               PINCODE SECTION                                   //
//----------------------------------------------------------------------------------//
// add pincodes
if (isset($_POST['action']) && $_POST['action'] == 'addPincode') {
    $pincode = $_POST['pincode'];

    $fetchPincode = "SELECT pincode FROM pincodes WHERE pincode = $pincode";
    $result = mysqli_query($conn, $fetchPincode);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(array('status' => 'error', 'message' => 'Pincode already exists'));
        exit;
    }

    $sql = "INSERT INTO pincodes (pincode) VALUES ('$pincode')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Pincode added successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error adding pincodes : ' . $conn->error));
    }
    exit;
}

// update pincodes status
if (isset($_POST['action']) && $_POST['action'] == 'updatePincodeStatus') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE pincodes SET status = $status WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Pincode updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating pincodes : ' . $conn->error));
    }
    exit;
}

// delete pincodes
if (isset($_POST['action']) && $_POST['action'] == 'deletePincodes') {
    $id = $_POST['id'];

    $sql = "DELETE FROM pincodes WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Pincode delete successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting pincodes : ' . $conn->error));
    }
    exit;
}

//----------------------------------------------------------------------------------//	
//                               REVIEW SECTION                                   //
//----------------------------------------------------------------------------------//
// add Reviews
if (isset($_POST['action']) && $_POST['action'] == 'addReviews') {
    $clientName = $_POST['clientName'];
    $clientMessage = $_POST['clientMessage'];

    $sql = "INSERT INTO reviews (name, message) VALUES ('$clientName', '$clientMessage')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Review added successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error adding reviews : ' . $conn->error));
    }
    exit;
}

// update review status
if (isset($_POST['action']) && $_POST['action'] == 'updateReviewsStatus') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE reviews SET status = $status WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Review updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating reviews : ' . $conn->error));
    }
    exit;
}

// delete reviews
if (isset($_POST['action']) && $_POST['action'] == 'deleteReviews') {
    $id = $_POST['id'];

    $sql = "DELETE FROM reviews WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Review delete successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting reviews : ' . $conn->error));
    }
    exit;
}

//----------------------------------------------------------------------------------//	
//                               CATEGORY SECTION                                   //
//----------------------------------------------------------------------------------//
// add Category
if (isset($_POST['action']) && $_POST['action'] == 'addCategory') {
    $categoryName = $_POST['categoryName'];

    $sql = "INSERT INTO categories (name) VALUES ('$categoryName')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Category added successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error adding category : ' . $conn->error));
    }
    exit;
}

// update category status
if (isset($_POST['action']) && $_POST['action'] == 'updateCategoryStatus') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE categories SET status = $status WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Category updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating category : ' . $conn->error));
    }
    exit;
}

// delete category
if (isset($_POST['action']) && $_POST['action'] == 'deleteCategory') {
    $id = $_POST['id'];

    $sql = "DELETE FROM categories WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Category delete successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting category : ' . $conn->error));
    }
    exit;
}


//----------------------------------------------------------------------------------//	
//                               SELLER SECTION                                   //
//----------------------------------------------------------------------------------//
// add Seller
if (isset($_POST['action']) && $_POST['action'] == 'addSeller') {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];
    $fullAddress = $_POST['fullAddress'];
    $itemsCount = $_POST['itemsCount'];
    $panNo = $_POST['panNo'];
    $panImage = $_FILES['panImage'];
    $pinCode = $_POST['pinCode'];
    $frenchiesType = $_POST['frenchiesType'];
    $sellerLogo = $_FILES['sellerLogo'];

    $panImagePath = '';
    if (isset($_FILES['panImage']) && $_FILES['panImage']['error'] == 0) {
        $targetDir = "uploads/panImages/";
        $originalFileName = basename($_FILES['panImage']['name']);
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '_' . time() . '.' . $fileExtension;
        $targetFile = $targetDir . $uniqueFileName;

        if (move_uploaded_file($_FILES['panImage']['tmp_name'], $targetFile)) {
            $panImagePath = $targetFile;
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'File upload failed'));
            exit;
        }
    }

    $sellerLogoPath = '';
    if (isset($_FILES['sellerLogo']) && $_FILES['sellerLogo']['error'] == 0) {
        $targetDir = "uploads/sellerLogo/";
        $originalFileName = basename($_FILES['sellerLogo']['name']);
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '_' . time() . '.' . $fileExtension;
        $targetFile = $targetDir . $uniqueFileName;

        if (move_uploaded_file($_FILES['sellerLogo']['tmp_name'], $targetFile)) {
            $sellerLogoPath = $targetFile;
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'File upload failed'));
            exit;
        }
    }


    $nameParts = explode(' ', $fullName);
    $loginPassword = $nameParts[0] . '@' . $pinCode;

    $sql = "INSERT INTO seller (fullName, email, phone, category, fullAddress, itemsCount, panNo, image, seller_logo, pincode, type, login_password) VALUES ('$fullName','$email','$phone','$category','$fullAddress','$itemsCount','$panNo','$panImagePath','$sellerLogoPath','$pinCode', '$frenchiesType', '$loginPassword')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Seller added successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error in adding seller : ' . $conn->error));
    }
    exit;
}


// update seller status
if (isset($_POST['action']) && $_POST['action'] == 'updateSellerStatus') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE seller SET status = $status WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Seller updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating seller : ' . $conn->error));
    }
    exit;
}

// update seller login email and password
if (isset($_POST['action']) && $_POST['action'] == 'updateSellerLogin') {
    $loginId = $_POST['loginId'];
    $loginEmail2 = $_POST['loginEmail2'];
    $loginPassword2 = $_POST['loginPassword2'];
    // $service_type = $_POST['service_type'];

    $sql = "UPDATE seller SET login_email = '$loginEmail2', login_password = '$loginPassword2' WHERE id = $loginId";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Seller login details updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating seller login details : ' . $conn->error));
    }
    exit;
}

// delete Seller
if (isset($_POST['action']) && $_POST['action'] == 'deleteSeller') {
    $id = $_POST['id'];

    // Fetch the image path
    $fetchImg = "SELECT image FROM seller WHERE id = $id";
    $result = mysqli_query($conn, $fetchImg);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imagePath = $row['image'];

        // Delete the image file from the file system
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete the record from the database
    $sql = "DELETE FROM seller WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Seller deleted successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting seller: ' . $conn->error));
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

    $sql = "INSERT INTO delivery (name, email, mobile, address, pincode, password) VALUES ('$fullName','$email','$phone', '$fullAddress', '$pinCode','$password')";

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

// delete Delivery Boy
if (isset($_POST['action']) && $_POST['action'] == 'deleteDelivery') {
    $id = $_POST['id'];

    // Delete the record from the database
    $sql = "DELETE FROM delivery WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Delivery deleted successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting delivery: ' . $conn->error));
    }
    exit;
}

//----------------------------------------------------------------------------------//	
//                               ASSIGNING SYSTEM                                   //
//----------------------------------------------------------------------------------//
// assign to delivery boy
if (isset($_POST['action']) && $_POST['action'] == 'assignto') {
    $orderId = $_POST['orderIdedit'];
    $deliveryBoyId = $_POST['deliverBoyEdit'];
    $status_message = isset($_POST['messageedit']) ? $_POST['messageedit'] : '';

    // Fetch the current order status
    $sql_fetch = "SELECT order_status FROM orders WHERE order_id = '$orderId'";
    $result_fetch = mysqli_query($conn, $sql_fetch);

    if ($result_fetch && mysqli_num_rows($result_fetch) > 0) {
        $row = mysqli_fetch_assoc($result_fetch);
        $order_status = $row['order_status'];

        // Determine the new parcel_type based on the current order status
        if ($order_status == 'Booked') {
            $parcel_type = 'pickup';
        } elseif ($order_status == 'Picked up') {
            $parcel_type = 'delivery';
        } else {
            $parcel_type = '';
        }

        // Update the order with the new parcel_type, assign_to, and status_message
        $sql_update = "UPDATE orders SET assign_to = '$deliveryBoyId', status_message = '$status_message', parcel_type = '$parcel_type' WHERE order_id = '$orderId'";

        if (mysqli_query($conn, $sql_update)) {
            echo json_encode(array('status' => 'success', 'message' => 'Order assigned successfully'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error in assigning order details: ' . $conn->error));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Order not found'));
    }
    exit;
}

//----------------------------------------------------------------------------------//	
//                               DELETE COD                                         //
//----------------------------------------------------------------------------------//
// delete COD
if (isset($_POST['action']) && $_POST['action'] == 'deleteCODHistory') {
    $codOrderId = $_POST['id'];

    // Delete the record from the database
    $sql = "DELETE FROM delivery_history WHERE order_id = '$codOrderId'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'COD deleted successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting COD data: ' . $conn->error));
    }
    exit;
}

//----------------------------------------------------------------------------------//	
//                               CHANGE ORDER STATUS                                  //
//----------------------------------------------------------------------------------//
if (isset($_POST['action']) && $_POST['action'] == 'changeOrderStatus') {
    $orderId = $_POST['orderIdedit2'];
    $orderStatus = $_POST['orderStatus2'];
    $status_message = isset($_POST['messageedit']) ? $_POST['messageedit'] : '';

    if ($orderStatus == 'Item Picked Up') {
        $sql = "UPDATE orders SET order_status = '$orderStatus', status_message = '$status_message', parcel_type = 'delivery' WHERE order_id = '$orderId'";
    } elseif ($orderStatus == 'Delivered' || $orderStatus == 'Returned') {
        $sql = "UPDATE orders SET order_status = '$orderStatus', status_message = '$status_message', parcel_type = '' WHERE order_id = '$orderId'";
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
//                               FILTER SYSTEM                                      //
//----------------------------------------------------------------------------------//
if (isset($_POST['action']) && $_POST['action'] == 'filterProduct') {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $seller = $_POST['seller'];
    $orderStatus = $_POST['orderStatus'];

    $sql = "SELECT orders.*, delivery.name AS delivery_boy_name, seller.fullName AS seller_name FROM orders LEFT JOIN delivery ON orders.assign_to = delivery.id LEFT JOIN seller ON orders.seller_id = seller.id WHERE 1=1";

    if (!empty($startDate)) {
        $sql .= " AND DATE(orders.created_at) >= '$startDate'";
    }
    if (!empty($endDate)) {
        $sql .= " AND DATE(orders.created_at) <= '$endDate'";
    }
    if (!empty($seller)) {
        $sql .= " AND orders.seller_id = '$seller'";
    }
    if (!empty($orderStatus)) {
        $sql .= " AND orders.order_status = '$orderStatus'";
    }

    $result = mysqli_query($conn, $sql);
    $index = 1;

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $order_status = $row['order_status'];
            $button_class = '';

            if ($order_status == 'Delivered') {
                $button_class = 'btn-success';
            } elseif ($order_status == 'Booked') {
                $button_class = 'btn-primary';
            } else {
                $button_class = 'btn-warning';
            }

            $price = isset($row['price']) ? number_format($row['price'], 2) : 'N/A';

            echo "<tr>
        <td>" . $index . "</td>
        <td>" . $row['order_id'] . "</td>
        <td><input type='checkbox' class='order-checkbox' value='" . $row['order_id'] . "'></td>
        <td><a href='invoice.php?ordId=" . $row['order_id'] . "'>Invoice</a></td>
        <td><a href='label.php?ordId=" . $row['order_id'] . "'>label</a></td>
        <td>" . ($row['seller_id'] == 0 ? 'customer' : $row['seller_name']) . "</td>
        <td><b>Name:</b> " . $row['sender_name'] . " <br><br><b>Email:</b> " . $row['sender_email'] . " <br><br><b>Number:</b> " . $row['sender_number'] . "<br><br><b>Address:</b> " . $row['sender_address'] . " </td>
        <td><b>Name:</b> " . $row['receiver_name'] . " <br><br><b>Email:</b> " . $row['receiver_email'] . " <br><br><b>Number:</b> " . $row['receiver_number'] . "<br><br><b>Address:</b> " . $row['receiver_address'] . " </td>
        <td><b>Pincode:</b><br>" . $row['sender_pincode'] . "</td>
        <td><b>Pincode:</b><br>" . $row['receiver_pincode'] . "</td>
        <td>" . $row['service_type'] . "</td>
        <td>" . $row['service_title'] . "</td>
        <td><button type='button' class='btn btn-block btn-sm " . ($row['insurance'] ? 'btn-success' : 'btn-danger') . "'>" . ($row['insurance'] ? 'Yes' : 'No') . "</button></td>
        <td>" . (isset($row['price']) ? number_format($row['price'], 2) : 'N/A') . "</td>
        <td>" . $row['payment_mode'] . "</td>
        <td><button type='button' class='btn btn-block " . ($row['payment_status'] ? 'btn-success' : 'btn-danger') . "'>" . ($row['payment_status'] ? 'Paid' : 'Unpaid') . "</button></td>
        <td><button type='button' class='btn btn-block " . $button_class . " order_status' data-toggle='modal' data-target='#modal-order_status' data-orderid=" . $row['order_id'] . ">" . $row['order_status'] . "</button></td>
        <td>
            <button type='button' class='btn btn-block btn-success assign' data-toggle='modal' data-target='#modal-default' data-orderid=" . $row['order_id'] . "> " . (isset($row['assign_to']) ? 'Reassign' : 'Assign') . "</button>
            <div class='badge bg-danger'>" . (isset($row['assign_to']) ? $row['delivery_boy_name'] : '') . "</div>
        </td>
        <td style='width: 300px;'>" . $row['created_at'] . "</td>
        <td>
            <span class='badge bg-danger'><a href='#'><i class='fas fa-trash'></i></a></span>
        </td>
      </tr>";

            $index++;
        }
    } else {
        echo "<tr><td colspan='20'>No records found</td></tr>";
    }
    exit;
}




//----------------------------------------------------------------------------------//	
//                               PROFILE SETTINGS                                   //
//----------------------------------------------------------------------------------//
if (isset($_POST['action']) && $_POST['action'] == 'updateAdmin') {
    $adminName = $_POST['adminName'];
    $adminEmail = $_POST['adminEmail'];
    $adminId = $_POST['adminId'];
    $adminMobile = $_POST['adminMobile'];

    // Corrected SQL query
    $sql = "UPDATE admin SET name = '$adminName', email = '$adminEmail', mobile = '$adminMobile' WHERE id = '$adminId'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Admin profile updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating admin profile: ' . mysqli_error($conn)));
    }

    mysqli_close($conn);
    exit;
}


if (isset($_POST['action']) && $_POST['action'] == 'changePassword') {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $adminId = $_POST['adminId'];

    // Fetch the current password from the database
    $sql = "SELECT password FROM admin WHERE id = '$adminId'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $fetchPassword = $row['password'];

    if ($oldPassword == $fetchPassword) {
        // Update the password
        $updateSql = "UPDATE admin SET password = '$newPassword' WHERE id = '$adminId'";

        if (mysqli_query($conn, $updateSql)) {
            echo json_encode(array('status' => 'success', 'message' => 'Password changed successfully'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error updating password: ' . mysqli_error($conn)));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Old password is incorrect'));
    }

    mysqli_close($conn);
    exit;
}









//----------------------------------------------------------------------------------//	
//                               INQUIRY SECTION                                   //
//----------------------------------------------------------------------------------//

// add Inquiry
if (isset($_POST['action']) && $_POST['action'] == 'addInquiry') {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];
    $fullAddress = $_POST['fullAddress'];
    $itemsCount = $_POST['itemsCount'];
    $panNo = $_POST['panNo'];
    $panImage = $_FILES['panImage'];
    $contactMessage = $_POST['contactMessage'];

    $panImagePath = '';
    if (isset($_FILES['panImage']) && $_FILES['panImage']['error'] == 0) {
        $targetDir = "uploads/panImages/";
        $originalFileName = basename($_FILES['panImage']['name']);
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '_' . time() . '.' . $fileExtension;
        $targetFile = $targetDir . $uniqueFileName;

        if (move_uploaded_file($_FILES['panImage']['tmp_name'], $targetFile)) {
            $panImagePath = $targetFile;
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'File upload failed'));
            exit;
        }
    }

    $sql = "INSERT INTO contactus (fullName, email, phone, category, fullAddress, itemsCount, panNo, image, message) VALUES ('$fullName','$email','$phone','$category','$fullAddress','$itemsCount','$panNo','$panImagePath','$contactMessage')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Message sent successfully! We will contact you soon'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Message not send. Please try again : ' . $conn->error));
    }
    exit;
}

// delete Inquiry
if (isset($_POST['action']) && $_POST['action'] == 'deleteInquiry') {
    $id = $_POST['id'];

    // Fetch the image path
    $fetchImg = "SELECT image FROM contactus WHERE id = $id";
    $result = mysqli_query($conn, $fetchImg);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imagePath = $row['image'];

        // Delete the image file from the file system
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete the record from the database
    $sql = "DELETE FROM contactus WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Contact data deleted successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting contact data: ' . $conn->error));
    }
    exit;
}
