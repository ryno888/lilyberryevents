<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class mo_album{
    //--------------------------------------------------------------------------
    public static function add_album($options = []){
        
        $options_arr = array_merge([
            "alb_name" => "",
            "alb_detail" => false,
            "alb_date_created" => date::get_date(),
            "alb_is_visible" => 0,
        ],$options);
        
        $album = db::get_default("album");
        $album->alb_name = $options_arr['alb_name'];
        $album->alb_detail = $options_arr['alb_detail'];
        $album->alb_date_created = $options_arr['alb_date_created'];
        $album->alb_is_visible = $options_arr['alb_is_visible'];
        return db::insert($album);
    }
    //--------------------------------------------------------------------------
    public static function unset_album_images($alb_id){
        $images_arr = db::get_fromdb("image", "img_ref_album = $alb_id AND img_is_main = 1", ["multiple" => true]);
        if($images_arr){
            foreach ($images_arr as $image) {
                $image->img_is_main = 0;
                db::update($image);
            }
        }
    }
    //--------------------------------------------------------------------------
    public static function get_album_main_image($alb_id, $decompress = false){
        $result = db::selectsingle("
            SELECT img_data 
            FROM image 
            WHERE img_ref_album = $alb_id AND img_is_main = 1
        ");
        
        if(!$result){
            $result = db::selectsingle("
                SELECT img_data 
                FROM image 
                WHERE img_ref_album = $alb_id
            ");
        }
        
        if($result && $decompress){
            return mo_file::decompress_image($result);
        }else{
            return $result;
        }
    }
    //--------------------------------------------------------------------------
    public static function get_album_image_arr($alb_id){
        return db::get_fromdb("image", "img_ref_album = $alb_id", ["multiple" => true]);
    }
    //--------------------------------------------------------------------------
    public static function get_album_arr(){
        return db::get_fromdb("album", "alb_is_visible = 1", ["multiple" => true]);
    }
	//--------------------------------------------------------------------------------
}

