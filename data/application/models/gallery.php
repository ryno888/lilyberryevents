<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class gallery{
    
    public static function get_gallery_albums($sql_where = false, $options = []) {
        $options_arr = array_merge([
            "multiple" => true
        ],$options);
        $album_arr = db::get_fromdb("album", $sql_where, $options_arr);
        
        return $album_arr ? $album_arr : [];
    }
    //--------------------------------------------------------------------------
}

