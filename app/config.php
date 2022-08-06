<?php
error_reporting(0);
session_start();

// Database connection
try {
    // hostname, username, password, databasename
    $conn = mysqli_connect("localhost", "root", "", "iip");
} catch (Exception $error) {
    //echo $error->getMessage();
    echo "Database connection error";
    die; // end of execution
}

