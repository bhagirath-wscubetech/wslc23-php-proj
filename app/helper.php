<?php
function p($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


function escapeString($data)
{
    global $conn;
    return mysqli_escape_string($conn, $data);
}

function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    global $conn;
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
    }
    $sel = "SELECT * FROM reset_passwords WHERE token = '$token'";
    $exe = mysqli_query($conn, $sel);
    $count = mysqli_num_rows($exe);
    if ($count > 0) {
        return getToken($length);
    }
    return $token;
}

function getUserByToken($token)
{
    global $conn;
    $revert = [];
    try {
        $sel = "SELECT email,users.id FROM reset_passwords 
                LEFT JOIN users ON reset_passwords.user_id = users.id WHERE token = '$token'";
        $exe = mysqli_query($conn, $sel);
        $data = mysqli_fetch_assoc($exe);
        if (isset($data['id'])) {
            $revert = [
                'status' => 1,
                'email' => $data['email'],
                'user_id' => $data['id']
            ];
        } else {
            $revert = [
                'status' => 0,
                'message' => 'Invalid token'
            ];
        }
    } catch (\Exception $err) {
        $revert = [
            'status' => 0,
            'message' => 'Internal server error'
        ];
    }
    return $revert;
}


function getCookieExpiresTime()
{
    $COOKIES_EXPIRES = time() + (3600 * 24 * 10); // 10 days
    return $COOKIES_EXPIRES;
}
