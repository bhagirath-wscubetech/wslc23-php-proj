<?php
include "app/config.php";
include "app/helper.php";

// p($_POST);
$name = mysqli_escape_string($conn, $_POST['name']);
$gender = mysqli_escape_string($conn, $_POST['gender']);
$email = mysqli_escape_string($conn, $_POST['email']);
$contact = mysqli_escape_string($conn, $_POST['contact']);
$country = mysqli_escape_string($conn, $_POST['country']);
$state = mysqli_escape_string($conn, $_POST['state']);
$enquiry = mysqli_escape_string($conn, $_POST['enquiry']);
$response = [];

// p($name);
// p($gender);
// p($email);
// p($contact);
// p($country);
// p($state);
// p($enquiry);

if ($name != "" && $email != "" && $contact != "" && $country != 0 && $state != "" && $enquiry != "") {
    // all okay, enter data into db
    $ins = "INSERT INTO enquiries SET name = '$name', email ='$email',contact = '$contact', state_name = '$state',gender = '$gender', country_id = '$country', enquiry = '$enquiry'";
    $flag = mysqli_query($conn, $ins);
    if ($flag == true) {
        $response = [
            'msg' => 'Enquiry submitted',
            'status' => 1
        ];
    } else {
        $response = [
            'msg' => 'Internal server error',
            'status' => 0
        ];
    }
} else {
    // some error
    $response = [
        'msg' => 'Please fill the required feilds',
        'status' => 0
    ];
}


echo json_encode($response);
