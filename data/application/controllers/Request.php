<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Request extends CI_Controller {
    
    //--------------------------------------------------------------------------
    public function request_list(){
        //load views
        $this->data->page = $this->input->get_post('page');
        if(!$this->data->page) { $this->data->page = 1; }
        $total_emails = db::selectsingle("SELECT COUNT(com_id) FROM comm");
        $this->data->total_pages = ceil($total_emails/10);
        $offset = ($this->data->page-1) * 10;
        $this->data->comm_arr = db::get_fromdb("comm", false, ["multiple" => true, 'order_by' => "LIMIT 10 OFFSET $offset"]);
        $data['data'] = $this->get_data("request_list");
        $this->load->view("template/header", $data);
        $this->load->view("request/request_list", $data);
        $this->load->view("template/footer", $data);
    }
    //--------------------------------------------------------------------------
    public function view_request(){
        //load views
        $this->data->comm = $this->get_from_db("comm", true);
        $data['data'] = $this->get_data("view_request");
        $this->load->view("template/header", $data);
        $this->load->view("request/view_request", $data);
        $this->load->view("template/footer", $data);
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
    }//--------------------------------------------------------------------------
    public function xmark_email(){
        $page = $this->input->get_post('page');
        $comm = $this->get_from_db("comm", true);
        $com_status = $this->input->get_post('com_status');
        if($com_status == 2){
            $comm->com_status = 1;
        }else{
            $comm->com_status = 2;
        }
        db::update($comm);
        //load views
//        $this->load->helper('url');
//        header("Location: request_list?page=$page"); /* Redirect browser */
//        exit();
    }
    //--------------------------------------------------------------------------
}