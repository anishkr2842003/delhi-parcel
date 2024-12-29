<?php
include_once("admin/config.php");

if (isset($_POST['pincode'])) {
    $pincode = $_POST['pincode'];

    $sql = "SELECT * FROM pincodes WHERE pincode = '$pincode' && status = 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => 'found']);
    } else {
        echo json_encode(['status' => 'not_found']);
    }
}
exit;
?>
