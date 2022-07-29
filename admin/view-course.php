<?php 
include "../app/config.php";
include "../app/helper.php";
$id = $_GET['id'];
$status = $_GET['status'];
if(isset($id)){
    if(isset($status)){
       // update query
        // $qry1 = 'UPDATE news SET status = $status WHERE id = $id'; 
        $qry = "UPDATE courses SET status = $status WHERE id = $id"; 
    }else{
        // delete query
        $qry = "DELETE FROM courses WHERE id = $id";
    }
    try{
        mysqli_query($conn,$qry);
    }
    catch(Exception $err){
        
    }
    
}
include "layouts/header.php"; 
?>
<!-- Content Wrapper -->


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">View News</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <td>Sr.</td>
                        <td>Name</td>
                        <td width="40%">Description</td>
                        <td>Status</td>
                        <td>Image</td>
                        <td>Created At</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // $sel = "SELECT * FROM news ORDER BY id ASC";
                        $sel = "SELECT * FROM courses ORDER BY id DESC";
                        $exe = mysqli_query($conn,$sel);
                        $i = 1;
                        while($fetch = mysqli_fetch_assoc($exe)){
                            // p($fetch);
                    ?>
                    <tr>
                        <td>
                            <?php echo $i?>
                        </td>
                        <td>
                            <?php echo $fetch['name']?>
                        </td>
                        <td>
                            <?php echo $fetch['description']?>
                        </td>
                        <td style="background-color: <?php echo $fetch['color']?>">
                            <!-- <?php echo $fetch['image']?> -->
                            <img src="../images/courses/<?php echo $fetch['image']?>" alt="" >
                        </td>
                        <td>
                            <?php if($fetch['status'] == 1){?>
                            <!-- if old active / new inacitve -->
                            <a href="view-course.php?id=<?php echo $fetch['id']?>&status=0">
                                <button class="btn btn-primary">Active</button>
                            </a>
                            <?php }else{?>
                            <!-- if old inactive / new acitve -->
                            <a href="view-course.php?id=<?php echo $fetch['id']?>&status=1">
                                <button class="btn btn-warning">Inactive</button>
                            </a>
                            <?php }?>
                        </td>
                        <td>
                            <?php echo $fetch['created_at']?>
                        </td>
                        <td>
                            <a href="add-course.php?id=<?php echo $fetch['id']?>">
                                <i class="text-primary fa fa-pen"></i>
                            </a>
                            <br />
                            <br />
                            <a href="view-course.php?id=<?php echo $fetch['id']?>">
                                <i class="text-danger fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                        $i++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- End of Main Content -->
<?php include "layouts/footer.php"; ?>