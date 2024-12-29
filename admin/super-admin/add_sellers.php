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
    <title>Admin | Add Branch</title>

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
                            <h1>Add Branch</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Add Branch</li>
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
                                    <h3 class="card-title">Add new seller here</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form id="sellerForm">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="fullName">Name</label>
                                                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="fullAddress">Address</label>
                                                    <input type="text" class="form-control" id="fullAddress" name="fullAddress" placeholder="Enter Address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="itemsCount">No. of items</label>
                                                    <input type="number" class="form-control" id="itemsCount" name="itemsCount" placeholder="Enter No. of items">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="phone">Phone No.</label>
                                                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter Phone No.">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Select Category</label>
                                                    <select class="custom-select" id="category" name="category">
                                                        <option selected disabled>chooese category</option>
                                                        <?php
                                                        include("../config.php");
                                                        $sql = "SELECT * FROM categories WHERE status = 1";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                            <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="panNo">GST or Pan no</label>
                                                    <input type="text" class="form-control" id="panNo" name="panNo" placeholder="Enter GST or Pan no">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="uploadimage">GST or Pan card Image</label> <br>
                                                    <input type="file" id="panImage" name="panImage">
                                                    <!-- <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file">
                                                            <label class="custom-file-label" for="uploadimage">Choose file</label>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="pinCode">Pin code</label>
                                                    <input type="number" class="form-control" id="pinCode" name="pinCode" placeholder="Enter Pin code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="frenchiesType">Select Branch for</label>
                                                    <select class="custom-select rounded-0" id="frenchiesType" name="frenchiesType">
                                                        <option selected disabled> Chooese Branch type</option>
                                                        <option value="Seller Panel">Seller panel</option>
                                                        <option value="Booking Panel">Booking panel</option>
                                                        <option value="Delivery Panel">Delivery panel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="uploadimage">Seller Logo (if available)</label> <br>
                                                    <input type="file" id="sellerLogo" name="sellerLogo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Add Seller</button>
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
            $(document).ready(function() {

                // add inquiry 
                $('#sellerForm').on('submit', function(event) {
                    event.preventDefault();

                    // Front-end validation
                    var fullName = $('#fullName').val()
                    var email = $('#email').val()
                    var fullAddress = $('#fullAddress').val()
                    var itemsCount = $('#itemsCount').val()
                    var phone = $('#phone').val()
                    var category = $('#category').val()
                    var panNo = $('#panNo').val()
                    var panImage = $('#panImage').val()
                    var pinCode = $('#pinCode').val()
                    var frenchiesType = $('#frenchiesType').val()

                    if (!fullName) {
                        Toast("error", "Name is required");
                        return;
                    }
                    if (!email) {
                        Toast("error", "email is required");
                        return;
                    }
                    if (!fullAddress) {
                        Toast("error", "Address is required");
                        return;
                    }
                    if (!itemsCount) {
                        Toast("error", "Items Count is required");
                        return;
                    }
                    if (!phone) {
                        Toast("error", "phone is required");
                        return;
                    }
                    if (!category) {
                        Toast("error", "category is required");
                        return;
                    }
                    if (!panNo) {
                        Toast("error", "Pan no or GST no is required");
                        return;
                    }
                    if (!panImage) {
                        Toast("error", "Image is required");
                        return;
                    }
                    if (!pinCode) {
                        Toast("error", "PinCode is required");
                        return;
                    }
                    if (pinCode.length != 6) {
                        Toast("error", "Enter valid pincode");
                        return;
                    }
                    if (!frenchiesType) {
                        Toast("error", "Chooese frenchies type");
                        return;
                    }

                    var formData = new FormData(this);
                    formData.append('action', 'addSeller');

                    $.ajax({
                        url: 'query.php',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            const data = typeof response === 'string' ? JSON.parse(response) : response;
                            console.log(data);
                            if (data.status === 'success') {
                                Toast('success', response.message);
                                $('#sellerForm')[0].reset();
                            } else {
                                Toast('error', response.message)
                            }
                        },
                        error: function(error) {
                            console.log(error)
                            Toast('error', 'An error occurred. Please try again.')
                            // alert('An error occurred. Please try again.');
                        }
                    });
                });

            });
        </script>
</body>

</html>