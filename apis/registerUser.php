<?php
include "../app/config.php";
include "../app/helper.php";
// Method : POST 
// $_SERVER[]
/**
 * email: user email
 * password: user password
 */
// p($_SERVER);
$response = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
                $status = 0;
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
                    $status = 1;
                } else {
                    $msg = "Internal server error please try again later";
                    $status = 0;
                }
            }
        } else {
            $msg = "Password and Confirm Password must match";
            $status = 0;
        }
        // $msg = "All okay";
        // $error = 0;
    } else {
        // throw error
        $msg = "Please fill all the required feilds";
        $status = 0;
    }
    // $response = [
    //     'msg' => $msg,
    //     'status' => $status
    // ];
    // http_response_code($code);
    $response = compact('msg','status');
} else {
    http_response_code(405);
    $response = [
        'msg' => 'Only post method is allowed',
        'status' => 0
    ];
}

echo json_encode($response);
