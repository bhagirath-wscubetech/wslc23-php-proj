<?php
include "app/config.php";
include "app/helper.php";
$id = $_GET['id'];
if (isset($id)) {
    $selSingleNews = "SELECT * FROM news WHERE id = $id AND status = 1";
    $exeSingleNews = mysqli_query($conn, $selSingleNews);
    $fetchSingleNews = mysqli_fetch_assoc($exeSingleNews);
    $metaTitle = $fetchSingleNews['meta_title'];
    $metaDescription = $fetchSingleNews['meta_description'];
    if (!isset($fetchSingleNews['id'])) {
        header("LOCATION:404.php");
    }
}
include "layouts/header.php";
?>
<!-- right part of the middle portion starts here -->
<div class="middle-right">
    <div class="page-status">
        <h1><?php echo $fetchSingleNews['title'] ?></h1>
        <h2><i onclick='window.location.href = "index.php" '> Home /</i> Read News:</h2>
    </div>
    <div class="about-content">
        <?php echo $fetchSingleNews['description'] ?>
    </div>
</div>
<!-- right part of the middle portion starts here -->
<div class="clear"></div>
</div>
<!-- middle portion with  links, new , banner and course ends here -->

<?php
include "layouts/footer.php";
?>