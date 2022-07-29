<?php
include "app/config.php";
include "app/helper.php";
include "layouts/header.php";
?>
<!-- right part of the middle portion starts here -->
<div class="middle-right">
    <div class="page-status">
        <h1>Gallery</h1>
        <h2><i onclick='window.location.href = "index.php" '> Home /</i> Gallery</h2>
    </div>
    <div class="gallery-content">
        <div class="galleryimgdiv" title="image1">
            <img src="gallery_img/1.jpg" width="225" height="170" alt="gallery" />
            <div class="gallery-img-title">Title 1</div>
        </div>
        <div class="galleryimgdiv" title="image2">
            <img src="gallery_img/2.jpg" width="225" height="170" alt="gallery" />
            <div class="gallery-img-title">Title 2</div>
        </div>
        <div class="galleryimgdiv" title="image3">

            <img src="gallery_img/3.jpg" width="225" height="170" alt="gallery" />
            <div class="gallery-img-title">Title 3</div>

        </div>
        <div class="galleryimgdiv" title="image4">

            <img src="gallery_img/4.jpg" width="225" height="170" alt="gallery" />
            <div class="gallery-img-title">Title 4</div>

        </div>
        <div class="galleryimgdiv" title="image5">

            <img src="gallery_img/5.jpg" width="225" height="170" alt="gallery" />
            <div class="gallery-img-title">Title 5</div>

        </div>
        <div class="galleryimgdiv" title="image6">

            <img src="gallery_img/6.jpg" width="225" height="170" alt="gallery" />
            <div class="gallery-img-title">Title 6</div>

        </div>
        <div class="galleryimgdiv" title="image7">
            <img src="gallery_img/7.jpg" width="225" height="170" alt="gallery" />
            <div class="gallery-img-title">Title 7</div>
        </div>
        <div class="galleryimgdiv" title="image8">

            <img src="gallery_img/8.jpg" width="225" height="170" alt="gallery" />
            <div class="gallery-img-title">Title 8</div>

        </div>
        <div class="galleryimgdiv" title="image9">

            <img src="gallery_img/9.jpg" width="225" height="170" alt="gallery" />
            <div class="gallery-img-title">Title 9</div>

        </div>

    </div>
</div>
<div class="clear"></div>
</div>
<!-- right part of the middle portion starts here -->
<!-- middle portion with  links, new , banner and course ends here -->
<?php
include "layouts/footer.php";
?>