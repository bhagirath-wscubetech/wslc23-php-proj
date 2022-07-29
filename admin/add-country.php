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
   $selSingleCountry = "SELECT * FROM countries WHERE id = $id";
   $exeSingleCountry = mysqli_query($conn,$selSingleCountry);
   $fetchSingleCountry = mysqli_fetch_assoc($exeSingleCountry);
//    p($fetchSingleCountry);
   if(!isset($fetchSingleCountry['id'])){
        header("LOCATION:404.php");
   }
}   
if(isset($_POST['save'])){
    $countryName = $_POST['country_name'];
    // echo mysqli_escape_string($conn,$countryName);
    // die;
    if($countryName != ""){
        // server side validation 
        // insert query
        if(isset($id)){
            $qry = "UPDATE countries SET name = '$countryName' WHERE id = $id";
        }else{
            $qry = "INSERT INTO countries SET name ='$countryName'";
        }
        try{
           $flag = mysqli_query($conn,$qry);
        }catch(Exception $err){
            $flag = false;
            // echo $err->getMessage();
        }
        // var_dump($flag);
        if($flag == true){
            header("LOCATION:view-country.php");
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
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $mode?> Country</h6>
        </div>
        <div class="card-body">
            <h4 class="text-center text-danger"><?php echo $msg?></h4>
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-lable">Name</label>
                        <input type="text" required name="country_name" class="form-control"
                            value="<?php echo $fetchSingleCountry['title']?>">
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