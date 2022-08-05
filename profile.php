<?php
include "app/config.php";
include "app/helper.php";
$error = 0; // 0: No error, 1: Yes error
$msg = "";
// error_reporting(E_ALL);
if (!isset($_SESSION['user_id'])) {
    header("LOCATION:login.php");
}

if (isset($_POST['change_pass'])) {
    $old_pass = md5(escapeString($_POST['old_pass']));
    $new_pass = md5(escapeString($_POST['new_pass']));
    $con_pass = md5(escapeString($_POST['con_pass']));
    $userId = $_SESSION['user_id'];

    $selUser = "SELECT * FROM users WHERE password = '$old_pass' AND id = $userId";
    $exeUser = mysqli_query($conn, $selUser);
    $userCount = mysqli_num_rows($exeUser);
    if ($userCount == 1) {
        // next step
        if ($old_pass == $new_pass) {
            // throw error
            $msg = "Old password and new password cannot be same";
            $error = 1;
        } else {
            if ($new_pass == $con_pass) {
                // next step
                $upd = "UPDATE users SET password = '$new_pass' WHERE id = $userId";
                mysqli_query($conn, $upd);
                // $msg = "Password changed successfully";
                // $error = 0;
                unset($_SESSION['user_id']);
                unset($_SESSION['user_name']);
                unset($_SESSION['user_email']);
                $_SESSION['message'] = "Password changed successfully, please login once";
                $_SESSION['error'] = 1;
                header("LOCATION:login.php");
            } else {
                $msg = "New password and confirm password must match";
                $error = 1;
            }
        }
    } else {
        // throw error
        $msg = "Old password is incorrect";
        $error = 1;
    }
}

include "layouts/header.php";
?>
<!-- right part of the middle portion starts here -->
<div class="middle-right">
    <div class="page-status">
        <h1><?php echo $fetchSingleNews['title'] ?></h1>
        <h2><i onclick='window.location.href = "index.php" '> Home /</i> Profile:</h2>
    </div>
    <div class="about-content">
        <?php
        if ($msg != "") {
        ?>

            <div class="alert <?php echo $error == 1 ? 'alert-danger' : 'alert-success' ?>" role="alert">
                <?php echo $msg ?>
            </div>

        <?php
        }
        ?>
        <form action="" method="post">
            <div class="row">
                <div class="col">
                    <label for="">Old Password</label>
                    <input type="password" name="old_pass">
                </div>
                <div class="col">
                    <label for="">New Password</label>
                    <input type="password" name="new_pass">
                </div>
                <div class="col">
                    <label for="">Confirm Password</label>
                    <input type="password" name="con_pass">
                </div>
                <div class="col">
                    <button name="change_pass">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- right part of the middle portion starts here -->
<div class="clear"></div>
</div>
<!-- middle portion with  links, new , banner and course ends here -->

<?php
include "layouts/footer.php";
?>