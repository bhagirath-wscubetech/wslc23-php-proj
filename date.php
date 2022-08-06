<?php
include "app/helper.php";
// date_default_timezone_set("ASIA/KOLKATA");
// // echo date_default_timezone_get();
// // echo "<br/>";
// // // echo time()/365/60/60/24;
// // echo date("d-M-Y D h:i:s a l L F");

// $str = "10-Jan-1999 02:45:10 AM";
// $timeStamp =  strtotime($str);
// echo $timeStamp;
// echo "<br/>";
// echo date("d-F-Y D h:i:s a", $timeStamp);

$today = time();
$after = 28 * 3600 * 24;
$end = $today + $after;

p(date("d-m-y", $end));
p($today);
p($after);


?>
<script>
    console.log(new Date().getTime());
</script>