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
   $selSingleNews = "SELECT * FROM news WHERE id = $id";
   $exeSingleNews = mysqli_query($conn,$selSingleNews);
   $fetchSingleNews = mysqli_fetch_assoc($exeSingleNews);
//    p($fetchSingleNews);
   if(!isset($fetchSingleNews['id'])){
        header("LOCATION:404.php");
   }
}   
if(isset($_POST['save'])){
    $imgArr = $_FILES['course_image'];
    if($imgArr['name']){
        $tmpPath = $imgArr['tmp_name'];
        // image upload
        $imageName = time().rand().$imgArr['name'];
        $dest = "../images/courses/".$imageName;
        move_uploaded_file($tmpPath,$dest);
    }
    $courseName = mysqli_escape_string($conn,$_POST['course_name']);
    $courseDesc = mysqli_escape_string($conn,$_POST['course_desc']);
    $courseColor = mysqli_escape_string($conn,$_POST['course_color']);
    $coursePrice = mysqli_escape_string($conn,$_POST['course_price']);
    $courseDPrice = mysqli_escape_string($conn,$_POST['course_dprice']);
    $courseImage = mysqli_escape_string($conn,$_POST['course_image']);
    if($courseName != "" && $courseDesc != ""){
        // server side validation 
        // insert query
        if(isset($id)){
            $qry = "UPDATE news SET title = '$newsTitle',description = '$newsDesc' WHERE id = $id";
        }else{
            $qry = "INSERT INTO courses SET 
                        name ='$courseName', 
                        description = '$courseDesc',
                        image = '$imageName',
                        original_price = '$coursePrice',
                        discount_price = '$courseDPrice',
                        color = '$courseColor'
                    ";
                echo $qry;
        }
        try{
           $flag = mysqli_query($conn,$qry);
        }catch(Exception $err){
            $flag = false;
            echo $err->getMessage();
        }
        // var_dump($flag);
        if($flag == true){
            header("LOCATION:view-course.php");
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
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $mode?> Course</h6>
        </div>
        <div class="card-body">
            <h4 class="text-center text-danger"><?php echo $msg?></h4>
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <label for="" class="form-lable">Name</label>
                        <input type="text" required name="course_name" class="form-control"
                            value="<?php echo $fetchSingleNews['title']?>">
                    </div>
                    <div class="col-4">
                        <label for="" class="form-lable">Color</label>
                        <input type="color" required name="course_color" class="form-control"
                            value="<?php echo $fetchSingleNews['title']?>">
                    </div>
                    <div class="col-4">
                        <label for="" class="form-lable">Original Price</label>
                        <input type="number" required name="course_price" class="form-control"
                            value="<?php echo $fetchSingleNews['title']?>">
                    </div>
                    <div class="col-4">
                        <label for="" class="form-lable">Discount Price</label>
                        <input type="number" name="course_dprice" class="form-control"
                            value="<?php echo $fetchSingleNews['title']?>">
                    </div>
                    <div class="col-12">
                        <label for="">Image</label>
                        <input type="file" name="course_image" class="form-control">
                    </div>
                    <div class="col-12 mt-2">
                        <label for="" class="form-lable">Description</label>
                        <textarea name="course_desc" required id="editor" class="form-control" cols="30"
                            rows="10"><?php echo $fetchSingleNews['description']?></textarea>
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
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('course_desc');
</script>