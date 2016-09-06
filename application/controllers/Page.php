<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Page extends CI_Controller{
		public function __construct(){
			// Call the CI_Model constructor
                parent::__construct();
				$data_array['menus']=$this->common->get_menu_by_mid('menus',0);
				$data_array['submenus']=$this->common->get_submenu('menus',0);
				
				
				$lastSegment = $this->uri->total_segments();
				$pageSlug = $this->uri->segment($lastSegment);
				$data_array['seo_keywords']=$this->common->RA_get_data_by_slug('seo_meta',$pageSlug);
				
				$this->load->view("public/upperpart",$data_array);
				$this->load->view("public/header",$data_array);
				//echo "Dinesh URL".$this->uri->segment(3);
				
				$this->SEO();
		}
		private function SEO()
		{
			  $lastSegment = $this->uri->total_segments();
			  $record_num = $this->uri->segment($lastSegment);
			 // echo $record_num;
		}
		public function index()
		{
			//show_404();
		}
		public function load_page($FrontText,$slug)
		{
			$data_array['menu']=$this->common->RA_get_data_by_slug('menus',$slug);
			//echo "Dinesh URL".$this->uri->segment(2);
			if(!empty($data_array['menu']))
			{
			  $mid=$data_array['menu'][0]['id'];
			  $data_array['ql']=$this->common->RA_get_menu_by_mid('menus_quick_links',$mid);
			 // print_r($data_array['ql']);
			  $data_array['all_pdf']=$this->common->get_all_data_by_limit('footer_pdf',5);
			 $data_array['default_mn_bg']=$this->common->RA_get_data_by_id('home_page_our_services_background',1);
			  $this->template->load_template("public/menuPages",$data_array);
			}
			else{
				show_404();
			}
			
		}
		public function load_main_menu($slug)
		{
			$data_array['menu']=$this->common->RA_get_data_by_slug('menus',$slug);
			
			if(!empty($data_array['menu']))
			{
				$mid=$data_array['menu'][0]['id'];
				$data_array['ql']=$this->common->RA_get_menu_by_mid('menus_quick_links',$mid);
				
				$data_array['all_pdf']=$this->common->get_all_data_by_limit('footer_pdf',5);
				$data_array['default_mn_bg']=$this->common->RA_get_data_by_id('home_page_our_services_background',1);
				$this->template->load_template("public/menuPages",$data_array);
			}
			else{
				show_404();
			}
		}
		public function load_menu_quick_links($mm,$slug)
		{
			$data_array['menu']=$this->common->RA_get_data_by_slug('menus_quick_links',$slug);
			if(!empty($data_array['menu']))
			{
				$mid=$data_array['menu'][0]['mid'];
				$data_array['ql']=$this->common->RA_get_menu_by_mid('menus_quick_links',$mid);
				$data_array['mainMenu']=$this->common->RA_get_data_by_id('menus',$mid);
				$data_array['all_pdf']=$this->common->get_all_data_by_limit('footer_pdf',5);
				$data_array['default_mn_bg']=$this->common->RA_get_data_by_id('home_page_our_services_background',1);
				$this->template->load_template("public/menu_quick_link_page",$data_array);
			}
			else{
				show_404();
			}
		}
		
		public function load_key_offerings($slug)
		{
			$data_array['menu']=$this->common->RA_get_data_by_slug('home_page_key_offering',$slug);
			if(!empty($data_array['menu']))
			{
				$data_array['all_pdf']=$this->common->get_all_data_by_limit('footer_pdf',5);
				$data_array['default_mn_bg']=$this->common->RA_get_data_by_id('home_page_our_services_background',1);
				$data_array['other_offering']=$this->common->RA_get_all_data('home_page_key_offering');
				$this->template->load_template("public/key_offering",$data_array);
				
			}
			else{
				show_404();
			}
		}
		
		public function load_registration_services($slug)
		{
			$data_array['menu']=$this->common->RA_get_data_by_slug('home_page_registration_service',$slug);
			if(!empty($data_array['menu']))
			{
				$data_array['all_pdf']=$this->common->get_all_data_by_limit('footer_pdf',5);
				$data_array['default_mn_bg']=$this->common->RA_get_data_by_id('home_page_our_services_background',1);
				$data_array['other_offering']=$this->common->RA_get_all_data('home_page_registration_service');
				$this->template->load_template("public/registration_service",$data_array);
			}
			else{
				show_404();
			}
		}
		
	}
?>