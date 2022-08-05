<?php
include "app/config.php";
include "app/helper.php";
// error_reporting(E_ALL);
$error =  $_SESSION['error'] ?? 0; // 0: No error, 1: Yes error
$msg = $_SESSION['message'] ?? ""; // NULL SAFE OPERATOR
unset($_SESSION['error']);
unset($_SESSION['message']);
if (isset($_POST['reset'])) {
    $email = mysqli_escape_string($conn, $_POST['email']);
    if ($email != "") {
        // next step
        $selUser = "SELECT * FROM users 
                    WHERE 
                    email = '$email'";
        $exeUser = mysqli_query($conn, $selUser);
        $userData = mysqli_fetch_assoc($exeUser);
        $userId = $userData['id'];
        if (isset($userId)) {
            // next step
            $token = getToken(100);
            $ins = "INSERT INTO reset_passwords SET user_id = $userId, token = '$token'";
            mysqli_query($conn, $ins);
            $link = "http://localhost/iip/reset-password.php?token=$token";
            $mail_msg = "Hey we heard that you forgot your password, its okay just click on the given link to reset it: $link";
            echo $link;
            // mail($email, "Reset password", $mail_msg);
            // echo $link;
        } else {
            $msg = "You've entered an incorrect email address";
            $error = 1;
        }
    } else {
        $msg = "Please enter your email address";
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


            <h2 class="text-uppercase">Forgot Password?</h2>

            <div class="mb-3">
                <label>Your Email</label>
                <input type="email" class="input-field" name="email" required value="<?php echo $email ?>">
            </div>
            <div class="form-field">
                <input type="submit" value="Reset" class="register" name="reset">
            </div>
            <di v class="form-field">
                Password recalled? <a href="login.php">Login now</a>
    </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>