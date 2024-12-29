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
  <title>Delhi parcel Admin | User Profile</title>
  <?php include("inc/links.php") ?>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include("inc/topbar.php") ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include("inc/sidebar.php") ?>
    <?php include("../config.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">User Profile</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
              <?php
              $adminEmail = $_SESSION['admin_email'];
              $sql = "SELECT * FROM admin WHERE email = '$adminEmail'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              // var_dump($row);
              ?>
              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                      src="dist/img/avatar5.png"
                      alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center"><?php echo $row['name'] ?></h3>

                  <p class="text-muted text-center"><?php echo $row['email'] ?></p>
                  <p class="text-muted text-center"><?php echo $row['mobile'] ?></p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Update Profile</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Profile</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Change Password</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" id="updateProfile">
                        <div class="form-group row">
                          <label for="adminName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="adminName" name="adminName" placeholder="Name" value="<?php echo $row['name'] ?>">
                            <input type="text" class="form-control" id="adminId" name="adminId" placeholder="Name" value="<?php echo $row['id'] ?>" readonly hidden>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="adminEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="Email" value="<?php echo $row['email'] ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="adminMobile" class="col-sm-2 col-form-label">Mobile</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="adminMobile" name="adminMobile" placeholder="Name" value="<?php echo $row['mobile'] ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="updateProfile">Update Profile</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                      <form class="form-horizontal" id="passwordChange">
                        <div class="form-group row">
                          <label for="oldPassword" class="col-sm-2 col-form-label">Old Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password">
                            <input type="text" class="form-control" id="adminId2" name="adminId2" placeholder="Name" value="<?php echo $row['id'] ?>" readonly hidden>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="newPassword" class="col-sm-2 col-form-label">New Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="newPassword2" class="col-sm-2 col-form-label">New Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="newPassword2" name="newPassword2" placeholder="New Password">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger" id="changePassword">Change Password</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("inc/footer.php") ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min2167.js?v=3.2.0"></script>
  <!-- AdminLTE for demo purposes -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#updateProfile').on('submit', function(event) {
        event.preventDefault();

        var adminId = $('#adminId').val()
        var adminName = $('#adminName').val()
        var adminEmail = $('#adminEmail').val()
        var adminMobile = $('#adminMobile').val()

        if (!adminId) {
          Toast("error", "Id is required");
          return;
        }
        if (!adminName) {
          Toast("error", "Name is required");
          return;
        }
        if (!adminEmail) {
          Toast("error", "Email is required");
          return;
        }
        if (!adminMobile) {
          Toast("error", "Mobile is required");
          return;
        }

        var formData = {
          action: 'updateAdmin',
          adminId: $('#adminId').val(),
          adminName: $('#adminName').val(),
          adminEmail: $('#adminEmail').val(),
          adminMobile: $('#adminMobile').val()
        };

        $.ajax({
          type: 'POST',
          url: 'query.php',
          data: formData,
          dataType: 'json',
          success: function(response) {
            if (response.status === 'success') {
              Toast('success', response.message);
              window.location.reload();
            } else {
              Toast('error', response.message);
            }
          },
          error: function(xhr, status, error) {
            // console.error(xhr.responseText);
            Toast('error', 'An error occurred. Please try again.')
          }
        });
      });

      $('#passwordChange').on('submit', function(event) {
        event.preventDefault();

        var oldPassword = $('#oldPassword').val();
        var adminId = $('#adminId2').val()
        var newPassword = $('#newPassword').val();
        var newPassword2 = $('#newPassword2').val();

        if (!oldPassword) {
          Toast('error', 'Old password is required');
          return;
        }
        if (!newPassword) {
          Toast('error', 'New password is required');
          return;
        }
        if (!newPassword2) {
          Toast('error', 'Confirm password is required');
          return;
        }
        if (newPassword !== newPassword2) {
          Toast('error', 'New password and Confirm password are not matched');
          return;
        }

        var formData = {
          action: 'changePassword',
          adminId: adminId,
          oldPassword: oldPassword,
          newPassword: newPassword
        };

        $.ajax({
          type: 'POST',
          url: 'query.php',
          data: formData,
          dataType: 'json',
          success: function(response) {
            if (response.status === 'success') {
              Toast('success', response.message);
              window.location.reload();
            } else {
              Toast('error', response.message);
            }
          },
          error: function(xhr, status, error) {
            // console.error(xhr.responseText);
            Toast('error', 'An error occurred. Please try again.')
          }
        });
      });

    });
  </script>

</body>


</html>