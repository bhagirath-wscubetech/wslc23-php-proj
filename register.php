<?php
include "app/config.php";
include "app/helper.php";
$error = 0; // 0: No error, 1: Yes error
$msg = "";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_pass = $_POST['password_confirm'];

    if ($name != "" && $email != "" && $password != "" && $con_pass != "") {
        // next step
        if ($password == $con_pass) {
            // next step
            $selUser = "SELECT * FROM users WHERE email = '$email'";
            $exeUser = mysqli_query($conn, $selUser);
            $userData = mysqli_fetch_assoc($exeUser);
            // p($userData);
            if (isset($userData['id'])) {
                $msg = "User with this email already exists";
                $error = 1;
            } else {
                // final step
                $encodedPass = md5($password);
                $ins = "INSERT INTO users SET name ='$name', email='$email', password='$encodedPass'";
                try {
                    mysqli_query($conn, $ins);
                    $insFlag = 1; //success
                } catch (Exception $exp) {
                    $insFlag = 0; // not succed
                }

                if ($insFlag == 1) {
                    $msg = "Account created successfully";
                    $error = 0;
                    $email = "";
                    $name = "";
                } else {
                    $msg = "Internal server error please try again later";
                    $error = 1;
                }
            }
        } else {
            $msg = "Password and Confirm Password must match";
            $error = 1;
        }
        // $msg = "All okay";
        // $error = 0;
    } else {
        // throw error
        $msg = "Please fill all the required feilds";
        $error = 1;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <div class="wrapper">
        <div class="form-left">
            <h2 class="text-uppercase">IIP Academy</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et molestie ac feugiat sed. Diam volutpat commodo.
            </p>
            <p class="text">
                <span>Sub Head:</span>
                Vitae auctor eu augudsf ut. Malesuada nunc vel risus commodo viverra. Praesent elementum facilisis leo vel.
            </p>
            <div class="form-field">
                <a href="login.php">
                    <input type="button" class="account" value="Have an Account?">
                </a>
            </div>
        </div>
        <form class="form-right" method="post">
            <?php
            if ($msg != "") {
            ?>

                <div class="alert <?php echo $error == 1 ? 'alert-danger' : 'alert-success' ?>" role="alert">
                    <?php echo $msg ?>
                </div>

            <?php
            }
            ?>


            <h2 class="text-uppercase">Registration form</h2>
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="input-field" value="<?php echo $name ?>">
            </div>
            <div class="mb-3">
                <label>Your Email</label>
                <input type="email" class="input-field" name="email" required value="<?php echo $email ?>">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="input-field">
            </div>
            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirm" class="input-field">
            </div>
            <div class="mb-3">
                <label class="option">I agree to the <a href="#">Terms and Conditions</a>
                    <input type="checkbox" checked>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="form-field">
                <input type="submit" value="Register" class="register" name="register">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>