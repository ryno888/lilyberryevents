<?php
    //css
    $url = '../root';
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
    
    //main image
    $main_path = "$url/img";
    $base_url = browser::get_base_url();
    $album_arr = mo_album::get_album_arr();
    
?>

<!DOCTYPE html>
<?php include_once '../data/root/header.php'; ?>
    <!-- Navigation -->
    <?php include_once '../data/root/nav.php'; ?>
    <!-- Header -->
    <header>
        <div class="mainImge">
            <div class="container"></div>
            <div class="intro-text">
<!--                <div class="intro-lead-in text-bold">Lily Berry Events</div>
                <div class="intro-quote customFont-h3">
                    "Rain is no bummer
                    When autumn comes, we gather loved ones                                                                    
                    In winter time, cuddle is no crime                                                                              
                    When spring arrives, the flowers thrive                                                                       
                    No matter what time of the year it is, there is always a time to gather awesome 
                    family & friends" <br/>– Lily Berry Events -
                </div>-->
                <!--<a href="#services" class="page-scroll btn btn-xl btn-style">Tell Me More</a>-->
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services</h2>
                </div>
            </div>
            <div class="row text-center">
                
                <div class="col-md-4 font-15">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-heart fa-stack-1x fa-inverse"></i>
                    </span>
                    
                     <div>
                        <h4 class="service-heading">Weddings</h4>
                        <p class="text-muted services-text">Browse through our stunning wedding packages to help you plan the most beautiful day of your life.
                            <br/><em>Contact us for a more detailed description on available packages</em>
                        </p>
                        <!--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Simple collapsible</button>-->
                        <a class="cursor-pointer" data-toggle="collapse" data-target="#demo">
                            <i class="fa fa-arrow-down collapseText">
                                <span class="text-muted collapse-style packageLabel sub-heading">View Packages</span>
                            </i>
                        </a>
                        <div id="demo" class="collapse">
                            <p class="text-secondary services-text">
                                <br/><span class='label-style sub-heading'>Lily Wedding Package (On-the-day Coordination): </span>Meeting with the Bridal Couple one month before the wedding day to discuss all aspects about the wedding day. On the day of the wedding there will be thorough supervision &amp; coordination of all the proceedings from start to finish.
                                <br/><span class='label-style sub-heading'>Berry Wedding Package (Customized Wedding Package): </span>For couples that only require partial planning of their wedding day. Couples will have the opportunity to choose the services they wish Lily Berry Events need to organise for their wedding.
                                <br/><span class='label-style sub-heading'>Lily Berry Wedding Package (Full Wedding Package): </span>Complete planning, sourcing, correspondence &amp; coordination of your wedding day from start to finish.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 font-15">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-birthday-cake fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Parties</h4>
                    <p class="text-muted services-text">Celebrate your special moments with the friends and family that brings it all together. Each party is exclusively planned to deliver the best experience for the guests. Packages can be tailored according to your specifications.</p>
                </div>
                <div class="col-md-4 font-15">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-glass fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Special Events</h4>
                    <p class="text-muted services-text">Have a package tailor-made to create any exceptional event, whether it is a corporate event or a family celebration. Spoil yourself with the creative and personal services you deserve.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid Section -->
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Portfolio</h2>
                    <!--<h3 class="section-subheading text-muted">View albums of recent projects</h3>-->
                </div>
            </div>
            <div class="row">
                <?php
                    if($album_arr){
                        foreach ($album_arr as $album) {
                            $date = date::get_date($album->alb_date_created, date::$DATE_FORMAT_4);
                            $img = mo_album::get_album_main_image($album->id, true);
                            echo "
                                <div class='col-md-4 col-sm-6 portfolio-item'>
                                    <a href='album_modal?alb_id=$album->alb_id' class='portfolio-link portfolioModal'>
                                        <div class='portfolio-hover'>
                                            <div class='portfolio-hover-content'>
                                                <i class='fa fa-plus fa-3x'></i>
                                            </div>
                                        </div>
                                        <img src='$img' class='img-responsive' alt=''>
                                    </a>
                                    <div class='portfolio-caption'>
                                        <h4>$album->alb_name</h4>
                                    </div>
                                </div>
                                
                            ";
                        }
                    }
                    
                ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="contactImage">
            <div class="colorFaded padding150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Contact Us</h2>
                        <h3 class="section-subheading text-muted">Send us an email and we will get back to you as soon as possible.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form name="sentMessage" id="contactForm" novalidate action="send_mail" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="sender_name" name="sender_name" type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input id="sender_email" name="sender_email" type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input id="sender_tel" name="sender_tel" type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea id="sender_text" name="sender_text" class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-xl">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <a href="http://www.littlepinkbook.co.za/2015/10/lily-berry-events/" target="_blank"><img src="http://www.littlepinkbook.co.za/wp-content/themes/littlepinkbook/images/logo_top_2.gif" width="150" alt="Celebration.co.za" border="0"></a>
                    <a href="http://www.celebration.co.za/weddings/wedding-planners/lily-berry-events/" target="_blank"><img src="http://www.celebration.co.za/members/member-logo.png" width="150" alt="Celebration.co.za" border="0"></a>
                    <a href="http://trouinspirasie.co.za/diens/ko-ordineerders/lily-berry-events/" target="_blank"><img alt="Trou Inspirasie" src="<?php echo $GLOBALS['CFG']->config['base_url'] ?>/files/images/trou_inspirasie.jpg" width="120"  /></a>
                    <a href="http://www.saweddings.co.za/event-planning-17/wedding-coordinator-18/lily-berry-events--05ae2a7e-51a7-11e6-b308-0a13b1a821cd" target="_blank"><img alt="Wednew" src="<?php echo $GLOBALS['CFG']->config['base_url'] ?>/files/images/wednew.jpg" width="120"  /></a>
                    
                    
                    <!--<a href="http://directory.theprettyblog.com/listing/55bb31fd4a7c300300404bea" target="_blank" alt="The Pretty Blog"><img alt="I'm Inspired by The Pretty Blog" src="https://s3.amazonaws.com/prettycdn/badges/Badges_TPB_love_01.png" width="150"  /></a>-->
                </div>
                <div class="col-md-4 margin-top-20">
                    <ul class="list-inline social-buttons">
                        <li>
                            <a target="_blank" href="https://www.facebook.com/lilyberryevents">
                                <i class="fa fa-facebook iconSpacing"></i>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://za.linkedin.com/in/leonellevanderberg">
                                <i class="fa fa-linkedin iconSpacing"></i>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://za.pinterest.com/lilyberryevents/">
                                <i class="fa fa-pinterest iconSpacing"></i>
                            </a>
                        </li>
                    </ul>
                    </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="../index.php/login">Admin Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
        </footer>

    
    <div class="jqmOverlay jqmCloseTarget" class="block"></div>
    <div class="jqmMessage jqmModal jqmCloseTarget">
        <div class="messagemodal-container">
            <i class=" fr fa fa-times-circle cursor-pointer jqmClose"></i>
            <div class="jqm-header font-primary font16 font-bold jqmMessageHeader">Email Successfully Sent</div><br>
            <div class="jqm-message font-primary font12 jqmMessageBody">Thank you for your email. We will be in contact soon.</div><br>
        </div>
    </div>
    
   

</body>
<?php include_once './root/footer.php'; ?>