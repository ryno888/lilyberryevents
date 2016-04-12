<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class mo_email{
    
    //--------------------------------------------------------------------------
    public static function send_mail($options = []){
        $CI =& get_instance();
        $CI->load->library('email');
        $options_arr = array_merge([
            "from" => "System",
            "sender_name" => "Lilly Berries System",
            "message" => "",
        ],$options);
        
        $config['protocol'] = EMAIL_PROTOCOL;
        $config['smtp_host'] = EMAIL_HOST;
        $config['smtp_port'] = EMAIL_PORT;
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = EMAIL_USERNAME;
        $config['smtp_pass'] = EMAIL_PASSWORD;
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      
//        $CI->email->set_mailtype('html');
//        $CI->email->mailtype = 'html';
        $CI->email->initialize($config);
        
        $CI->email->from($options_arr['from'], $options_arr['com_sender_name']);
        $CI->email->to(EMAIL_ADDRESS); 
        $CI->email->subject('Email Test');
        $CI->email->message($options_arr['message']);  
        $CI->email->send();
    }
    //--------------------------------------------------------------------------
}

