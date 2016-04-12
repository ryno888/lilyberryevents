<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class browser{
    
    public static function redirect($url, $public = false){
        
        $controller = CI_Controller::get_instance();
        $controller->load->helper('url');
        $base_url = base_url();
        $folder = $public ? "root/" : "data/";
        header("Location: {$base_url}{$folder}{$url}"); /* Redirect browser */
        exit();
    }
    //--------------------------------------------------------------------------
    public static function get_base_url(){
        $controller = CI_Controller::get_instance();
        $controller->load->helper('url');
        return base_url();
    }
    //--------------------------------------------------------------------------
}

