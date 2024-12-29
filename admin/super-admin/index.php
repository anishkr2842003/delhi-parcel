<?php
session_start();
include("../config.php");


if (isset($_SESSION['admin_email'])) {
  header("Location: dashboard.php");
}


if (isset($_POST['login'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Replace password with hashed password verification if necessary
  $query = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['admin_email'] = $row['email'];
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "Invalid email or password.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Log in</title>

  <?php include("inc/links.php") ?>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="" class="h1"><img src="./dist/img/logo.png" alt="" height="100"></a>
        <!-- <a href="" class="h1"><b>Brand Name</b></a> -->
      </div>
      <div class="card-body">
        <!-- <p class="login-box-msg">Login now</p> -->
        <?php if (isset($error)) { ?>
          <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block" name="login">Log in</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.login-box -->


  <!-- <button onclick="Toast('success', 'Operation completed successfully!');">Show</button> -->


</body>

</html>