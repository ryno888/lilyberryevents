<?php
    //css
    $url = '../root';
    $main_path = "$url/img";
    
    $bootstrap_min_css = "$url/css/bootstrap.min.css";
    $agency_css = "$url/css/agency.css";
    $styles_css = "$url/css/styles.css";
    $font_awesome_min_css = "$url/font-awesome/css/font-awesome.min.css";
    
    //js
    $jquery_js = "$url/js/jquery.js";
    $bootstrap_min_js = "$url/js/bootstrap.min.js";
    $classie_js = "$url/js/classie.js";
    $cbpAnimatedHeader_js = "$url/js/cbpAnimatedHeader.js";
    $jqBootstrapValidation_js = "$url/js/jqBootstrapValidation.js";
    $contact_me_js = "$url/js/contact_me.js";
    $agency_js = "$url/js/agency.js";
    $components_js = "$url/js/components.js";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lily Berry Events</title>
    
    <link rel="shortcut icon" type="image/png" href="<?php echo $main_path ?>/text_imgage.png"/>
    <link rel="shortcut icon" type="image/png" href="<?php echo $main_path ?>/text_imgage.png"/>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $bootstrap_min_css; ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo $agency_css; ?>" rel="stylesheet">
    <link href="<?php echo $styles_css; ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo $font_awesome_min_css; ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

</head>

<body id="page-top" class="index">
    <div class="jqmOverlay jqmCloseTarget" class="block"></div>
    <div class="jqmPreviewImage jqmModal jqmCloseTarget jqmPreviewModal">
        <div class="img-preview-modal-container">
            <i class="margin-bottom-10 fr fa fa-times-circle cursor-pointer jqmClose"></i>
            <img class='width-100-percent previewImageData' src=''/>
        </div>
    </div>
