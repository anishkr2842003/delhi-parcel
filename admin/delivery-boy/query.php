<?php

include("../config.php");


// add services
// if (isset($_POST['action']) && $_POST['action'] == 'addService') {
//     $servicesTitle = $_POST['servicesTitle'];
//     $servicesPrice = $_POST['servicesPrice'];
//     $service_type = $_POST['service_type'];

//     if ($service_type == "super_express") {
//         $sql = "INSERT INTO services (title, price, service_type) VALUES ('$servicesTitle', '$servicesPrice', 'Super-Express')";
//     } else if ($service_type == "express") {
//         $sql = "INSERT INTO services (title, price, service_type) VALUES ('$servicesTitle', '$servicesPrice', 'Express')";
//     } else {
//         $sql = "INSERT INTO services (title, price, service_type) VALUES ('$servicesTitle', '$servicesPrice', 'Standred')";
//     }

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Services added successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error adding services : ' . $conn->error));
//     }
//     exit;
// }


// update services
// if (isset($_POST['action']) && $_POST['action'] == 'updateService') {
//     $servicesId = $_POST['servicesId2'];
//     $servicesTitle = $_POST['servicesTitle2'];
//     $servicesPrice = $_POST['servicesPrice2'];
//     // $service_type = $_POST['service_type'];

//     $sql = "UPDATE services SET title = '$servicesTitle', price = '$servicesPrice' WHERE id = $servicesId";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Services updated successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error updating services : ' . $conn->error));
//     }
//     exit;
// }


// update services status
// if (isset($_POST['action']) && $_POST['action'] == 'updateServicesStatus') {
//     $id = $_POST['id'];
//     $status = $_POST['status'];

//     $sql = "UPDATE services SET status = $status WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Services updated successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error updating services : ' . $conn->error));
//     }
//     exit;
// }

// delete services
// if (isset($_POST['action']) && $_POST['action'] == 'deleteServices') {
//     $id = $_POST['id'];

//     $sql = "DELETE FROM services WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Services delete successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error deleting services : ' . $conn->error));
//     }
//     exit;
// }


// add pincodes
// if (isset($_POST['action']) && $_POST['action'] == 'addPincode') {
//     $pincode = $_POST['pincode'];

//     $fetchPincode = "SELECT pincode FROM pincodes WHERE pincode = $pincode";
//     $result = mysqli_query($conn, $fetchPincode);

//     if (mysqli_num_rows($result) > 0) {
//         echo json_encode(array('status' => 'error', 'message' => 'Pincode already exists'));
//         exit;
//     }

//     $sql = "INSERT INTO pincodes (pincode) VALUES ('$pincode')";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Pincode added successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error adding pincodes : ' . $conn->error));
//     }
//     exit;
// }


// update pincodes status
// if (isset($_POST['action']) && $_POST['action'] == 'updatePincodeStatus') {
//     $id = $_POST['id'];
//     $status = $_POST['status'];

//     $sql = "UPDATE pincodes SET status = $status WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Pincode updated successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error updating pincodes : ' . $conn->error));
//     }
//     exit;
// }

// delete pincodes
// if (isset($_POST['action']) && $_POST['action'] == 'deletePincodes') {
//     $id = $_POST['id'];

//     $sql = "DELETE FROM pincodes WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Pincode delete successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error deleting pincodes : ' . $conn->error));
//     }
//     exit;
// }


// add Reviews
// if (isset($_POST['action']) && $_POST['action'] == 'addReviews') {
//     $clientName = $_POST['clientName'];
//     $clientMessage = $_POST['clientMessage'];

//     $sql = "INSERT INTO reviews (name, message) VALUES ('$clientName', '$clientMessage')";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Review added successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error adding reviews : ' . $conn->error));
//     }
//     exit;
// }

// update review status
// if (isset($_POST['action']) && $_POST['action'] == 'updateReviewsStatus') {
//     $id = $_POST['id'];
//     $status = $_POST['status'];

//     $sql = "UPDATE reviews SET status = $status WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Review updated successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error updating reviews : ' . $conn->error));
//     }
//     exit;
// }

// delete reviews
// if (isset($_POST['action']) && $_POST['action'] == 'deleteReviews') {
//     $id = $_POST['id'];

//     $sql = "DELETE FROM reviews WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Review delete successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error deleting reviews : ' . $conn->error));
//     }
//     exit;
// }


// add Category
// if (isset($_POST['action']) && $_POST['action'] == 'addCategory') {
//     $categoryName = $_POST['categoryName'];

//     $sql = "INSERT INTO categories (name) VALUES ('$categoryName')";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Category added successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error adding category : ' . $conn->error));
//     }
//     exit;
// }

// update category status
// if (isset($_POST['action']) && $_POST['action'] == 'updateCategoryStatus') {
//     $id = $_POST['id'];
//     $status = $_POST['status'];

//     $sql = "UPDATE categories SET status = $status WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Category updated successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error updating category : ' . $conn->error));
//     }
//     exit;
// }

// delete category
// if (isset($_POST['action']) && $_POST['action'] == 'deleteCategory') {
//     $id = $_POST['id'];

//     $sql = "DELETE FROM categories WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Category delete successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error deleting category : ' . $conn->error));
//     }
//     exit;
// }



// add Seller
// if (isset($_POST['action']) && $_POST['action'] == 'addSeller') {
//     $fullName = $_POST['fullName'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $category = $_POST['category'];
//     $fullAddress = $_POST['fullAddress'];
//     $itemsCount = $_POST['itemsCount'];
//     $panNo = $_POST['panNo'];
//     $panImage = $_FILES['panImage'];
//     $pinCode = $_POST['pinCode'];

//     $panImagePath = '';
//     if (isset($_FILES['panImage']) && $_FILES['panImage']['error'] == 0) {
//         $targetDir = "uploads/panImages/";
//         $originalFileName = basename($_FILES['panImage']['name']);
//         $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//         $uniqueFileName = uniqid() . '_' . time() . '.' . $fileExtension;
//         $targetFile = $targetDir . $uniqueFileName;

//         if (move_uploaded_file($_FILES['panImage']['tmp_name'], $targetFile)) {
//             $panImagePath = $targetFile;
//         } else {
//             echo json_encode(array('status' => 'error', 'message' => 'File upload failed'));
//             exit;
//         }
//     }

//     $loginEmail = $email;
//     $nameParts = explode(' ', $fullName);
//     $loginPassword = $nameParts[0] . '@' . $pinCode;

//     $sql = "INSERT INTO seller (fullName, email, phone, category, fullAddress, itemsCount, panNo, image, pincode, login_email, login_password) VALUES ('$fullName','$email','$phone','$category','$fullAddress','$itemsCount','$panNo','$panImagePath','$pinCode','$loginEmail', '$loginPassword')";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Seller added successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error in adding seller : ' . $conn->error));
//     }
//     exit;
// }

// update seller status
// if (isset($_POST['action']) && $_POST['action'] == 'updateSellerStatus') {
//     $id = $_POST['id'];
//     $status = $_POST['status'];

//     $sql = "UPDATE seller SET status = $status WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Seller updated successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error updating seller : ' . $conn->error));
//     }
//     exit;
// }

// update seller login email and password
// if (isset($_POST['action']) && $_POST['action'] == 'updateSellerLogin') {
//     $loginId = $_POST['loginId'];
//     $loginEmail2 = $_POST['loginEmail2'];
//     $loginPassword2 = $_POST['loginPassword2'];
//     // $service_type = $_POST['service_type'];

//     $sql = "UPDATE seller SET login_email = '$loginEmail2', login_password = '$loginPassword2' WHERE id = $loginId";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Seller login details updated successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error updating seller login details : ' . $conn->error));
//     }
//     exit;
// }

// delete Seller
// if (isset($_POST['action']) && $_POST['action'] == 'deleteSeller') {
//     $id = $_POST['id'];

//     // Fetch the image path
//     $fetchImg = "SELECT image FROM seller WHERE id = $id";
//     $result = mysqli_query($conn, $fetchImg);

//     if ($result && mysqli_num_rows($result) > 0) {
//         $row = mysqli_fetch_assoc($result);
//         $imagePath = $row['image'];

//         // Delete the image file from the file system
//         if (file_exists($imagePath)) {
//             unlink($imagePath);
//         }
//     }

//     // Delete the record from the database
//     $sql = "DELETE FROM seller WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Seller deleted successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error deleting seller: ' . $conn->error));
//     }
//     exit;
// }


// add Delivery
// if (isset($_POST['action']) && $_POST['action'] == 'adddelivery') {
//     $fullName = $_POST['fullName'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $fullAddress = $_POST['fullAddress'];
//     $pinCode = $_POST['pinCode'];
//     $password = $_POST['password'];

//     $sql = "INSERT INTO delivery (name, email, mobile, address, pincode, password) VALUES ('$fullName','$email','$phone', '$fullAddress', '$pinCode','$password')";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Delivery added successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error in adding delivery : ' . $conn->error));
//     }
//     exit;
// }

// update delivery status
// if (isset($_POST['action']) && $_POST['action'] == 'updateDeliveryStatus') {
//     $id = $_POST['id'];
//     $status = $_POST['status'];

//     $sql = "UPDATE delivery SET status = $status WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Delivery updated successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error updating delivery : ' . $conn->error));
//     }
//     exit;
// }

// update seller login email and password
// if (isset($_POST['action']) && $_POST['action'] == 'updateDelivery') {
//     $loginId = $_POST['loginId'];
//     $editName = $_POST['editName'];
//     $loginEmail2 = $_POST['loginEmail2'];
//     $editMobile = $_POST['editMobile'];
//     $editAddress = $_POST['editAddress'];
//     $editPincode = $_POST['editPincode'];
//     $loginPassword2 = $_POST['loginPassword2'];

//     $sql = "UPDATE delivery SET name = '$editName', email = '$loginEmail2', mobile = '$editMobile', address = '$editAddress', pincode = '$editPincode', password = '$loginPassword2' WHERE id = $loginId";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Delivery updated successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error updating delivery details : ' . $conn->error));
//     }
//     exit;
// }

// delete Delivery Boy
// if (isset($_POST['action']) && $_POST['action'] == 'deleteDelivery') {
//     $id = $_POST['id'];

//     // Delete the record from the database
//     $sql = "DELETE FROM delivery WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Delivery deleted successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error deleting delivery: ' . $conn->error));
//     }
//     exit;
// }

// if (isset($_POST['action']) && $_POST['action'] == 'changeOrderStatus') {
//     $orderId = $_POST['orderIdedit'];   
//     $orderStatus = $_POST['orderStatus'];
//     $status_message = isset($_POST['messageedit']) ? $_POST['messageedit'] : '';

//     if($orderStatus == 'Item Picked Up'){
//         $sql = "UPDATE orders SET order_status = '$orderStatus', status_message = '$status_message', parcel_type = 'delivery' WHERE order_id = '$orderId'";
//     }elseif($orderStatus == 'Delivered' || $orderStatus == 'Returned'){
//         $sql = "UPDATE orders SET order_status = '$orderStatus', status_message = '$status_message', parcel_type = '' WHERE order_id = '$orderId'";
//     }else{
//         $sql = "UPDATE orders SET order_status = '$orderStatus', status_message = '$status_message', parcel_type = 'delivery' WHERE order_id = '$orderId'";
//     }

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Order status update successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error in updating order status : ' . $conn->error));
//     }
//     exit;
// }


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

// delete Inquiry
// if (isset($_POST['action']) && $_POST['action'] == 'deleteInquiry') {
//     $id = $_POST['id'];

//     // Fetch the image path
//     $fetchImg = "SELECT image FROM contactus WHERE id = $id";
//     $result = mysqli_query($conn, $fetchImg);

//     if ($result && mysqli_num_rows($result) > 0) {
//         $row = mysqli_fetch_assoc($result);
//         $imagePath = $row['image'];

//         // Delete the image file from the file system
//         if (file_exists($imagePath)) {
//             unlink($imagePath);
//         }
//     }

//     // Delete the record from the database
//     $sql = "DELETE FROM contactus WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Contact data deleted successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error deleting contact data: ' . $conn->error));
//     }
//     exit;
// }












// add Inquiry
// if (isset($_POST['action']) && $_POST['action'] == 'addInquiry') {
//     $fullName = $_POST['fullName'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $category = $_POST['category'];
//     $fullAddress = $_POST['fullAddress'];
//     $itemsCount = $_POST['itemsCount'];
//     $panNo = $_POST['panNo'];
//     $panImage = $_FILES['panImage'];
//     $contactMessage = $_POST['contactMessage'];

//     $panImagePath = '';
//     if (isset($_FILES['panImage']) && $_FILES['panImage']['error'] == 0) {
//         $targetDir = "uploads/panImages/";
//         $originalFileName = basename($_FILES['panImage']['name']);
//         $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
//         $uniqueFileName = uniqid() . '_' . time() . '.' . $fileExtension;
//         $targetFile = $targetDir . $uniqueFileName;

//         if (move_uploaded_file($_FILES['panImage']['tmp_name'], $targetFile)) {
//             $panImagePath = $targetFile;
//         } else {
//             echo json_encode(array('status' => 'error', 'message' => 'File upload failed'));
//             exit;
//         }
//     }

//     $sql = "INSERT INTO contactus (fullName, email, phone, category, fullAddress, itemsCount, panNo, image, message) VALUES ('$fullName','$email','$phone','$category','$fullAddress','$itemsCount','$panNo','$panImagePath','$contactMessage')";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Message sent successfully! We will contact you soon'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Message not send. Please try again : ' . $conn->error));
//     }
//     exit;
// }

// delete Inquiry
// if (isset($_POST['action']) && $_POST['action'] == 'deleteInquiry') {
//     $id = $_POST['id'];

//     // Fetch the image path
//     $fetchImg = "SELECT image FROM contactus WHERE id = $id";
//     $result = mysqli_query($conn, $fetchImg);

//     if ($result && mysqli_num_rows($result) > 0) {
//         $row = mysqli_fetch_assoc($result);
//         $imagePath = $row['image'];

//         // Delete the image file from the file system
//         if (file_exists($imagePath)) {
//             unlink($imagePath);
//         }
//     }

//     // Delete the record from the database
//     $sql = "DELETE FROM contactus WHERE id = $id";

//     if (mysqli_query($conn, $sql)) {
//         echo json_encode(array('status' => 'success', 'message' => 'Contact data deleted successfully'));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Error deleting contact data: ' . $conn->error));
//     }
//     exit;
// }
