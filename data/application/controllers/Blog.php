<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Blog extends CI_Controller {

	public function index()
	{
        $this->data->title = ucfirst("testing a page"); // Capitalize the first letter
        $this->data->my_name = "Ryno"; // Capitalize the first letter
		$this->load->view("Blog", $this->data);
	}
}