<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_email'])) {
    header('Location: index.php');
}

// Include the TCPDF library
require_once __DIR__ . '/tcpdf/tcpdf.php';
include("../config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderIds = $_POST['orderIds'];

    // Create a directory to store the labels
    $dir = __DIR__ . '/labels_' . time();
    if (!mkdir($dir) && !is_dir($dir)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
    }

    // Generate labels for the selected orders
    foreach ($orderIds as $orderId) {
        $sql = "SELECT
          o.id AS order_id, o.seller_id, o.sender_name, o.sender_number, o.sender_email, o.sender_address, o.sender_pincode, o.receiver_name, o.receiver_number, o.receiver_email, o.receiver_address, o.receiver_pincode, o.service_type, o.service_title, o.insurance, o.price, o.payment_mode, o.payment_status, o.order_status, o.status_message, o.assign_to, o.parcel_type, o.created_at, o.updated_at,
          s.fullName AS seller_name, s.email AS seller_email, s.phone AS seller_phone, s.fullAddress AS seller_address, s.panNo AS seller_panNo, s.seller_logo
        FROM orders o
        LEFT JOIN seller s ON o.seller_id = s.id
        WHERE o.order_id = '$orderId'";
        $result = mysqli_query($conn, $sql);
        $order = mysqli_fetch_assoc($result);

        // Create a new PDF document
        $pdf = new TCPDF();

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('PDF Title');
        $pdf->SetSubject('PDF Subject');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add label content to the PDF
        $html = '
        <div style="width: 500px; height: 500px; font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif; border: 2px solid #000; padding: 10px; background-color: #fff;">
            <table style="width: 100%; height: 100%; border-collapse: collapse; font-size: 16px;" border="2">
                <tr>
                    <td colspan="2" style="font-weight: bold; color: green; font-size: 16px;"><img src="dist/img/logo.jpg" alt="" height="100px"></td>
                    <td rowspan="2" style="text-align: center;">
                        <div id="qrcode" style="display: flex; align-items: center; justify-content: center;"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-left: 10px;"><strong>Tracking ID:</strong> ' . $order['order_id'] . '</td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-left: 10px;">
                        <strong>Receiver:</strong> ' . $order['receiver_name'] . ', ' . $order['receiver_number'] . ' <br>
                        ' . $order['receiver_name'] . ' <br>
                        <strong>Address:</strong>' . $order['receiver_address'] . ' <br>
                        <strong>PIN:</strong> ' . $order['receiver_pincode'] . '
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-left: 10px;">
                        <strong>Sender:</strong> ' . $order['sender_name'] . ', ' . $order['sender_number'] . '<br>
                        ' . $order['sender_name'] . ' <br>
                        <strong>Address:</strong> ' . $order['sender_address'] . ' <br>
                        <strong>PIN:</strong> ' . $order['receiver_pincode'] . '
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px;">
                            <img src="' . $order['seller_logo'] . '" alt="" height="50px">
                            <p><strong>Date:</strong> ' . strtolower((new DateTime($order['created_at']))->format('d-M-Y')) . '</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center; font-weight: bold;">' . $order['service_type'] . '</td>
                </tr>
                <tr>
                    <td colspan="3" style="font-size: 10px; padding-left: 10px;">
                        <strong>Terms & Conditions:</strong><br>
                        I/We declare that this consignment does not contain personal mail, cash, jewellery, contraband, illegal drugs, any prohibited items, and commodities which can cause safety hazards while transporting.
                    </td>
                </tr>
            </table>
        </div>';

        // Add HTML content to the PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Add QR code to the PDF
        $style = array(
            'border' => 0,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );
        $pdf->write2DBarcode('https://delhiparcel.com/track.php?ordId=' . $order['order_id'], 'QRCODE,H', 145, 7, 50, 50, $style, 'N');

        // Save the label content to a file
        $filePath = $dir . '/label_' . $orderId . '.pdf';
        $pdf->Output($filePath, 'F');
    }

    // Create a ZIP file containing all the labels
    $zipFileName = $dir . '.zip';
    $zip = new ZipArchive();
    if ($zip->open($zipFileName, ZipArchive::CREATE) !== TRUE) {
        exit("cannot open <$zipFileName>\n");
    }
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file) {
        if ($file->isFile()) {
            $zip->addFile($file->getRealPath(), $file->getFilename());
        }
    }
    $zip->close();

    // Return the ZIP file path
    echo $zipFileName;
}
