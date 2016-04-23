<?php
    $file = DIR_ERROR_FILE;
    $log = "";
    if(file_exists($file)){
        $base = $this->config->base_url();
        $log =  "<div class='errorDiv' style='z-index: 10000; position:fixed; padding: 10px; background-color: #31708F;'><button type='button' class=''><a target='_blank' href='$base/data/$file'>View Log</a></button><button type='button' class=' clearErrorBtn'>Clear</button></div>";
    }
    //js
    $jquery_js = "$url/js/jquery.js";
    $bootstrap_min_js = "$url/js/bootstrap.min.js";
    $lightbox_js = "$url/js/lightbox.js";
    $components_js = "$url/js/components.js";
    
?>
<!-- jQuery -->

<script src="<?php echo $jquery_js; ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $bootstrap_min_js; ?>"></script>
<script src="<?php echo $lightbox_js; ?>"></script>
<script src="<?php echo $components_js; ?>"></script>
<script>
    $('#errorLogDiv').html("<?php echo $log;  ?>");
</script>
</body>
</html>
