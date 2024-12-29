<?php
session_start();
include("../config.php");


if (isset($_SESSION['seller_email'])) {
    header("Location: dashboard.php");
}


if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // First, check if the user exists and the status is true
    $query = "SELECT * FROM seller WHERE email = '$email' AND type = 'Seller Panel'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if ($row['status'] == 1) {
            // Replace password with hashed password verification if necessary
            if ($row['login_password'] == $password) {
                // var_dump($row);
                // die();
                $_SESSION['seller_email'] = $row['email'];
                $_SESSION['seller_id'] = $row['id'];
                $_SESSION['seller_name'] = $row['fullName'];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Your ID is blocked.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delhi Parcel | Seller Panel</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-family: Arial, sans-serif;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('dist/img/bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            filter: blur(7px);
            /* Adjust the pixel value to increase or decrease the blur effect */
            z-index: -1;
        }

        .container {
            background-color: #fff;
            padding: 50px 25px;
            width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #000;
            margin: 0;
        }

        h1>.l {
            font-size: 30px;
            color: #8c0000;
        }

        label {
            font-weight: 700;
            font-size: 16px;
            color: black;
        }

        .inp {
            font-weight: 500;
            width: 100%;
            padding: 2.5px 3.75px;
            margin: 8px 0;
            display: inline-block;
            border: 2px solid #132;
            border-top: 0;
            border-left: 0;
            border-right: 0;
        }

        .inp,
        .inp:focus {
            outline: none;
        }

        button {
            background-color: #8c0000;
            color: white;
            padding: 12px 20px;
            margin: 8px 0;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            opacity: 0.925;
        }

        button:hover {
            opacity: 1;
        }

        .signup {
            width: 250px;
            padding: 0 7.5px;
            text-align: center;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .signup a {
            font-weight: 800;
            color: #8c0000;
            text-decoration: none;
        }

        .signup a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="bgc center">
        <div class="container">
            <div class="header">
                <img src="../../assets/images/logo.png" alt="" height="50px">
                <h1><span class="l">L</span>OGIN</h1>
                <?php if (isset($error)) { ?>
                    <div style="color: red;"><?php echo $error; ?></div>
                <?php } ?>
            </div>
            <form action="" method="post">
                <label for="uname">Username</label>
                <input type="email" class="inp" name="email" required>
                <label for="psw">Password</label>
                <input type="password" class="inp" name="password" required>
                <button type="submit" name="login">Enter</button>
            </form>
            <!-- <div class="signup">
                <b>Don't have account?</b>
                <a href="#">Sign up</a>
            </div> -->
        </div>
    </div>

</body>

</html>