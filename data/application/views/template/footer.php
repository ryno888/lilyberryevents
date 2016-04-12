<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $file = DIR_ERROR_FILE;
    $log = "";
    if(file_exists($file)){
        $base = $this->config->base_url();
        $log =  "<div class='errorDiv' style='z-index: 10000; position:fixed; padding: 10px; background-color: #31708F;'><button type='button' class=''><a target='_blank' href='$base/data/$file'>View Log</a></button><button type='button' class=' clearErrorBtn'>Clear</button></div>";
    }
    if(!property_exists($data, "hide_nav")){
?>

    <!--<em>&copy; 2015</em>-->
    <?php } ?>
        <script src="<?php echo (DIR_BOOTSTRAP_JS.'/jquery-1.11.3.min.js'); ?>"></script>
        <script src="<?php echo (DIR_BOOTSTRAP_JS.'/jquery-migrate-1.2.1.min.js'); ?>"></script>
        <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
        <script src="<?php echo (DIR_BOOTSTRAP_JS.'/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo (DIR_BOOTSTRAP_JS.'/components.js'); ?>"></script>
        
        
        <script src="<?php echo (DIR_BOOTSTRAP_JS.'/canvas-to-blob.js'); ?>"></script>
        <script src="<?php echo (DIR_BOOTSTRAP_JS.'/canvas-to-blob.min.js'); ?>"></script>
        <script src="<?php echo (DIR_BOOTSTRAP_JS.'/fileinput.js'); ?>"></script>
        <script src="<?php echo (DIR_BOOTSTRAP_JS.'/fileinput.min.js'); ?>"></script>
        <script src="<?php echo (DIR_BOOTSTRAP_JS.'/fileinput_locale_es.js'); ?>"></script>
        <script src="<?php echo (DIR_BOOTSTRAP_JS.'/fileinput_locale_LANG.js'); ?>"></script>
        <script>
            $('#errorLogDiv').html("<?php echo $log;  ?>");
        </script>
    </body>
</html>

