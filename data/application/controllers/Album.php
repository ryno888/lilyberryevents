<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Album extends CI_Controller {
    
    //--------------------------------------------------------------------------
    public function view($page = "add_album"){
        $data['data'] = $this->get_data($page);
        //load views
        $this->load->view("template/header", $data);
        $this->load->view("album/$page", $data);
        $this->load->view("template/footer", $data);
        
    }
    //--------------------------------------------------------------------------
    public function album_list(){
        //load views
        $this->data->search = $this->input->get_post('search');
        $this->data->page = $this->input->get_post('page');
        if(!$this->data->page) { $this->data->page = 1; }
        $total_emails = db::selectsingle("SELECT COUNT(alb_id) FROM album");
        $this->data->total_pages = ceil($total_emails/10);
        $offset = ($this->data->page-1) * 10;
        $this->data->gallery_arr = gallery::get_gallery_albums($this->data->search ? " alb_name LIKE '%{$this->data->search}%'" : false, ["limit" => 10, "offset" => $offset]);
        $data['data'] = $this->get_data("album_list");
        $this->load->view("template/header", $data);
        $this->load->view("album/album_list", $data);
        $this->load->view("template/footer", $data);
    }
    //--------------------------------------------------------------------------
    public function album_modal(){

        //load views
        $this->data->album = $this->get_from_db("album", true);
        $session_data = mo_session::get_from_session("stored_albums", $this->data->album->id);
        $total_images = db::selectsingle("SELECT COUNT(img_id) FROM image WHERE img_ref_album = {$this->data->album->alb_id}");
        if(!$session_data || ($total_images > count($session_data))){
            $session_data = mo_album::get_album_image_arr($this->data->album->id, [
                "limit" => 8,
                "offset" => 0,
            ]);
            mo_session::set_in_session($session_data, "stored_albums", $this->data->album->id);
        }
        
        $this->data->image_arr = $session_data;
        
        $data['data'] = $this->get_data("album_modal");
        $this->load->view("album/album_modal", $data);
    }
    //--------------------------------------------------------------------------
    public function xalbum_load_more(){

        //load views
        $limit = 4;
        $result = "";
        $page = $this->input->get_post('page');
        $alb_id = $this->input->get_post('alb_id');
        $image_arr = mo_album::get_album_image_arr($alb_id, [
            "limit" => $limit,
            "offset" => $limit * $page,
        ]);
        if($image_arr){
            foreach ($image_arr as $image) {
                $img = mo_file::decompress_image($image->img_data);
                $result .= "
                    <a class='example-image-link' href='$img' data-lightbox='example-set'><img class='example-image image-default' src='$img' alt=''/></a>
                ";
            }
        }
        
        echo "$result";
    }
    //--------------------------------------------------------------------------
    public function add_album(){

        //load views
        $data['data'] = $this->get_data("add_album");
        $this->load->view("template/header", $data);
        $this->load->view("album/add_album", $data);
        $this->load->view("template/footer", $data);
    }
    //--------------------------------------------------------------------------
    public function edit_album(){
        $data['data'] = $this->get_data("edit_album");
        
        $alb_id = $this->input->get_post('alb_id');
        $this->data->album = $this->get_from_db("album", $alb_id);
        $this->data->album_image_arr = db::get_fromdb("image", "img_ref_album = $alb_id", ["multiple" => true]);
        //load views
        $this->load->view("template/header", $data);
        $this->load->view("album/edit_album", $data);
        $this->load->view("template/footer", $data);
    }
    //--------------------------------------------------------------------------
    public function xadd_album(){
        $alb_name = $this->input->get_post('alb_name');
        $alb_detail = $this->input->get_post('alb_detail');
        $alb_is_visible = $this->input->get_post('alb_is_visible');
        $alb_id = mo_album::add_album([
            "alb_name" => $alb_name,
            "alb_detail" => $alb_detail,
            "alb_is_visible" => !$alb_is_visible || $alb_is_visible == 1 ? 1 : 0,
        ]);
        
        $file_arr = mo_file::get_uploaded_files();
        if(!empty($file_arr)){
            foreach ($file_arr as $file) {
                mo_file::insert_uploaded_file_in_db([
                    "file_name" => "image_".time().rand(1, 100),
                    "type" => $file['type'],
                    "tmp_name" => $file['tmp_name'],
                ], $alb_id);
            }
        }
        //load views
        $this->load->helper('url');
        header("Location: edit_album?alb_id=$alb_id"); /* Redirect browser */
        exit();
    }
    //--------------------------------------------------------------------------
    public function xedit_album(){
        $album = $this->get_from_db("album", true);
        $album->alb_name = $this->input->get_post('alb_name');
        $album->alb_detail = $this->input->get_post('alb_detail');
        $album->alb_is_visible = $this->input->get_post('alb_is_visible');
        db::update($album);
        $file_arr = mo_file::get_uploaded_files();
        if(!empty($file_arr)){
            foreach ($file_arr as $file) {
                mo_file::insert_uploaded_file_in_db([
                    "file_name" => "image_".time().rand(1, 100),
                    "type" => $file['type'],
                    "tmp_name" => $file['tmp_name'],
                ], $album->id);
            }
        }
        //load views
        $this->load->helper('url');
        header("Location: edit_album?alb_id=$album->id"); /* Redirect browser */
        exit();
    }
    //--------------------------------------------------------------------------
    public function xadd_image(){
        $alb_id = $this->input->get_post('alb_id');
        $file_arr = mo_file::get_uploaded_files();
        if(!empty($file_arr)){
            foreach ($file_arr as $file) {
                mo_file::insert_uploaded_file_in_db($file, $alb_id);
            }
        }
        //load views
        $this->load->helper('url');
        header("Location: edit_album?alb_id=$alb_id"); /* Redirect browser */
        exit();
    }
    //--------------------------------------------------------------------------
    public function xset_main_image(){
        $image = $this->get_from_db("image", true);
        $alb_id = $this->input->get_post('alb_id');
        $img_is_main = $this->input->get_post('img_is_main');
        
        if($img_is_main == 1){
            $image->img_is_main = $img_is_main == 0;
        }else{
            mo_album::unset_album_images($alb_id);
            $image->img_is_main = 1;
        }
        db::update($image);
        
        //load views
        $this->load->helper('url');
        header("Location: edit_album?alb_id=$alb_id"); /* Redirect browser */
        exit();
    }
    //--------------------------------------------------------------------------
    public function xdelete_album(){
        $album = $this->get_from_db("album", true);
        
        $image_arr = db::get_fromdb("image", "img_ref_album = {$album->id}", ['multiple' => true]);
        if($image_arr){
            db::delete_multiple($image_arr);
        }
        db::delete($album);
        //load views
        $this->load->helper('url');
        header("Location: album_list"); /* Redirect browser */
        exit();
    }
    //--------------------------------------------------------------------------
    public function xdelete_image(){
        $image = $this->get_from_db("image", true);
        db::delete($image);
        echo "true";
    }
    //--------------------------------------------------------------------------
    public function xclear_error(){
        
        if(file_exists(DIR_ERROR_FILE)){
            unlink(DIR_ERROR_FILE);
        }
    }
    //--------------------------------------------------------------------------
    public function get_data($page = "home"){
        //set up data
        $this->data->logo = DIR_IMAGES."text_image.png"; // Capitalize the first letter
        $this->data->page_title = ucfirst(str_replace("_", " ", $page)); // Capitalize the first letter
        $this->data->site_title = ucfirst(CR_SITE_NAME); // Capitalize the first letter
        $this->data->site_title_pipe = ucfirst(CR_SITE_NAME_PIPE); // Capitalize the first letter
        $this->data->nav_arr = events::get_nav_array(); // Capitalize the first letter
        return $this->data;
    }
    //--------------------------------------------------------------------------
    public function load_view($page = "home"){
        $this->load->view("template/header", $this->data);
        $this->load->view("index/$page", $this->data);
        $this->load->view("template/footer", $this->data);
    }
    //--------------------------------------------------------------------------
}