<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_email'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Label</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .label {
            width: 500px;
            height: 500px;
            border: 2px solid #000;
            padding: 10px;
            background-color: #fff;
        }

        table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        th,
        td {
            border: 2px solid #000;
            padding: 5px;
        }

        .header {
            font-weight: bold;
            color: green;
            font-size: 16px;
        }

        .qr-code {
            text-align: center;
        }

        #qrcode {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bold {
            font-weight: bold;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .terms {
            font-size: 10px;
        }

        #print_btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
        }

        #print_btn:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #print_btn:active {
            background-color: #004085;
            box-shadow: inset 0 3px 6px rgba(0, 0, 0, 0.2);
        }

        #print_btn i {
            margin-right: 8px;
        }

        .btn-primary {
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <?php
    include("../config.php");
    if (!isset($_GET['ordId'])) {
        header("Location: all_orders.php");
    }
    $id = $_GET['ordId'];
    $sql = "SELECT o.*, s.seller_logo FROM orders o JOIN sellers s ON o.seller_id = s.id WHERE o.order_id = '$id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    // var_dump($row);
    ?>
    <div>
        <div id="printableArea">
            <div class="label">
                <table>
                    <tr>
                        <td colspan="2" class="header"><img src="../../assets/images/logo.png" alt="" height="100px"></td>
                        <td rowspan="2" class="qr-code">
                            <div id="qrcode"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Tracking ID:</strong> <?php echo $row['order_id'] ?></td>
                        <input type="text" value="<?php echo $row['order_id'] ?>" id="ord_id" hidden>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>Receiver:</strong> <?php echo $row['receiver_name'] ?>, <?php echo $row['receiver_number'] ?> <br>
                            <?php echo $row['receiver_name'] ?> <br>
                            <strong>Address:</strong><?php echo $row['receiver_address'] ?> <br>
                            <strong>PIN:</strong> <?php echo $row['receiver_pincode'] ?>
                        </td>
                        <td class="right">
                        <img src="<?php echo $row['seller_logo']?>" alt="" height="70px">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>Sender:</strong> <?php echo $row['sender_name'] ?>, <?php echo $row['sender_number'] ?><br>
                            <?php echo $row['sender_name'] ?> <br>
                            <strong>Address:</strong> <?php echo $row['sender_address'] ?> <br>
                            <strong>PIN:</strong> <?php echo $row['receiver_pincode'] ?>
                        </td>
                        <td class="right">
                            <strong>Date:</strong> <?php echo strtolower((new DateTime($row['created_at']))->format('d-M-Y')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="center bold"><?php echo $row['service_type'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="terms">
                            <strong>Terms & Conditions:</strong><br>
                            I/We declare that this consignment does not contain personal mail, cash, jewellery, contraband, illegal drugs, any prohibited items, and commodities which can cause safety hazards while transporting.
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <button type="button" class="btn btn-primary" onclick="printDiv('printableArea')" id="print_btn">
                <i class="fa fa-print noPrint"></i> Print
            </button>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        // Generate QR Code
        var ordderId = document.querySelector('#ord_id').value;
        new QRCode(document.getElementById("qrcode"), {
            text: `https://delhiparcel.com/track.php?ordId=${ordderId}`,
            width: 150,
            height: 150
        });
    </script>
    <script>
        function printDiv(divName) {

            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>
</body>

</html>