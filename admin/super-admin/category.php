<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_email'])) {
    header('Location: index.php');
}
?>
<?php include("../config.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Add Category</title>

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
              <h1>Add Category</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Add Category</li>
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
                  <h3 class="card-title">Add new category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="categoryForm">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="categoryName">Category Name</label>
                          <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Enter Category Name">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add Category</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

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
                        <th>Name</th>
                        <th>status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT * FROM categories";
                      $result = mysqli_query($conn, $sql);
                      $index = 1;
                      if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                          <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td>
                              <label class="switch">
                                <input type="checkbox" class="status-toggle" <?php echo $row['status'] ? 'checked' : ''; ?> data-id="<?php echo $row['id']; ?>">
                                <div class="slider">
                                  <div class="circle">
                                    <svg class="cross" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 365.696 365.696" y="0" x="0" height="6" width="6" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                      <g>
                                        <path data-original="#000000" fill="currentColor" d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0"></path>
                                      </g>
                                    </svg>
                                    <svg class="checkmark" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 24 24" y="0" x="0" height="10" width="10" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                      <g>
                                        <path class="" data-original="#000000" fill="currentColor" d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"></path>
                                      </g>
                                    </svg>
                                  </div>
                                </div>
                              </label>
                            </td>
                            <td>
                              <span class="badge bg-danger delete-service" data-id=<?php echo $row['id']; ?>><a href="#"><i class="fas fa-trash"></i></a></span>
                            </td>
                          </tr>
                      <?php
                          $index++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


    </div>
    <?php include("inc/footer.php") ?>


    <!-- Page specific script -->
    <script>
      $(function() {
        $("#example1").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
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

        // add category 
        $('#categoryForm').on('submit', function(event) {
          event.preventDefault();

          // Front-end validation
          var categoryName = $('#categoryName').val().trim();

          if (!categoryName) {
            Toast("error", "Category name is required");
            return;
          }

          var formData = new FormData(this);
          formData.append('action', 'addCategory');

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
              // console.log(data);
              if (data.status === 'success') {
                Toast('success', response.message)
                window.location.reload()
              } else {
                Toast('error', response.message)
              }
            },
            error: function() {
              Toast('error', 'An error occurred. Please try again.')
              // alert('An error occurred. Please try again.');
            }
          });
        });

        // update category status
        $('.status-toggle').on('change', function() {
          var serviceId = $(this).data('id');
          var status = $(this).is(':checked') ? 1 : 0;

          $.ajax({
            url: 'query.php',
            type: 'POST',
            data: {
              id: serviceId,
              status: status,
              action: 'updateCategoryStatus'
            },
            dataType: 'json',
            success: function(response) {
              if (response.status === 'success') {
                Toast('success', response.message);
              } else {
                Toast('error', response.message);
              }
            },
            error: function() {
              Toast('error', 'An error occurred. Please try again.');
            }
          });
        });

        // delete review
        $('.delete-service').on('click', function() {
          var serviceId = $(this).data('id');

          $.ajax({
            url: 'query.php',
            type: 'POST',
            data: {
              id: serviceId,
              status: status,
              action: 'deleteCategory'
            },
            dataType: 'json',
            success: function(response) {
              if (response.status === 'success') {
                Toast('success', response.message);
                window.location.reload();
              } else {
                Toast('error', response.message);
              }
            },
            error: function() {
              Toast('error', 'An error occurred. Please try again.');
            }
          });
        });


      });
    </script>














</body>

</html>