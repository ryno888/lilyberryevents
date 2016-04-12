<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class mo_user{
    //--------------------------------------------------------------------------
    public static function get_user(){
        $person = db::get_fromdb("person", "per_online = 1");
        return $person && isset($person[0]) ? $person[0] : false;
    }
    //--------------------------------------------------------------------------
    public static function set_user($person){
        $_SESSION["lily_user"] = $person;
    }
    //--------------------------------------------------------------------------
    public static function clear_user(){
        $person = mo_user::get_user();
        if($person){
            $person->per_online = 0;
            db::update($person);
        }
        $_SESSION["lily_user"] = false;
    }
    //--------------------------------------------------------------------------
    public static function validate_user(){
        if(!mo_user::get_user()){
            $CI =& get_instance();
            $CI->load->library('url');
            $url = base_url();
            header("Location: $url"); /* Redirect browser */
            exit();
        }
    }
	//--------------------------------------------------------------------------------
}

