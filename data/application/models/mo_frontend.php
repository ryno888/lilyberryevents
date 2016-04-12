<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class mo_frontend{
    //--------------------------------------------------------------------------
    public static function get_data($options = []){
        
        $options_arr = array_merge([
            "alb_name" => "",
            "alb_detail" => false,
            "alb_date_created" => date::get_date(),
            "alb_is_visible" => 0,
        ],$options);
        
        
        $image_arr = mo_album::get_album_arr();
    }
	//--------------------------------------------------------------------------------
}

