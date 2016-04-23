<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class mo_session{
    
    //--------------------------------------------------------------------------
    public static function get_from_session($session_name, $key = false) {
        if($session_name){
            if(isset($_SESSION[$session_name]) && isset($_SESSION[$session_name][$key])){
                return $_SESSION[$session_name][$key];
            }else if(isset($_SESSION[$session_name])){
                return $_SESSION[$session_name];
            }
        }
        return false;
    }
    //--------------------------------------------------------------------------
    public static function set_in_session($data, $session_name, $key = false) {
        $_SESSION[$session_name][$key] = $data;
    }
    //--------------------------------------------------------------------------
}

