<?php
	include "app/config.php";
	include "app/helper.php";
	include "layouts/header.php";
?>
<!-- right part of the middle portion starts here -->
<div class="middle-right">

	<div class="page-status">
		<h1>Contact</h1>
		<h2><i onclick='window.location.href = "index.php" '> Home /</i> Contact</h2>
	</div>
	<div class="contact-content">
		<div class="contact-row">
			<div class="contact-row-left">
				<img src="images/phone.png">
				<p><b>Phone:</b> 0291-2468122, +91-9269698122</p>
				<p> <b>Email ID:</b>
					<a href="http://www.iipacademy.com/" target="blank">
						<font style="color:#00a8ec; cursor: pointer;">info@iipacademy.com </font>
					</a>
				</p>
				<p> <b>Website:</b>
					<a href="http://www.iipacademy.com" target="blank">
						<font style="color:#00a8ec; cursor: pointer;">www.iipacademy.com </font>
					</a>
				</p>
			</div>
			<div class="contact-row-right">
				<img src="images/address-pin.png">
				<p>
					Ground Floor, Laxmi Tower, Bhaskar Circle, Ratanada, Jodhpur (Raj.)
				</p>
			</div>

		</div>
		<h1 style="color: #343130;">Find Us On Map</h1>
		<div class="contact-map">
			<img src="images/map.png" />
		</div>

	</div>
</div>
<!-- right part of the middle portion starts here -->
<div class="clear"></div>
</div>
<!-- middle portion with  links, new , banner and course ends here -->
<?php
	include "layouts/footer.php";
?>