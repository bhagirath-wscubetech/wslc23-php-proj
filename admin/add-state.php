<?php 
include "../app/config.php";
include "../app/helper.php";
$msg = "";
// Db functional Code
//  is set ?
// p($_POST);
$mode = "Add";
$id = $_GET['id'];
if(isset($id)){
    $mode = "Update";
   $selSingleState = "SELECT * FROM states WHERE id = $id";
   $exeSingleState = mysqli_query($conn,$selSingleState);
   $fetchSingleState = mysqli_fetch_assoc($exeSingleState);
//    p($fetchSingleState);
   if(!isset($fetchSingleState['id'])){
        header("LOCATION:404.php");
   }
}   
if(isset($_POST['save'])){
    $stateName = $_POST['state_name'];
    $countryId = $_POST['country'];
    // echo mysqli_escape_string($conn,$stateName);
    // die;
    if($stateName != "" && $countryId != 0){
        // server side validation 
        // insert query
        if(isset($id)){
            $qry = "UPDATE states SET name = '$stateName', country_id = '$countryId' WHERE id = $id";
        }else{
            $qry = "INSERT INTO states SET name ='$stateName', country_id = '$countryId'";
        }
        try{
           $flag = mysqli_query($conn,$qry);
        }catch(Exception $err){
            $flag = false;
            // echo $err->getMessage();
        }
        // var_dump($flag);
        if($flag == true){
            header("LOCATION:view-state.php");
        }else{
            $msg = "Internal server error";
        }
    }
}
// ------------------
include "layouts/header.php"; 
?>
<!-- Content Wrapper -->


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $mode?> State</h6>
        </div>
        <div class="card-body">
            <h4 class="text-center text-danger"><?php echo $msg?></h4>
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-lable">Name</label>
                        <input type="text" required name="state_name" class="form-control"
                            value="<?php echo $fetchSingleState['title']?>">
                    </div>
                    <div class="col-12">
                        <label for="" class="form-lable">Country</label>
                        <select name="country" id="" class="form-control">
                            <option value="0">Select a country</option>
                            <?php 
                                $sel = "SELECT * FROM countries WHERE status = 1 ORDER BY name ASC";
                                $exe = mysqli_query($conn,$sel);
                                while($fetch = mysqli_fetch_assoc($exe)){
                            ?>
                            <option value="<?php echo $fetch['id']?>"><?php echo $fetch['name']?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 mt-2">
                        <button class="btn btn-primary" type="submit" name="save" value="clicked">
                            <?php echo $mode?>
                        </button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- End of Main Content -->
<?php include "layouts/footer.php"; ?>