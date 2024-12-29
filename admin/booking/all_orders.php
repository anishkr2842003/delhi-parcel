<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['booking_email'])) {
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | All Order List</title>

  <?php include("inc/links.php") ?>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include("inc/topbar.php") ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include("inc/sidebar.php") ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>All Order</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">All Order</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- <div class="card-header">
                  <h3 class="card-title">List of all products</h3>
                </div> -->
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr No.</th>
                        <th>Order&nbsp;id</th>
                        <th>Invoice</th>
                        <th>Label</th>
                        <th>Seller</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Pickup&nbsp;Pincode</th>
                        <th>Delivery&nbsp;Pincode</th>
                        <th>Service</th>
                        <th>Weight&nbsp;/&nbsp;Distance</th>
                        <th>Insurance</th>
                        <th>Price</th>
                        <th>Payment&nbsp;Mode</th>
                        <th>Payment&nbsp;Status</th>
                        <th>Order&nbsp;Status</th>
                        <th>Assign&nbsp;to</th>
                        <th>Order&nbsp;Date</th>
                        <!-- <th>Action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include("../config.php");
                      $seller_id = $_SESSION['booking_id'];
                      $sql = "SELECT orders.*, delivery.name AS delivery_boy_name, seller.fullName AS seller_name FROM orders LEFT JOIN delivery ON orders.assign_to = delivery.id LEFT JOIN seller ON orders.seller_id = seller.id WHERE orders.seller_id = 3 ";
                      $result = mysqli_query($conn, $sql);
                      $index = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                        // var_dump($row);
                        $order_status = $row['order_status'];
                        $button_class = '';

                        if ($order_status == 'Delivered') {
                          $button_class = 'btn-success'; // Green background
                        } elseif ($order_status == 'Booked') {
                          $button_class = 'btn-primary'; // Blue background
                        } else {
                          $button_class = 'btn-warning'; // Yellow background
                        }
                      ?>
                        <tr>
                          <td><?php echo $index; ?></td>
                          <td><?php echo $row['order_id']; ?></td>
                          <td><a href="invoice.php?ordId=<?php echo $row['order_id']; ?>">Invoice</a></td>
                          <td><a href="label.php?ordId=<?php echo $row['order_id']; ?>">label</a></td>
                          <td><?php echo $row['seller_id'] == 0 ? 'customer' : $row['seller_name']; ?></td>
                          <td><b>Name:</b> <?php echo $row['sender_name']; ?> <br><br><b>Email:</b> <?php echo $row['sender_email']; ?> <br><br><b>Number:</b> <?php echo $row['sender_number']; ?><br><br><b>Address:</b> <?php echo $row['sender_address']; ?> </td>
                          <td><b>Name:</b> <?php echo $row['receiver_name']; ?> <br><br><b>Email:</b> <?php echo $row['receiver_email']; ?> <br><br><b>Number:</b> <?php echo $row['receiver_number']; ?><br><br><b>Address:</b> <?php echo $row['receiver_address']; ?> </td>
                          <td><b>Pincode:</b><br><?php echo $row['sender_pincode']; ?></td>
                          <td><b>Pincode:</b><br><?php echo $row['receiver_pincode']; ?></td>
                          <td><?php echo $row['service_type']; ?></td>
                          <td><?php echo $row['service_title']; ?></td>
                          <td><button type="button" class="btn btn-block btn-sm <?php echo $row['insurance'] ? 'btn-success' : 'btn-danger' ?>"><?php echo $row['insurance'] ? 'Yes' : 'No' ?></button></td>
                          <td><?php echo $row['price']; ?></td>
                          <td><?php echo $row['payment_mode']; ?></td>
                          <td><button type="button" class="btn btn-block <?php echo $row['payment_status'] ? 'btn-success' : 'btn-danger' ?>"><?php echo $row['payment_status'] ? 'Paid' : 'Unpaid' ?></button></td>
                          <td><button type="button" class="btn btn-block <?php echo $button_class; ?> order_status"><?php echo $row['order_status'] ?></button></td>
                          <td>
                            <!-- <button type="button" class="btn btn-block btn-success assign"> <?php echo isset($row['assign_to']) ? 'Reassign' : 'Assign' ?></button> -->
                            <div class="badge bg-danger"><?php echo isset($row['assign_to']) ? $row['delivery_boy_name'] : 'No Assigned' ?></div>
                          </td>
                          <td style="width: 300px;"><?php echo $row['created_at'] ?></td>
                        </tr>
                      <?php
                        $index++;
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <?php include("inc/footer.php")   ?>
  </div>
  <!-- ./wrapper -->

  <!-- Assign modal -->
  <!-- modal -->
  <!-- <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Assign to</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="assignForm">
            <div class="card-body">
              <div class="form-group">
                <label for="orderIdedit">Order id</label>
                <input type="text" class="form-control" id="orderIdedit" name="orderIdedit" placeholder="Enter Message" readonly>
              </div>
              <div class="form-group">
                <label for="deliverBoyEdit">Select Delivery Boy</label>
                <select class="custom-select rounded-0" id="deliverBoyEdit" name="deliverBoyEdit">
                  <option selected disabled> Chooese delivery boy</option>
                  <?php
                  $sql1 = "SELECT * FROM delivery WHERE status = 1";
                  $res1 = mysqli_query($conn, $sql1);
                  while ($row = mysqli_fetch_assoc($res1)) {
                  ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="messageedit">Message</label>
                <input type="text" class="form-control" id="messageedit" name="messageedit" placeholder="Enter Message">
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Assign</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> -->

  <!-- order status modal -->
  <!-- modal -->
  <!-- <div class="modal fade" id="modal-order_status">
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
                <label for="orderIdedit2">Order id</label>
                <input type="text" class="form-control" id="orderIdedit2" name="orderIdedit2" placeholder="Enter Message" readonly>
              </div>
              <div class="form-group">
                <label for="orderStatus">Select Order Status</label>
                <select class="custom-select rounded-0" id="orderStatus" name="orderStatus">
                  <option selected disabled> Chooese order status</option>
                  <option value="Item Picked Up">Item Picked Up</option>
                  <option value="In Transist">In Transist</option>
                  <option value="Arrived at Destination">Arrived at Destination</option>
                  <option value="Out of Delivery">Out of Delivery</option>
                  <option value="Delivered">Delivered</option>
                  <option value="Not Delivered">Not Delivered</option>
                  <option value="Returing to Origin">Returing to Origin</option>
                  <option value="Out of Delivery to Origin">Out of Delivery to Origin</option>
                  <option value="Returned">Returned</option>
                </select>
              </div>
              <div class="form-group">
                <label for="messageedit">Message</label>
                <input type="text" class="form-control" id="messageedit" name="messageedit" placeholder="Enter Message">
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update Order Status</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> -->

  </div>

  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": false,
        "scrollX": true,
        "lengthChange": false,
        "autoWidth": false,
        // "buttons": ["excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  <script>
    $(document).ready(function() {

      // Handle delete button click
      // $('.delete-job').on('click', function(e) {
      //   e.preventDefault();
      //   console.log('click');
      //   var jobId = $(this).data('id');

      //   if (confirm("Are you sure you want to delete this job?")) {
      //     $.ajax({
      //       url: 'api/delete_job.php?id=' + jobId,
      //       type: 'GET',
      //       success: function(response) {
      //         if (response.status === "success") {
      //           Toast('success', response.message);
      //           location.reload();
      //         } else {
      //           Toast('error', response.message);
      //         }
      //       },
      //       error: function(xhr, status, error) {
      //         Toast('error', 'An error occurred');
      //       }
      //     });
      //   }
      // });

      $('.order_status').on('click', function() {
        const orderId = $(this).data('orderid');
        console.log(orderId)
        // openEditModal(jobId);
        $('#orderIdedit2').val(orderId);
        $('#modal-order_status').modal('show');
      });

      $('.assign').on('click', function() {
        const orderId = $(this).data('orderid');
        // openEditModal(jobId);
        $('#orderIdedit').val(orderId);
        $('#modal-default').modal('show');
      });

      // update job
      $('#assignForm').on('submit', function(event) {
        event.preventDefault();
        // console.log('hello')

        if (!($('#orderIdedit').val())) {
          Toast('error', 'Id is required');
          return;
        }

        if (!($('#deliverBoyEdit').val())) {
          Toast('error', 'Delivery Boy is required');
          return;
        }

        // if(!($('#messageedit').val())){
        //   Toast('error', 'Message is required');
        //   return;
        // }

        const formData = new FormData(this);
        formData.append('action', 'assignto')

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

      // update job
      $('#statusForm').on('submit', function(event) {
        event.preventDefault();
        // console.log('hello')

        if (!($('#orderIdedit2').val())) {
          Toast('error', 'Id is required');
          return;
        }

        if (!($('#orderStatus').val())) {
          Toast('error', 'Order Status is required');
          return;
        }

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
            console.log(response)
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

      // $('.switch input[type="checkbox"]').on('change', function() {
      //   var jobId = $(this).data('id');
      //   var status = $(this).is(':checked') ? 1 : 0;

      //   // console.log(jobId);
      //   // console.log(status);
      //   $.ajax({
      //     url: 'api/update_status.php',
      //     type: 'POST',
      //     data: {
      //       jobid: jobId,
      //       status: status
      //     },
      //     success: function(response) {
      //       console.log(response)
      //       if (response.status === "success") {
      //         Toast('success', response.message);
      //       } else {
      //         Toast('error', response.message);
      //       }
      //     },
      //     error: function(error) {
      //       // console.log(error)
      //       Toast('error', 'An error occurred');
      //     }
      //   });
      // });


      // initTable();
    });
  </script>

</body>

</html>