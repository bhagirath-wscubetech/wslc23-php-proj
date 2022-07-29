<?php
include "../app/config.php";
include "../app/helper.php";
$enqId = $_GET['id'];
$newStatus = $_GET['newstatus'];
if (isset($enqId)) {
    if (isset($newStatus)) {
        // update query
        // $qry1 = 'UPDATE news SET status = $newStatus WHERE id = $newsId'; 
        $qry = "UPDATE enquiries SET status = $newStatus WHERE id = $enqId";
    }
    try {
        mysqli_query($conn, $qry);
    } catch (Exception $err) {
    }
}
include "layouts/header.php";
?>
<!-- Content Wrapper -->


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">View Enquiry</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <td>Sr.</td>
                        <td>Details</td>
                        <td width="40%">Enquiry</td>
                        <td>Address</td>
                        <td>Status</td>
                        <td>Created At</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // $sel = "SELECT * FROM news ORDER BY id ASC";
                    $sel = "SELECT * FROM enquiries ORDER BY id DESC";
                    $exe = mysqli_query($conn, $sel);
                    $i = 1;
                    while ($fetch = mysqli_fetch_assoc($exe)) {
                        // p($fetch);
                    ?>
                        <tr>
                            <td>
                                <?php echo $i ?>
                            </td>
                            <td>
                                Name: <?php echo $fetch['name'] ?>
                                <br />
                                Email: <?php echo $fetch['email'] ?>
                                <br />
                                Contact: <?php echo $fetch['contact'] ?>
                            </td>
                            <td>
                                <?php echo $fetch['enquiry'] ?>
                            </td>
                            <td>
                                Country: <?php echo $fetch['country_id'] ?>
                                <br />
                                State: <?php echo $fetch['state_name'] ?>
                            </td>
                            
                            <td>
                                <?php if ($fetch['status'] == 1) { ?>
                                    <!-- if old active / new inacitve -->
                                    <a href="view-enquiry.php?id=<?php echo $fetch['id'] ?>&newstatus=0">
                                        <button class="btn btn-primary">Replied</button>
                                    </a>
                                <?php } else { ?>
                                    <!-- if old inactive / new acitve -->
                                    <a href="view-enquiry.php?id=<?php echo $fetch['id'] ?>&newstatus=1">
                                        <button class="btn btn-warning">Pending</button>
                                    </a>
                                <?php } ?>
                            </td>
                            <td>
                                <?php echo $fetch['created_at'] ?>
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