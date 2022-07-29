<?php 
include "../app/config.php";
include "../app/helper.php";
$newsId = $_GET['id'];
$newStatus = $_GET['newstatus'];
if(isset($newsId)){
    if(isset($newStatus)){
       // update query
        // $qry1 = 'UPDATE news SET status = $newStatus WHERE id = $newsId'; 
        $qry = "UPDATE news SET status = $newStatus WHERE id = $newsId"; 
    }else{
        // delete query
        $qry = "DELETE FROM news WHERE id = $newsId";
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
                        <td>Title</td>
                        <td width="40%">Description</td>
                        <td>Status</td>
                        <td>Created At</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // $sel = "SELECT * FROM news ORDER BY id ASC";
                        $sel = "SELECT * FROM news ORDER BY id DESC";
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
                            <?php echo $fetch['title']?>
                        </td>
                        <td>
                            <?php echo $fetch['description']?>
                        </td>
                        <td>
                            <?php if($fetch['status'] == 1){?>
                            <!-- if old active / new inacitve -->
                            <a href="view-news.php?id=<?php echo $fetch['id']?>&newstatus=0">
                                <button class="btn btn-primary">Active</button>
                            </a>
                            <?php }else{?>
                            <!-- if old inactive / new acitve -->
                            <a href="view-news.php?id=<?php echo $fetch['id']?>&newstatus=1">
                                <button class="btn btn-warning">Inactive</button>
                            </a>
                            <?php }?>
                        </td>
                        <td>
                            <?php echo $fetch['created_at']?>
                        </td>
                        <td>
                            <a href="add-news.php?id=<?php echo $fetch['id']?>">
                                <i class="text-primary fa fa-pen"></i>
                            </a>
                            <br />
                            <br />
                            <a href="view-news.php?id=<?php echo $fetch['id']?>">
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