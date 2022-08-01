<?php
include "app/config.php";
include "app/helper.php";
$error = 0; // 0: No error, 1: Yes error
$msg = "";
if (isset($_POST['login'])) {
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, $_POST['password']);

    if ($email != "" && $password != "") {
        $encodedPass = md5($password);
        $selUser = "SELECT * FROM users 
                    WHERE 
                    email = '$email' AND password = '$encodedPass'";
        $exeUser = mysqli_query($conn, $selUser);
        $userData = mysqli_fetch_assoc($exeUser);
        $userId = $userData['id'];
        if (isset($userData['id'])) {
            // login
            $upd = "UPDATE users SET last_login = current_timestamp() WHERE email = '$email'";
            mysqli_query($conn, $upd);
            $ip_add = $_SERVER['REMOTE_ADDR'];
            $ins = "INSERT INTO user_ips SET user_id = $userId, ip_address ='$ip_add'";
            mysqli_query($conn, $ins);
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_name'] = $userData['name'];
            $_SESSION['user_email'] = $email;
            header("LOCATION:index.php");
        } else {
            // invalid credentails
            $msg = "Invalid credentails";
            $error = 1;
        }
    } else {
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


            <h2 class="text-uppercase">Login form</h2>

            <div class="mb-3">
                <label>Your Email</label>
                <input type="email" class="input-field" name="email" required value="<?php echo $email ?>">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="input-field">
            </div>
            <div class="form-field">
                <input type="submit" value="Login" class="register" name="login">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>