<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class events {
    
    public static function get_nav_array(){
        return [
//            "Home:glyphicon glyphicon-home" => "home",
            "Gallery:glyphicon glyphicon-picture" => "album_list",
            "Requests:glyphicon glyphicon-envelope" => "request_list",
            "Logout:glyphicon glyphicon-log-out" => "logout"
        ];
    }
}

