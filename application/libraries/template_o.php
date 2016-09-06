<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Template
	{
	  public function load_template($view_file_name,$data_array=array())
	  {
			$ci = &get_instance();
			/*$ci->load->view("public/upperpart");
			$ci->load->view("public/header");*/
			$ci->load->view($view_file_name,$data_array);
			$ci->load->view("public/lowerpart");
			}
	}
?>