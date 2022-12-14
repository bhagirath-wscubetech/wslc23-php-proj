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
    // next step
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
            if ($userData['status'] == 1) {
                $upd = "UPDATE users SET last_login = current_timestamp() WHERE email = '$email'";
                mysqli_query($conn, $upd);
                $ip_add = $_SERVER['REMOTE_ADDR'];
                $ins = "INSERT INTO user_ips SET user_id = $userId, ip_address ='$ip_add'";
                mysqli_query($conn, $ins);
                http_response_code(200);
                $selToken = "SELECT * FROM api_tokens WHERE user_id = $userId";
                $exeToken = mysqli_query($conn, $selToken);
                $fetchToken = mysqli_fetch_assoc($exeToken);
                $myToken = $fetchToken['token'];
                if ($myToken != "") {
                    $tokenFlag = isTokenExpired($fetchToken['created_at']);
                    if ($tokenFlag == true) {
                        $oldTokenId = $fetchToken['token_id'];
                        $delToken = "DELETE FROM api_tokens WHERE token_id = $oldTokenId";
                        mysqli_query($conn, $delToken);
                        $myToken = getToken(100, "api_tokens");
                        $insToken = "INSERT INTO api_tokens SET user_id = $userId, token = '$myToken'";
                        mysqli_query($conn, $insToken);
                    }
                } else {
                    $myToken = getToken(100, "api_tokens");
                    $insToken = "INSERT INTO api_tokens SET user_id = $userId, token = '$myToken'";
                    mysqli_query($conn, $insToken);
                }
                // check if any token already exists 
                // $myToken = 

                $response = [
                    'msg' => 'Login success',
                    'status' => 1,
                    'user' => $userData,
                    'access_token' => $myToken
                ];
            } else {
                http_response_code(403);
                $response = [
                    'msg' => 'Account is inactive',
                    'status' => 0,
                ];
            }
        } else {
            // invalid credentails
            // $msg = "Invalid credentails";
            // $error = 1;
            http_response_code(401);
            $response = [
                'msg' => 'Invalid credentails',
                'status' => 0
            ];
        }
    } else {
        http_response_code(400);
        $response = [
            'msg' => 'Please fill all the required fields',
            'status' => 0
        ];
    }
    // http_response_code(200);
} else {
    http_response_code(405);
    $response = [
        'msg' => 'Only post method is allowed',
        'status' => 0
    ];
}

echo json_encode($response);
