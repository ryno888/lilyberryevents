<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class mo_html{
    
    //--------------------------------------------------------------------------
    public static function get_nav($options = []) {
        $options_arr = array_merge([
           "save_button" => false,
           "return_button" => false,
           "pagination" => false,
        ],$options);
        
        $html = "<nav class='pull-left padding-panel'>";
        
        if($options_arr['return_button']){
            $html .= "<button type='button' onclick=\"location.href = '{$options_arr['return_button']}';\" class='btn btn-default margin-left-5'><span class='glyphicon glyphicon-chevron-left'></span> Back to Gallery</button>";
        }
        if($options_arr['save_button']){
            $html .= "<button type='submit' class='validateForm btn btn-default margin-left-5'><span class='glyphicon glyphicon-floppy-saved'></span> Save</button>";
        }
        
        $html .= "</nav>";
        return $html;
    }
    //--------------------------------------------------------------------------
    public static function get_file_uploader($options = []) {
        $options_arr = array_merge([
           "label" => "Select File",
           "add_upload_button" => false,
           "add_remove_button" => true,
        ],$options);
        
        $label = $options_arr['label'] !== false ? "<label class='control-label font-primary'>{$options_arr['label']}</label>" : "";
        return "
            $label
            <input class='form-control' id='input-4' name='input4[]' type='file' multiple class='file-loading' data-show-upload='{$options_arr['add_upload_button']}' data-show-remove='{$options_arr['add_remove_button']}'>
        ";
    }
    //--------------------------------------------------------------------------
    public static function get_pagination($pages_count = 0, $options = []) {
        $options_arr = array_merge([
           "url" => false,
           "current_page" => 1
        ],$options);
        
        
        if($pages_count == 0){ return false; }
        
        $pages_html = "";
        for($i=1; $i <= $pages_count; $i++){
            $active = $options_arr['current_page'] == $i ? "background-color: #D8D4E8;" : "";
            $pages_html .= "<li><a style='$active' href='{$options_arr['url']}?page=$i'>$i</a></li>";
        }
        
        $next_page = $options_arr['current_page'] + 1;
        $previous_page = $options_arr['current_page'] - 1;
        if($previous_page <= 0){
            $previous_page = 1;
        }
        if($next_page >= $pages_count){
            $next_page = $pages_count;
        }
        
        return "
            <div class='pull-left'>
                <ul class='pagination'>
                    <li>
                        <a href='{$options_arr['url']}?page=$previous_page' aria-label='Previous'>
                            <span aria-hidden='true'><</span>
                        </a>
                    </li>
                    $pages_html
                    <li>
                        <a href='{$options_arr['url']}?page=$next_page' aria-label='Next'>
                            <span aria-hidden='true'>></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class='clear'></div>
        ";
    }
    //--------------------------------------------------------------------------
}

