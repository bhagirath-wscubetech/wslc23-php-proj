<?php
include "../app/config.php";
include "../app/helper.php";
// error_reporting(E_ALL); 
// pagination variables
// 0 - 1 
// 1 - 2
// 2 - 3
// $page = $_GET['page'] ?? 0;
// // null safe operator
// $limit = 20;
// $start = $page * $limit;
// // --------------------

// $search = $_GET['search'] ?? "";


$id = $_GET['id'];
$status = $_GET['status'];
if (isset($id)) {
    if (isset($status)) {
        // update query
        // $qry1 = 'UPDATE news SET status = $status WHERE id = $id'; 
        $qry = "UPDATE states SET status = $status WHERE id = $id";
    } else {
        // delete query
        $qry = "DELETE FROM states WHERE id = $id";
    }
    try {
        mysqli_query($conn, $qry);
    } catch (Exception $err) {
    }
}
include "layouts/header.php";
?>
<!-- Content Wrapper -->
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">View News</h6>
        </div>

        <!-- <div class="card-header py-3">
            <form action="" method="get">
                <div class="row">
                    <div class="col-10">
                        <input type="text" name="search" class="form-control" placeholder="Search by state name" value="<?php echo $search ?>">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary" type="submit">Search</button>
                        <a href="view-state.php">
                            <button class="btn btn-warning" type="button">Clear</button>
                        </a>
                    </div>
                </div>
            </form>
        </div> -->

        <div class="card-body">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <td>Sr.</td>
                        <td>Name</td>
                        <td>Country Id</td>
                        <td>Status</td>
                        <td>Created At</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sel = "SELECT 
                            states.id as stateId, states.name as stateName, states.created_at as stateCreated, states.status as stateStatus, countries.id as countryId, countries.name as countryName
                             FROM states LEFT JOIN countries ON states.country_id = countries.id ORDER BY states.name ASC";
                    // echo  $sel;
                    $exe = mysqli_query($conn, $sel);
                    $i = 1;
                    while ($fetch = mysqli_fetch_assoc($exe)) {
                        // p($fetch);
                        // die;
                    ?>
                        <tr>
                            <td>
                                <?php echo $i ?>
                            </td>
                            <td>
                                <?php echo $fetch['stateName'] ?>
                            </td>
                            <td>
                                <?php echo $fetch['countryName'] ?>
                            </td>
                            <td>
                                <?php if ($fetch['stateStatus'] == 1) { ?>
                                    <!-- if old active / new inacitve -->
                                    <a href="view-state.php?id=<?php echo $fetch['stateId'] ?>&status=0&page=<?php echo $page ?>&search=<?php echo $search ?>">
                                        <button class="btn btn-primary">Active</button>
                                    </a>
                                <?php } else { ?>
                                    <!-- if old inactive / new acitve -->
                                    <a href="view-state.php?id=<?php echo $fetch['stateId'] ?>&status=1&page=<?php echo $page ?>&search=<?php echo $search ?>">
                                        <button class="btn btn-warning">Inactive</button>
                                    </a>
                                <?php } ?>
                            </td>
                            <td>
                                <?php echo $fetch['created_at'] ?>
                            </td>
                            <td>
                                <a href="add-state.php?id=<?php echo $fetch['stateId'] ?>&page=<?php echo $page ?>&search=<?php echo $search ?>">
                                    <i class="text-primary fa fa-pen"></i>
                                </a>
                                <br />
                                <br />
                                <a href="view-state.php?id=<?php echo $fetch['stateId'] ?>&page=<?php echo $page ?>&search=<?php echo $search ?>">
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
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>