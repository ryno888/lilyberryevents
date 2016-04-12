<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$active_user = mo_user::get_user();
?>
<html>
    <head>
        <title><?php echo $data->site_title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="<?php echo (DIR_BOOTSTRAP_CSS.'/bootstrap.css'); ?>" rel="stylesheet">
        <link href="<?php echo (DIR_BOOTSTRAP_CSS.'/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo (DIR_BOOTSTRAP_CSS.'/style.css'); ?>" rel="stylesheet">
        <link href="<?php echo (DIR_BOOTSTRAP_CSS.'/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
    </head>
    
    <body class="font-primary">
        <?php if(!property_exists($data, "hide_nav")){ ?>
            <nav class="navbar navbar-default">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Lily Berry Events</a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li class="<?php echo $data->view == "album_list" ? "active" : ""; ?>"><a href="album_list">Albums <span class="sr-only">(current)</span></a></li>
                  <li class='<?php echo $data->view == "request_list" ? "active" : ""; ?>'><a href="request_list">Emails</a></li>
<!--                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#">One more separated link</a></li>
                    </ul>
                  </li>-->
                </ul>
<!--                <form class="navbar-form navbar-left" role="search">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>-->
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="javascript:;"><?php echo $active_user ? "Hello $active_user->per_firstname" : "<span style='color:red;'>Unknown user being tracked!</span>" ?></a></li>
                  <li><a href="logout">Logout</a></li>
<!--                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="logout">Logout</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                    </ul>
                  </li>-->
                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>
        <?php } ?>
        
        <div class="jqmOverlay jqmCloseTarget" class="block"></div>
            <div class="jqmMessage jqmModal jqmCloseTarget">
                <div class="loginmodal-container">
                    <i class=" fr fa fa-times-circle cursor-pointer jqmClose"></i>
                    <div class="jqm-header font-primary font16 font-bold jqmMessageHeader">Login Details Incorrect</div><br>
                    <div class="jqm-message font-primary font12 jqmMessageBody">The username and password you have used is incorrect. Please try again.</div><br>
                </div>
            </div>
            <div class="jqmConfirm jqmModal jqmCloseTarget">
                <div class="loginmodal-container">
                    <i class=" fr fa fa-times-circle cursor-pointer jqmClose"></i>
                    <div class="jqm-header font-primary font16 font-bold jqmMessageHeader">Login Details Incorrect</div><br>
                    <div class="jqm-message font-primary font12 jqmMessageBody">The username and password you have used is incorrect. Please try again.</div><br>
                    <button type="button" class="btn btn-default submitButton">Ok</button>
                    <button type="button" class="btn btn-default jqmClose">Cancel</button>
                </div>
            </div>
            <div class="jqmPreviewImage jqmModal jqmCloseTarget">
                <div class="img-preview-modal-container">
                    <i class="margin-bottom-10 fr fa fa-times-circle cursor-pointer jqmClose"></i>
                    <img class='width-100-percent previewImageData' src=''/>
                </div>
            </div>
        </div>
        <div id="errorLogDiv" name='errorLogDiv' class="fl"></div>