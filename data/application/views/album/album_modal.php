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
      color: #337AB7;
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
    .load-more-wrapper{width: 100%; text-align: center; padding: 10px;}
    .image-default{
        max-width: 300px;
        height: 200px;
        float: left;
        padding: 5px;
        background-color: white;
        border-radius: 5px;
    }
    @media (min-width: 768px) {

        .h2class{ font-size: 18px; }
        .sub-header{ font-size: 14px; }

    }
    
    @media (min-width: 1000px){
        .container {
            width: 1235px;
        }
    }
    .btn-load-more {
        color: #fff;
        background-color: #337AB7;
        border-color: #337AB7;
        font-family: Montserrat, "Helvetica Neue", Helvetica, Arial, sans-serif;
        text-transform: none;
        border-radius: 3px;
    }
    
    .btn-load-more:hover {
        color: #fff !important;
        background-color: #31708F !important;
    }
    
    
</style>
<div class="margin-left-3-perc width-94-percent">
    <div class="margin-top-20"></div>
    <a class="mainLogo fl navbar-brand page-scroll" href="#page-top"><img class="" src="../root/img/main-logo-bare.png"></a>
    
    <div class="margin-left-15">
        <div class="fr">
            <a class="font-50 fa fa-times-circle-o fa-3x" title='Close' href="home#portfolio"></a>
        </div>
        <div class="clear"></div>
    </div>
</div>
    
<div class="margin-top-50"></div>
    <div class="margin-top-50">
        <div style='margin: 0 auto; width: 30%; text-align: center'>
            <h2 class='h2class'><?php echo $data->album->alb_name ?></h2>
            <p class="item-intro text-muted sub-header"><?php echo $data->album->alb_detail ?></p>
        </div>
        <div id="home" class="header">
            <div id="myCarousel" class="carousel slide bg-light-gray" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="container imageWrapper">
                            <?php
                                if($data->image_arr){
                                    $count = 0;
                                    foreach ($data->image_arr as $image) {
                                        $img = mo_file::decompress_image($image->img_data);
                                        echo "
                                            <a class='example-image-link' href='$img' data-lightbox='example-set'><img class='example-image image-default' src='$img' alt=''/></a>
                                        ";
                                    }
                                }

                            ?>
                        </div>
                    </div>
                </div>
                <div class="load-more-wrapper">
                    <div class="btn btn-load-more" page='1'>Load More...</div>
                </div>
            </div>
        </div>
        
    </div>
<?php include_once 'root/footer.php'; ?>
<script>
$(document).ready(function($){
    $("body").on("click", ".btn-load-more", function(){
        var new_page = parseInt($(this).attr('page'))+1;
        $(this).attr('page', new_page);
//        var form = $('#loginForm').serialize();
        $.ajax({
            type: 'POST',
            url: "album/xalbum_load_more?page="+new_page+"&alb_id=<?php echo $data->album->alb_id ?>",
            success: function(response){
                $('.imageWrapper').append(response);
            }
        });
    });
});
</script>