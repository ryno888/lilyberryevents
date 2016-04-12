<?php  
    //main image
    $main_path = "../root/img";

?>

<nav class="navbar navbar-default navbar-fixed-top ">
    <div class="container">
        <a class="mainLogo fl navbar-brand page-scroll" href="#page-top"><img class='' src="<?php echo $main_path; ?>/main-logo-bare.png" /></a>

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand page-scroll" href="#page-top"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="fr collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="#services"><img class="nav-text-image" src="<?php echo $main_path; ?>/text_imgage.png" />Services</a>
                </li>
                <li>
                    <a class="page-scroll" href="#portfolio"><img class="nav-text-image" src="<?php echo $main_path; ?>/text_imgage.png" />Portfolio</a>
                </li>
<!--                <li>
                    <a class="page-scroll" href="#about"><img class="nav-text-image" src="<?php // echo $main_path; ?>/text_imgage.png" />About</a>
                </li>-->
<!--                    <li>
                    <a class="page-scroll" href="#team">Team</a>
                </li>-->
                <li>
                    <a class="page-scroll" href="#contact"><img class="nav-text-image" src="<?php echo $main_path; ?>/text_imgage.png" />Contact</a>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
        <!-- /.navbar-collapse -->
    </div>
        <!-- /.container-fluid -->
</nav>
