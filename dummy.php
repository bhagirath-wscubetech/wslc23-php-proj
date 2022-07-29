<?php
include "app/config.php";
include "app/helper.php";
error_reporting(E_ALL);

$canadian_states = array( 
    "BC" => "British Columbia", 
    "ON" => "Ontario", 
    "NL" => "Newfoundland and Labrador", 
    "NS" => "Nova Scotia", 
    "PE" => "Prince Edward Island", 
    "NB" => "New Brunswick", 
    "QC" => "Quebec", 
    "MB" => "Manitoba", 
    "SK" => "Saskatchewan", 
    "AB" => "Alberta", 
    "NT" => "Northwest Territories", 
    "NU" => "Nunavut",
    "YT" => "Yukon Territory"
);

foreach($canadian_states as $state){
    // echo $state."<br/>";
    $ins = "INSERT INTO states SET name='$state',country_id=38";
    mysqli_query($conn,$ins);
}
?>