<?php
include "app/config.php";
include "app/helper.php";
include "layouts/header.php";
?>
<!-- right part of the middle portion starts here -->
<div class="middle-right enq-height">
	<div class="page-status">
		<h1>Enquiry</h1>
		<h2><i onclick='window.location.href = "index.php" '> Home /</i> Enquiry</h2>
	</div>
	<div class="mainwebsitecontent">
		<form id="enq-form">
			<div class="formrow">
				<div class="formlable">Gender : </div>
				<div class="inputform">
					<input type="radio" name="gender" id="male" class="" value="M" />Male
					<input type="radio" name="gender" id="female" class="" value="F" />Female
				</div>
			</div>
			<div class="formrow">
				<div class="formlable">Name : </div>
				<div class="inputform"><input type="text" name="name" id="name" class="inputbox" /></div>
			</div>
			<div class="formrow">
				<div class="formlable">Contact No : </div>
				<div class="inputform"><input type="text" name="contact" id="contact" class="inputbox" /></div>
			</div>
			<div class="formrow">
				<div class="formlable">Country : </div>
				<div class="inputform">
					<select name="country" id="country" onchange="getStates(this)">
						<option value="0">---Select---</option>
						<?php
						$selCountry = "SELECT * FROM countries WHERE status = 1 ORDER BY name ASC";
						$exeCountry = mysqli_query($conn, $selCountry);
						while ($fetchCountry = mysqli_fetch_assoc($exeCountry)) {
						?>
							<option value="<?php echo $fetchCountry['id'] ?>"><?php echo $fetchCountry['name'] ?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			<div class="formrow">
				<div class="formlable">State : </div>
				<div class="inputform">
					<select name="state" id="state" disabled>
						<option value="">---Please select a country first---</option>
					</select>
				</div>
				<img src="images/Loading_icon.gif" alt="" width="150px" id="loaderBox" style="display: none;">
			</div>
			<div class="formrow">
				<div class="formlable">Email : </div>
				<div class="inputform"><input type="text" name="email" id="email" class="inputbox" /></div>
			</div>
			<div class="formrow">
				<div class="formlable">Enquiry : </div>
				<div class="inputform"><textarea name="enquiry" id="enquiry" class="textarea"></textarea></div>
			</div>
			<div class="formrow">
				<div class="formlable">
					<input type="submit" value="Send" class="button" />
				</div>
			</div>
		</form>
	</div>
</div>
<!-- right part of the middle portion starts here -->
<div class="clear"></div>
</div>
<!-- middle portion with  links, new , banner and course ends here -->
<?php
include "layouts/footer.php";
?>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	function getStates(elem) {
		var cId = $(elem).val()
		$.ajax({
			url: "state-ajax.php",
			data: {
				country_id: cId
			},
			type: "get",
			beforeSend: function() {
				// $("#loaderBox").css({
				// 	display: "inline"
				// })
				$(elem).attr("disabled", true)
				$("#state").html("<option>Loading....</option>")
			},
			success: function(response) {
				$("#state").html(response).attr("disabled", false) //innerHTML
				// $("#loaderBox").css({
				// 	display: "none"
				// })
				$(elem).attr("disabled", false)
			}
		})
	}
</script>
<script>
	$("#enq-form").submit(
		function() {
			var formData = $("#enq-form").serialize()
			// console.log(formData)
			$.ajax({
				url: "enquiry-ajax.php",
				type: "post",
				data: formData,
				success: function(response) {
					var jsonResp = JSON.parse(response);
					if (jsonResp.status == 1) {
						// all okay
						$("#enq-form").trigger("reset")
						swal("Good job!", jsonResp.msg, "success");
					} else {
						// some error
						swal("Oops!", jsonResp.msg, "error");
					}
				}
			})
			return false
		}
	)
</script>