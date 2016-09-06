<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
	public function __construct(){
			// Call the CI_Model constructor
                parent::__construct();
				$data_array['menus']=$this->common->get_menu_by_mid('menus',0);
				$data_array['submenus']=$this->common->get_submenu('menus',0);
				$this->load->view("public/upperpart");
				$this->load->view("public/header",$data_array);
		}
	public function index()
	{
		$data_array='';
		//$this->load->model('home_model');
		$data_array['slider_result']=$this->common->get_all_data('home_page_slider');
		$data_array['home_body']=$this->common->get_all_data('home_page');
		$data_array['other_offering']=$this->common->get_all_data('home_page_key_offering');
		$data_array['registration_services']=$this->common->get_all_data('home_page_registration_service');
		$data_array['all_pdf']=$this->common->get_all_data_by_limit('footer_pdf',5);
		$data_array['bgi']=$this->common->get_all_data('home_page_our_services_background');
		$data_array['os']=$this->common->get_all_data('home_page_our_services');
		$data_array['testimonials']=$this->common->get_all_data('home_page_testimonials');
		
		$this->template->load_template("public/index",$data_array);
	}
	public function subscribe()
	{
		$email = $this->security->xss_clean($this->input->post('subs'));
		if(!empty($email))
		{
		  
		  $data=array(
			  'email'=>$email,
			  'S_date'=>date('Y-m-d')
		  );
		  
		  $this->common->insert_data('footer_subscriber',$data);
		  redirect('home');
		}
		else{
			redirect('home');
		}
	}
}

?>