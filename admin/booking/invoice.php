<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Tracking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .invoice-container {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header .logo {
            text-align: center;
            flex: 1;
        }

        .header h1 {
            /* color: green; */
            font-size: 24px;
            margin: 0;
        }

        .header p {
            margin: 5px 0;
        }

        .info {
            text-align: right;
            flex: 1;
        }

        .copy {
            font-weight: bold;
            text-align: right;
            width: 100%;
            margin-top: 10px;
        }

        .details {
            margin-top: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .order-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* margin-bottom: 20px; */
        }

        .sender-receiver {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .sender,
        .receiver,
        .parcel {
            width: 100%;
            margin-bottom: 10px;
        }

        @media (min-width: 600px) {

            .sender,
            .receiver,
            .parcel {
                width: 30%;
            }
        }

        @media (max-width: 600px) {

            .sender,
            .receiver {
                width: 50%;
            }

            .parcel {
                width: 100%;
            }
        }

        .amounts {
            margin-top: 20px;
        }

        .summary {
            text-align: right;
        }

        .summary p {
            margin: 5px 0;
        }

        .amount-in-words {
            margin-top: 10px;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            border-top: 2px solid #000;
            padding-top: 10px;
        }

        .bank-details {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .terms {
            margin-bottom: 10px;
        }

        .signature {
            text-align: right;
        }

        .signature p {
            margin: 5px 0;
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
    <?php include("inc/links.php") ?>
    <?php
    include("../config.php");
    if (!isset($_GET['ordId'])) {
        header("Location: all_orders.php");
    }
    $id = $_GET['ordId'];
    $sql = "SELECT * FROM orders WHERE order_id = '$id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $grand_total = $row['price'];

    function numberToWords($number)
    {
        $units = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
        $teens = ['Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
        $tens = ['Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

        if ($number < 10) return $units[$number];
        if ($number < 20) return $teens[$number - 11];
        if ($number < 100) return $tens[intdiv($number, 10) - 1] . ($number % 10 ? ' ' . $units[$number % 10] : '');
        if ($number < 1000) return $units[intdiv($number, 100)] . ' Hundred' . ($number % 100 ? ' and ' . numberToWords($number % 100) : '');
        if ($number < 1000000) return numberToWords(intdiv($number, 1000)) . ' Thousand' . ($number % 1000 ? ' ' . numberToWords($number % 1000) : '');
        return numberToWords(intdiv($number, 1000000)) . ' Million' . ($number % 1000000 ? ' ' . numberToWords($number % 1000000) : '');
    }

    // Calculate the GST amount (18% of the subtotal)
    $gst_rate = 0.18;
    $sub_total = $grand_total / (1 + $gst_rate);
    $gst_amount = $sub_total * $gst_rate;
    // var_dump($row);
    ?>
    <div class="invoice-container">
        <div id="printableArea">
            <header class="header">
                <div class="logo">
                    <img src="../../assets/images/logo.png" alt="" height="100px">

                </div>
                <!-- <div class="info">
                    <h1>DELHI PARCEL</h1>
                    <p>Near Police Station Bhajanpura, Delhi, 110053</p>
                    <p><b>PAN:</b> AAUFD9215E | <b>GSTIN:</b> 07AAUFD9215E1Z8</p>
                    <p><b>Tel:</b> 7678149050 | <b>email:</b> info@delhiparcel.com</p>
                </div>
                <div class="copy">Original Copy</div> -->
            </header>

            <section class="details">
                <!-- <div class="order-info">
                    <p><strong>Order No:</strong> <?php echo $row['order_id'] ?></p>
                    <p><strong>Invoice Date:</strong> <?php echo strtolower(date('d-M-Y')); ?></p>
                    <p><strong>Order Date:</strong> <?php echo strtolower((new DateTime($row['created_at']))->format('d-M-Y')); ?></p>
                </div> -->
                <div class="sender-receiver">
                    <div class="parcel">
                        <p><strong>Parcel Details:</strong></p>
                        <p>Order No: <?php echo $row['order_id'] ?></p>
                        <p>Order Status: <?php echo $row['order_status']  ?></p>
                        <p>Order Date: <?php echo strtolower((new DateTime($row['created_at']))->format('d-M-Y')); ?></p>
                    </div>
                    <div class="sender">
                        <p><strong>Sender Details:</strong></p>
                        <p><?php echo $row['sender_name'] ?></p>
                        <p><?php echo $row['sender_number'] ?></p>
                        <p><?php echo $row['sender_address'] ?></p>
                        <!-- <p>GSTIN / UIN: 07AAACY5881C1Z9</p> -->
                    </div>
                    <div class="receiver">
                        <p><strong>Receiver Details:</strong></p>
                        <p><?php echo $row['receiver_name'] ?></p>
                        <p><?php echo $row['receiver_number'] ?></p>
                        <p><?php echo $row['receiver_address'] ?></p>
                    </div>
                </div>
            </section>

            <section class="amounts">
                <div class="summary">
                    <!-- <p><strong>Sub Total:</strong> ₹ <?php echo number_format($sub_total, 2); ?></p>
                    <p><strong>Add: GST(18%):</strong> ₹ <?php echo number_format($gst_amount, 2); ?></p> -->
                    <p><strong>Grand Total:</strong> ₹ <?php echo number_format($grand_total, 2); ?></p>
                    <p><strong>Payment Mode:</strong> <?php echo $row['payment_mode'] ?></p>
                </div>
                <!-- <p class="amount-in-words">Amount In Words: <?php echo numberToWords(intval($grand_total)); ?> Rupees Only</p> -->
            </section>

            <!-- <section class="footer">
                <div class="bank-details">
                <p><strong>Bank Details:</strong> HDFC Bank | A/c No.: 50200081058670 | IFSC Code: HDFC0001981</p>
            </div>
                <div class="terms">
                    <p><b>Terms & Conditions</b></p>
                    <p>I/We declare that this consignment does not contain personal mail, cash, jewellery, contraband, illegal drugs, any prohibited items and commodities which can cause safety hazards while transporting.</p>
                </div>
                <div class="signature">
                    <p>Receiver's Signature:</p>
                    <p>This is a computer generated invoice no signature required</p>
                    <p><strong>Authorised Signatory</strong></p>
                </div>
            </section> -->
        </div>
        <div>
            <!-- <button type="button" class="btn btn-primary" onclick="printDiv('printableArea')" id="print_btn"><i class="fa fa-print noPrint"></i> Print</button> -->
            <button type="button" class="btn btn-primary order_status" data-toggle="modal" data-target="#modal-default" data-orderid=<?php echo $row['order_id'] ?>>
                <i class="fas fa-marker"></i></i> Update Status
            </button>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Order Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="statusForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="orderIdedit">Order id</label>
                                <input type="text" class="form-control" id="orderIdedit" name="orderIdedit" placeholder="Enter Message">
                            </div>
                            <div class="form-group">
                                <label for="orderStatus">Select Order Status</label>
                                <select class="custom-select rounded-0" id="orderStatus" name="orderStatus">
                                    <option selected disabled> Chooese order status</option>
                                    <option value="Item Picked Up">Item Picked Up</option>
                                    <option value="Returned">Returned</option>
                                    <option value="In Transist">In Transist</option>
                                    <option value="Arrived at Destination">Arrived at Destination</option>
                                    <option value="Out of Delivery">Out of Delivery</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Not Delivered">Not Delivered</option>
                                    <option value="Returing to Origin">Returing to Origin</option>
                                    <option value="Out of Delivery to Origin">Out of Delivery to Origin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="messageedit">Message</label>
                                <input type="text" class="form-control" id="messageedit" name="messageedit" placeholder="Enter Message">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Order Status</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <script>
        function printDiv(divName) {

            var printContents = document.getElementById(divName).innerHTML;

            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>

    <script>
        $(document).ready(function() {

            $('.order_status').on('click', function() {
                const orderId = $(this).data('orderid');

                $('#orderIdedit').val(orderId);
                $('#modal-default').modal('show');
            });

            // update job
            $('#statusForm').on('submit', function(event) {
                event.preventDefault();
                // console.log('hello')

                if (!($('#orderIdedit').val())) {
                    Toast('error', 'Id is required');
                    return;
                }

                if (!($('#orderStatus').val())) {
                    Toast('error', 'Order Status is required');
                    return;
                }

                // if(!($('#messageedit').val())){
                //   Toast('error', 'Message is required');
                //   return;
                // }

                const formData = new FormData(this);
                formData.append('action', 'changeOrderStatus')

                // formData.forEach((value, key) => {
                //   console.log(key, value);
                // });

                // Send the form data via AJAX
                $.ajax({
                    url: 'query.php',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(response) {
                        // console.log(response)
                        var res = JSON.parse(response);
                        if (res.status == 'success') {
                            Toast('success', res.message);
                            $('#modal-default').modal('hide');
                            location.reload();
                        } else {
                            Toast('error', res.message)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred while updating the job.');
                    }
                });
            });
        });
    </script>
</body>

</html>