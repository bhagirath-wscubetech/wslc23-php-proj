<option value="">Please select a state</option>
<?php
    include "app/config.php";
    include "app/helper.php";
    $cId = $_GET['country_id'];
    $selStates = "SELECT * FROM states WHERE country_id = $cId";
    $exeStates = mysqli_query($conn,$selStates);
    while($fetchStates = mysqli_fetch_assoc($exeStates)) {
?>
    <option><?php echo $fetchStates['name']?></option>
<?php
    }
?>