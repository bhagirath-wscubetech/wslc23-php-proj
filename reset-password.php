<?php
include "app/config.php";
include "app/helper.php";
$msg = $_SESSION['message'] ?? "";
$error = $_SESSION['error'] ?? 0;
unset($_SESSION['message']);
unset($_SESSION['error']);
$token = $_GET['token'] ?? null;
if (is_null($token)) {
    $msg = "Token not found";
    $error = 1;
} else {
    $res = getUserByToken($token);
    if ($res['status'] == 0) {
        $error = 1;
        $msg = $res['message'];
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
        <form class="form-right" action="reset-password-final.php" method="post">
            <?php
            if ($msg != "") {
            ?>

                <div class="alert <?php echo $error == 1 ? 'alert-danger' : 'alert-success' ?>" role="alert">
                    <?php echo $msg ?>
                </div>

            <?php
            }
            ?>


            <h2 class="text-uppercase">Reset Password</h2>

            <div class="mb-3">
                <label>Email</label>
            </div>
            <div class="form-field">
                <input type="email" class="input-field" required name="email" readonly id="" value="<?php echo $res['email'] ?>">
            </div>
            <input type="text" hidden name="token" value="<?php echo $token ?>">
            <div class="mb-3">
                <label>New Password</label>
            </div>
            <div class="form-field">
                <input type="password" class="input-field" required name="new_password" id="">
            </div>

            <div class="mb-3">
                <label>Confirm Password</label>
            </div>
            <div class="form-field">
                <input type="password" class="input-field" required name="confirm_password" id="">
            </div>
            <div class="form-field">
                <input type="submit" <?php echo $error == 1 ? 'disabled' : '' ?> value="Reset" class="register" name="reset">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>