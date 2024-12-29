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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Add Order</title>

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
              <h1>Add Order</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Add Order</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add new order here</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12 col-md-6">
                        <h3><b>Sender Details</b></h3>

                        <div class="form-group">
                          <label for="senderName">Sender Name</label>
                          <input type="text" class="form-control" id="senderName" placeholder="Enter Sender Name" name="senderName">
                        </div>

                        <div class="form-group">
                          <label for="senderContactNo">Sender Conatct no</label>
                          <input type="number" pattern="[6789][0-9]{9}" class="form-control" id="senderContactNo" placeholder="Enter Sender Conatct no" name="senderContactNo">
                        </div>

                        <div class="form-group">
                          <label for="senderEmail">Sender Email</label>
                          <input type="email" class="form-control" id="senderEmail" placeholder="Enter Sender Email" name="senderEmail">
                        </div>

                        <div class="form-group">
                          <label for="senderFullAddress">Sender Full Address</label>
                          <input type="text" class="form-control" id="senderFullAddress" placeholder="Enter Sender Full Address" name="senderFullAddress">
                        </div>

                        <div class="form-group">
                          <label for="senderPincode">Sender Pincode</label>
                          <input type="text" class="form-control" id="senderPincode" placeholder="Enter Sender Pincode" name="senderPincode">
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <h3><b>Receiver Details</b></h3>

                        <div class="form-group">
                          <label for="receiverName">Receiver Name</label>
                          <input type="text" class="form-control" id="receiverName" placeholder="Enter Receiver Name" name="receiverName">
                        </div>

                        <div class="form-group">
                          <label for="receiverContactNo">Receiver Conatct no</label>
                          <input type="text" pattern="[6789][0-9]{9}" class="form-control" id="receiverContactNo" placeholder="Enter Receiver Conatct no" name="receiverContactNo">
                        </div>

                        <div class="form-group">
                          <label for="receiverEmail">Receiver Email</label>
                          <input type="email" class="form-control" id="receiverEmail" placeholder="Enter Receiver Email" name="receiverEmail">
                        </div>

                        <div class="form-group">
                          <label for="receiverFullAddress">Receiver Full Address</label>
                          <input type="text" class="form-control" id="receiverFullAddress" placeholder="Enter Receiver Full Address" name="receiverFullAddress">
                        </div>

                        <div class="form-group">
                          <label for="receiverPincode">Receiver Pincode</label>
                          <input type="text" class="form-control" id="receiverPincode" placeholder="Enter Receiver Pincode" name="receiverPincode">
                        </div>
                      </div>




                    </div>
                    <div class="form-group">
                      <!-- <label for="lift">Lift</label> -->
                      <div class="d-flex">
                        <div class="custom-control custom-radio mr-3">
                          <input class="custom-control-input" type="radio" id="cashOnDelivery" name="paymentMode" value="cashOnDelivery">
                          <label for="cashOnDelivery" class="custom-control-label">Cash on Delivery</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="prepaidOrder" name="paymentMode" value="prepaidOrder">
                          <label for="prepaidOrder" class="custom-control-label">Prepaid Order</label>
                        </div>
                      </div>
                    </div>

                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" id="customCheckbox2" checked>
                      <label for="customCheckbox2" class="custom-control-label">Do you want to insurance your order?</label>
                    </div>

                    <p class="text-success">insurance charges 50 or 1 % which ever is higher</p>

                    <!-- <div class="form-group">
                      <label for="productname">Product Name</label>
                      <input type="text" class="form-control" id="productname" placeholder="Enter Product Name">
                    </div>
                    <div class="form-group">
                      <label for="productcategory">Product Category</label>
                      <input type="text" class="form-control" id="productcategory" placeholder="Enter Product Category">
                    </div>
                    <div class="form-group">
                      <label for="productdescription">Product Description</label>
                      <textarea id="productdescription" class="form-control">Write <em>Desciption</em> <strong>here</strong></textarea>
                    </div>
                    <div class="form-group">
                      <label for="uploadimage">Upload Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="uploadimage">
                          <label class="custom-file-label" for="uploadimage">Choose file</label>
                        </div>
                      </div>
                    </div> -->
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <?php include("inc/footer.php") ?>


    <!-- ./wrapper -->
    <script>
      $(function() {
        // Summernote
        $('#productdescription').summernote()

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
          mode: "htmlmixed",
          theme: "monokai"
        });
      })
    </script>
</body>

</html>