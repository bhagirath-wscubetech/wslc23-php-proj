<?php
include "app/config.php";
include "app/helper.php";

if (isset($_POST['reset'])) {
    $email = escapeString($_POST['email']);
    $newPass = md5(escapeString($_POST['new_password']));
    $conPass = md5(escapeString($_POST['confirm_password']));
    $token = $_POST['token'];
    if ($newPass == $conPass) {
        // update
        $upd = "UPDATE users SET password = '$newPass' WHERE email ='$email'";
        mysqli_query($conn, $upd);
        $_SESSION['message'] = "Password reset successfully, Login once";
        $_SESSION['error'] = 0;
        header("LOCATION:login.php");
    } else {
        $_SESSION['message'] = "Password and Confirm password must match";
        $_SESSION['error'] = 1;
        header("LOCATION:reset-password.php?token=$token");
    }
}
