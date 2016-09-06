<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Resources extends CI_Controller{
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
		public function PDF($slug)
		{
			$data_array['pdf']=$this->common->RA_get_data_by_slug('footer_pdf',$slug);
			if(!empty($data_array['pdf']))
			{
				$data_array['RA_all_pdf']=$this->common->RA_get_all_data('footer_pdf');
				$data_array['all_pdf']=$this->common->get_all_data_by_limit('footer_pdf',5);
				$this->template->load_template("public/resourcesPage",$data_array);
			}
			else{
				show_404();
			}
		}
	}
?>