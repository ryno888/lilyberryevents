<?php include_once 'root/header.php'; ?>
<style>
    html,
    body {
      font-family:'Open Sans', sans-serif;
      height: 100%;
      width: 100%;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family:'Open Sans', sans-serif;
    }
    h3, h4, h5 {
        font-family:'Raleway', sans-serif;
        font-weight: 350;
        margin-bottom: 30px;
    }

    p {
      font-size: 18px;
    }

    a {
      color: #8ebebc;
    }

    a:hover {
      text-decoration: none;
    }

    /* Special class on .container surrounding .navbar, used for positioning it into place. */
    .navbar-wrapper {
      position: absolute;
      top: 0;
      right: 0;
      left: 0;
      z-index: 20;
    }

    /* Flip around the padding for proper display in narrow viewports */
    .navbar-wrapper .container {
      padding-right: 0;
      padding-left: 0;
    }

    .navbar-wrapper .navbar {
      padding-right: 15px;
      padding-left: 15px;
    }


    .header {
      display: table;
      height: 100%;
      width: 100%;
      padding-top: 60px;
      background: #fff;
      position: relative;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }


    #myCarousel {
      width:100%;
      height:100%;
    }
    .carousel, .item, .active {
      height:100%;
    }
    .carousel-inner {
      height:100%;
    }
    .carousel {
      margin-bottom: 0;
    }

    .img-thumbnail {
        padding: 10px;
    }
    .post-box, .post-box2 , .post-box3 {
        margin: 10px 0 10px 0;
    }


    /**** Transitions for Masonry ****/

    .masonry {
      -webkit-transition-duration: 0.4s;
         -moz-transition-duration: 0.4s;
          -ms-transition-duration: 0.4s;
           -o-transition-duration: 0.4s;
              transition-duration: 0.4s;
      -webkit-transition-property: height, width;
         -moz-transition-property: height, width;
          -ms-transition-property: height, width;
           -o-transition-property: height, width;
              transition-property: height, width;
    }
    
    .h2class{ font-size: 14px; }
    .sub-header{ font-size: 12px; }

    @media (min-width: 768px) {

        .h2class{ font-size: 18px; }
        .sub-header{ font-size: 14px; }

    }
</style>
<div class="margin-left-3-perc width-94-percent">
    <div class="margin-top-20"></div>
    <a class="mainLogo fl navbar-brand page-scroll" href="#page-top"><img class="" src="../root/img/main-logo-bare.png"></a>
    
    <div class="margin-left-15">
        <div class="fr">
            <a class="font-50 fa fa-angle-up fa-5x" title='Close' href="home#portfolio"></a>
        </div>
        <div class="clear"></div>
    </div>
</div>
    
<div class="margin-top-50"></div>
<!--    <div style='padding: 5px'>
        <button onclick="location.href = 'home#portfolio';" class="btn btn-style"><i class="fa fa-times"></i> Back to Site</button>
    </div>-->
    <div class="margin-top-50">
        <div style='margin: 0 auto; width: 30%; text-align: center'>
            <h2 class='h2class'>Project Name</h2>
            <p class="item-intro text-muted sub-header">Lorem ipsum dolor sit amet consectetur.</p>
        </div>
        <div id="home" class="header">
	    <div id="myCarousel" class="carousel slide bg-light-gray" data-ride="carousel">
        	<div class="carousel-inner">
	            <div class="item active">
			    	<div class="container">
                        <?php
                            if($data->image_arr){
                                foreach ($data->image_arr as $image) {
                                    $img = mo_file::decompress_image($image->img_data);
                                    echo "
                                        <div class='post-box col-lg-4 col-md-4 col-sm-4'> 
                                            <img class='cursor-pointer previewImage img-responsive img-thumbnail' src='$img'>
                                        </div>
                                    ";
                                }
                            }
                        
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once 'root/footer.php'; ?>

<!-- jQuery -->
<script src="<?php echo $jquery_js; ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $bootstrap_min_js; ?>"></script>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?php echo $classie_js; ?>"></script>
<script src="<?php echo $cbpAnimatedHeader_js; ?>"></script>

<!-- Contact Form JavaScript -->
<script src="<?php echo $jqBootstrapValidation_js; ?>"></script>
<script src="<?php echo $contact_me_js; ?>"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo $agency_js; ?>"></script>
<script src="<?php echo $components_js; ?>"></script>