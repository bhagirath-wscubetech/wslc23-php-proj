<?php
include "app/config.php";
include "app/helper.php";
include "layouts/header.php";
?>
<!-- right part of the middle portion starts here -->
<div class="middle-right">
	<div class="page-status">
		<h1>Courses</h1>
		<h2><i onclick='window.location.href = "index.php" '> Home /</i> Courses</h2>
	</div>
	<div class="course-content">
		<?php
			$selCour = "SELECT * FROM courses WHERE status = 1 ORDER BY name ASC";
			$exeCour = mysqli_query($conn,$selCour);
			while($fetchCour = mysqli_fetch_assoc($exeCour)):
				$color = $fetchCour['color'];
		?>
		<div class="course-1">
			<div class="course-1-icon" style="background: <?php echo $color?> !important;">
				<div class="icon-1">
					<img src="images/courses/<?php echo $fetchCour['image']?>">
				</div>
			</div>

			<div class="c-1" style="border-color: <?php echo $color?> !important;color: <?php echo $color?> !important;">
				<?php echo $fetchCour['name']?>
			</div>
		</div>
		<?php
			endwhile;
		?>
	</div>
</div>
<!-- right part of the middle portion starts here -->
<div class="clear"></div>
</div>
<!-- middle portion with  links, new , banner and course ends here -->
<?php
	include "layouts/footer.php";
?>