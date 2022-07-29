<?php 
include "../app/config.php";
include "../app/helper.php";

// pagination variables
// 0 - 1 
// 1 - 2
// 2 - 3
$page = $_GET['page'] ?? 0;
// null safe operator
$limit = 50;
$start = $page * $limit;
// --------------------

$search = $_GET['search'] ?? "";


$id = $_GET['id'];
$status = $_GET['status'];
if(isset($id)){
    if(isset($status)){
       // update query
        // $qry1 = 'UPDATE news SET status = $status WHERE id = $id'; 
        $qry = "UPDATE countries SET status = $status WHERE id = $id"; 
    }else{
        // delete query
        $qry = "DELETE FROM countries WHERE id = $id";
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

        <div class="card-header py-3">
            <form action="" method="get">
                <div class="row">
                    <div class="col-10">
                        <input type="text" name="search" class="form-control" placeholder="Search by country name"
                            value="<?php echo $search?>">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary" type="submit">Search</button>
                        <a href="view-country.php">
                            <button class="btn btn-warning" type="button">Clear</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <td>Sr.</td>
                        <td>Name</td>
                        <td>Status</td>
                        <td>Created At</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // $sel = "SELECT * FROM news ORDER BY id ASC";
                        if($search != ""){
                            // searching
                            $sel = "SELECT * FROM countries WHERE name LIKE '%$search%' ORDER BY name ASC";
                        }else{
                            $sel = "SELECT * FROM countries ORDER BY name ASC LIMIT $start,$limit";
                        }
                        echo  $sel;
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
                            <?php if($fetch['status'] == 1){?>
                            <!-- if old active / new inacitve -->
                            <a
                                href="view-country.php?id=<?php echo $fetch['id']?>&status=0&page=<?php echo $page?>&search=<?php echo $search?>">
                                <button class="btn btn-primary">Active</button>
                            </a>
                            <?php }else{?>
                            <!-- if old inactive / new acitve -->
                            <a
                                href="view-country.php?id=<?php echo $fetch['id']?>&status=1&page=<?php echo $page?>&search=<?php echo $search?>">
                                <button class="btn btn-warning">Inactive</button>
                            </a>
                            <?php }?>
                        </td>
                        <td>
                            <?php echo $fetch['created_at']?>
                        </td>
                        <td>
                            <a
                                href="add-country.php?id=<?php echo $fetch['id']?>&page=<?php echo $page?>&search=<?php echo $search?>">
                                <i class="text-primary fa fa-pen"></i>
                            </a>
                            <br />
                            <br />
                            <a
                                href="view-country.php?id=<?php echo $fetch['id']?>&page=<?php echo $page?>&search=<?php echo $search?>">
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
            <!-- Pagination -->
            <?php
                if($search == "") :
                    $selAll = "SELECT * FROM countries";
                    $exeAll = mysqli_query($conn,$selAll);
                    $count = mysqli_num_rows($exeAll);
                    $noOfPages = ceil($count/$limit);
            ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <?php
                            for($i=0;$i<$noOfPages;$i++):
                                // echo $i;
                        ?>
                    <li class="page-item <?php echo $i==$page ? 'active' : '' ?>">
                        <a class="page-link" href="view-country.php?page=<?php echo $i ?>">
                            <?php echo $i+1; ?>
                        </a>
                    </li>
                    <?php
                            endfor;
                        ?>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
            <?php  
                endif;
            ?>
        </div>
    </div>

</div>
<!-- End of Main Content -->
<?php include "layouts/footer.php"; ?>