<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Index extends CI_Controller {
    
    //--------------------------------------------------------------------------
    public function view($page = 'home'){
        //set up data
        if(strpos($page, "/")){
            $url_parts = explode("/", $page);
            $page = $url_parts[1];
        }
        $data['data'] = $this->get_data($page);
        
        //pages
        if($page == "xclear_error"){ $this->xclear_error(); }
        if($page == "xlogout"){ $this->xlogout(); }
        if($page == "xupload"){ $this->xupload(); }
        if($page == "login"){ $this->data->hide_nav = true; }
        if($page == "edit_album"){ $this->edit_album($this->data); }
        
        if ( !file_exists(APPPATH."/views/index/$page.php")){
            show_404();// show 404 on invalid requests
        }

        //load views
        $this->load->view("template/header", $data);
        $this->load->view("index/$page", $data);
        $this->load->view("template/footer", $data);
    }
    //--------------------------------------------------------------------------
    public function home(){

        //load views
        $data['data'] = $this->get_data("home");
        $this->load->view("template/header", $data);
        $this->load->view("index/home", $data);
        $this->load->view("template/footer", $data);
        
    }
    //--------------------------------------------------------------------------
    public function main_page(){

        //load views
        $data['data'] = $this->get_data("main_page");
        $this->load->view("index/main_page", $data);
        
    }
    //--------------------------------------------------------------------------
    public function login(){

        //load views
        $data['data'] = $this->get_data("login");
        
        $this->load->view("template/header", $data);
        $this->load->view("index/login", $data);
        $this->load->view("template/footer", $data);
        
    }
    //--------------------------------------------------------------------------
    public function xlogin(){
        $valid = "false";
        $per_username = $this->input->get_post('per_username');
        $per_password = $this->input->get_post('per_password');
        $person = db::get_fromdb("person", "per_username = '$per_username' AND per_password = '$per_password'");
        if($person && isset($person[0])){
            $person[0]->per_online = 1;
            db::update($person[0]);
            $valid = "true";
        }
        echo $valid;
    }
    //--------------------------------------------------------------------------
    public function xlogout(){
        mo_user::clear_user();
        $this->load->helper('url');
        $url = base_url();
        header("Location: $url"); /* Redirect browser */
        exit();
    }
    //--------------------------------------------------------------------------
    public function edit_album(&$data){
        $alb_id = $this->input->get_post('alb_id');
        $data->album = $this->get_from_db("album", $alb_id);
    }
    //--------------------------------------------------------------------------
    public function xclear_error(){
        
        if(file_exists(DIR_ERROR_FILE)){
            unlink(DIR_ERROR_FILE);
        }
    }
    //--------------------------------------------------------------------------
    public function xsend_mail(){
        $sender_name = $this->input->get_post('sender_name');
        $sender_email = $this->input->get_post('sender_email');
        $sender_tel = $this->input->get_post('sender_tel');
        $sender_text = $this->input->get_post('sender_text');
        
        
        $comm = db::get_default("comm");
        $comm->com_from = $sender_email;
        $comm->com_sender_name = $sender_name;
        $comm->com_sender_contactnr = $sender_tel;
        $comm->com_date_created = date::get_date();
        $comm->com_message = $sender_text;
        db::insert($comm);
        
        $email_text = "
            <table>
                <tr>
                    <td>Sender Name:</td>
                    <td>$sender_name</td>
                </tr>
                <tr>
                    <td>Sender Email Address:</td>
                    <td>$sender_email</td>
                </tr>
                <tr>
                    <td>Sender Tell:</td>
                    <td>$sender_tel</td>
                </tr>
                <tr>
                    <td>Message:</td>
                    <td>$sender_text</td>
                </tr>
            </table>
        ";
        
        mo_email::send_mail([
            "from" => $sender_email,
            "sender_name" => $sender_name,
            "message" => $email_text,
        ]);
        browser::redirect("index.php/home");
    }
    //--------------------------------------------------------------------------
    public function get_data($page = "home"){
        //set up data
        if($page == "login"){ $this->data->hide_nav = true; }
        $this->data->logo = DIR_IMAGES."text_image.png"; // Capitalize the first letter
        $this->data->page_title = ucfirst(str_replace("_", " ", $page)); // Capitalize the first letter
        $this->data->site_title = ucfirst(CR_SITE_NAME); // Capitalize the first letter
        $this->data->site_title_pipe = ucfirst(CR_SITE_NAME_PIPE); // Capitalize the first letter
        $this->data->nav_arr = events::get_nav_array(); // Capitalize the first letter
        return $this->data;
    }
    //--------------------------------------------------------------------------
    public function xstream_file(){
        $img_id = $this->input->get_post('img_id');
        $image = $this->get_from_db("image", $img_id);
        mo_file::base64_to_jpeg($image->img_data, "brrrrr.jpg");
        
        mo_stream::stream_fromfile($image->img_data);
    }
    //--------------------------------------------------------------------------
}