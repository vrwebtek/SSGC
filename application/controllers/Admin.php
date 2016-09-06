<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin extends CI_Controller{
		
		public function __construct(){
			// Call the CI_Model constructor
                parent::__construct();
				
				/*
					Whenever admin part is called this constructor will check the login details in session
					if session contains the login details then no error else it will redirect to login view.
				*/
				if($this->session->userdata('user_id'))
				{
					//do nothing
					$counter=0;
					$data_array['submenus']="";
					$data_array['menus']=$this->common->get_menu_by_mid('menus',0);
					$data_array['submenus']=$this->common->get_submenu('menus',0);
					/*foreach($data_array['menus'] as $mn)
					{
						$data_array['submenus']=$this->common->get_menu_by_mid('menus',$mn->id);
					}*/
					
					//echo "<pre>";
					//print_r($data_array['submenus']);
					
					//echo "<pre>";
					//print_r($data_array['submenus']);
					$this->load->view("admin/header",$data_array);
				}
				else{
					$this->login();
					
				}
		}
		public function index()
		{
			$this->login();
		}
		public function login()
		{
			$this->load->view('admin/login');
			
		}
		public function authenticate(){
			//$this->load->helper(array('form', 'url')); already loaded
            //$this->load->library('form_validation'); already loaded
			$this->form_validation->set_rules('user', 'Username', 'required');
			$this->form_validation->set_rules('pass', 'Password', 'required');
			if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('admin/login');
                }
                else
                {
					//XSS cleaning 
					$user = $this->security->xss_clean($this->input->post('user'));
					$pass = $this->security->xss_clean($this->input->post('pass'));
					$this->load->model('user');
					$login_id=$this->user->check_user($user,$pass);
					
					if($login_id)
					{
						//$this->load->library('session'); autoloaded
						$this->session->set_userdata('user_id',$login_id);
						/*
							in practical project
							we used to redirect to a controller and then load the view
						*/
						//$this->load->view('formsuccess');
						return redirect('admin/home');
						
					}
					else{
						$this->session->sess_destroy();
						echo "such user and password combination not available";
					}
                        
                }
		}
		public function home()
		{
			if($this->session->userdata('user_id'))
			{
				$data_array='';
				$this->admin_template->load_template("admin/blankpage",$data_array);
			}
			else{
				$this->login();
			}
			
		}
		public function slider(){
			
			$data_array['slider_result']=$this->common->get_all_data('home_page_slider');
			$this->admin_template->load_template("admin/slider",$data_array);
		}
		public function slider_upload($flag){
			if($flag=="new")
			{
				$config['upload_path']          = './assets/public/images/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
				$config['remove_spaces']           = TRUE;
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('sliderFile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->admin_template->load_template("admin/slider",$error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						//get filename:
						$file_name=$data['upload_data']['file_name'];
						$upload_path=$this->upload->upload_path;
						//resize the uploaded images
						$this->image_resize($upload_path,$file_name,1920,600);
						$sliderTex = $this->security->xss_clean($this->input->post('sliderText'));
						$data=array(
							'image'=>$file_name,
							'image_text'=>$sliderTex
						);
						$this->common->insert_data('home_page_slider',$data);
                        $this->slider();
						
                }

			}
			else if($flag=="update")
			{
				$sliderTex = $this->security->xss_clean($this->input->post('sliderText'));
				$id = $this->security->xss_clean($this->input->post('sliderid'));
				
				
				if (empty($_FILES['sliderFile']['name'])) {
					$data=array('image_text'=>$sliderTex);
				}
				else{
					$config['upload_path']          = './assets/public/images/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 0;
					$config['max_width']            = 0;
					$config['max_height']           = 0;
					$config['remove_spaces']           = TRUE;
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('sliderFile'))
					{
							$error = array('error' => $this->upload->display_errors());
	
							$this->admin_template->load_template("admin/slider",$error);
					}
					else
					{
							$data = array('upload_data' => $this->upload->data());
							//get filename:
							$file_name=$data['upload_data']['file_name'];
							$upload_path=$this->upload->upload_path;
							//resize the uploaded images
							$this->image_resize($upload_path,$file_name,1920,600);
							
							
					}
					$data=array('image'=>$file_name,'image_text'=>$sliderTex);
					
					
				}
				
				
				
							
							$this->common->update_data('home_page_slider',$data,$id);
							
							//$this->slider();
			}
			else{
				//do nothing
			}
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		
		public function sliderDelete($id)
		{
			$this->common->delete_by_id('home_page_slider',$id);
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		
		public function sliderEdit($id)
		{
			$data_array['single_result']=$this->common->get_data_by_id('home_page_slider',$id);
			$data_array['all_result']=$this->common->get_all_data('home_page_slider');
			$this->admin_template->load_template('admin/slider_edit',$data_array);
			
			//redirect('admin/slider');
		}
		
		
		
		######################### Home body controllers start here #########################
		public function homebody()
		{
			$data_array['single_result']=$this->common->get_data_by_id('home_page',1);
			$this->admin_template->load_template('admin/homebody',$data_array);
		}
		public function home_update()
		{
			$data=array('heading'=>$this->input->post('heading'),'body'=>$this->input->post('body'));	
			$this->common->update_data('home_page',$data,1);
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		
		######################### Home sidebar (quick links) controllers start here #########################
		public function homesidebar()
		{
			$data_array['all_quick_link']=$this->common->get_all_data('home_page_key_offering');
			$this->admin_template->load_template('admin/homesidebar',$data_array);
		}
		
		public function homesidebar_edit($id)
		{
			
			$data_array['all_quick_link']=$this->common->get_all_data('home_page_key_offering');
			$data_array['single_quick_link']=$this->common->RA_get_data_by_id('home_page_key_offering',$id);
			/*SEO*/
			$title=$data_array['single_quick_link'][0]['name'];
			$slug=$data_array['single_quick_link'][0]['slug'];
			$this->seo_keyword_page($title,$slug);
			/*SEO ends*/
			
			$data_array['default_mn_bg']=$this->common->RA_get_data_by_id('home_page_our_services_background',1);
			$this->admin_template->load_template('admin/homesidebar_edit',$data_array);
		}
		public function quicklink($flag)
		{
			if($flag=="new"){
				$qltext=$this->security->xss_clean($this->input->post('qltext'));
				$qlbody=$this->input->post('qlbody');
				$slug = url_title($qltext, 'dash', TRUE);
				$bgit=$this->security->xss_clean($this->input->post('bgit'));
				if (empty($_FILES['bgi']['name']))
				{
					$data=array(
						'name'=>$qltext,
						'body'=>$qlbody,
						'slug'=>$slug,
						'bgit'=>$bgit
					);
					$this->common->insert_data('home_page_key_offering',$data);
				}
				else{
					$config['upload_path']          = './assets/public/images/menu_background/';
					$config['allowed_types']        = 'jpg|gif|png';
					$config['max_size']             = 0;
					$config['max_width']            = 0;
					$config['max_height']           = 0;
					$config['remove_spaces']           = TRUE;
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('bgi'))
					{
							$error = array('error' => $this->upload->display_errors());
	
							$this->admin_template->load_template("admin/homesidebar",$error);
					}
					else
					{
							$data = array('upload_data' => $this->upload->data());
							$file_name=$data['upload_data']['file_name'];
							$upload_path=$this->upload->upload_path;
							
							//resize the uploaded images
							$this->image_resize($upload_path,$file_name,1920,600);
						
							$data=array(
								'name'=>$qltext,
								'body'=>$qlbody,
								'slug'=>$slug,
								'bgi'=>$file_name,
								'bgit'=>$bgit
							);
							$this->common->insert_data('home_page_key_offering',$data);
					}
				}
				$this->seo_keyword_page($qltext,$slug);
			}
			
			if($flag=="update"){
				$qltext=$this->security->xss_clean($this->input->post('qltext'));
				$qlbody=$this->input->post('qlbody');
				$id=$this->security->xss_clean($this->input->post('id'));
				$slug = url_title($qltext, 'dash', TRUE);
				$bgit=$this->security->xss_clean($this->input->post('bgit'));
				if (empty($_FILES['bgi']['name']))
				{
					$data=array(
						'name'=>$qltext,
						'body'=>$qlbody,
						'slug'=>$slug,
						'bgit'=>$bgit
					);
					$this->common->update_data('home_page_key_offering',$data,$id);
				}
				else{
					$config['upload_path']          = './assets/public/images/menu_background/';
					$config['allowed_types']        = 'jpg|gif|png';
					$config['max_size']             = 0;
					$config['max_width']            = 0;
					$config['max_height']           = 0;
					$config['remove_spaces']           = TRUE;
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('bgi'))
					{
							$error = array('error' => $this->upload->display_errors());
	
							$this->admin_template->load_template("admin/homesidebar_edit",$error);
					}
					else
					{
							$data = array('upload_data' => $this->upload->data());
							$file_name=$data['upload_data']['file_name'];
							$upload_path=$this->upload->upload_path;
							
							//resize the uploaded images
							$this->image_resize($upload_path,$file_name,1920,600);
						
							$data=array(
								'name'=>$qltext,
								'body'=>$qlbody,
								'slug'=>$slug,
								'bgi'=>$file_name,
								'bgit'=>$bgit
							);
							$this->common->update_data('home_page_key_offering',$data,$id);
					}
				}
				$this->seo_keyword_page($qltext,$slug);
			}
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		
		public function homesidebar_delete($id)
		{
			$this->common->delete_by_id('home_page_key_offering',$id);
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		
		######################### footer controllers start here #########################
		public function pdf(){
			$data_array['all_pdf']=$this->common->get_all_data('footer_pdf');
			$this->admin_template->load_template('admin/pdf',$data_array);
		}
		
		public function pdf_action($flag){
			if($flag=="new"){

				$config['upload_path']          = './assets/admin/pdfs/';
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
				$config['remove_spaces']           = TRUE;
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('pdf'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->admin_template->load_template("admin/pdf",$error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						//get filename:
						$file_name=$data['upload_data']['file_name'];
						$upload_path=$this->upload->upload_path;
						$pdftext=$this->security->xss_clean($this->input->post('pdftext'));

						$slug = url_title($pdftext, 'dash', TRUE);
						/*SEO*/
							$this->seo_keyword_page($pdftext,$slug);
						/*SEO ends*/
						$data=array(
							'name'=>$pdftext,
							'pdf_file'=>$file_name,
							'slug'=>$slug
						);
						$this->common->insert_data('footer_pdf',$data);
						$previous_page = $this->session->userdata('previous_page');
						redirect($previous_page, 'refresh');
                }
				
				
			}
			if($flag=="update"){
				$id = $this->security->xss_clean($this->input->post('id'));
				$pdftext=$this->security->xss_clean($this->input->post('pdftext'));
				$slug = url_title($pdftext, 'dash', TRUE);
				if (empty($_FILES['pdf']['name'])) {
					
					$data=array('name'=>$pdftext,'slug'=>$slug);
					$this->common->update_data('footer_pdf',$data,$id);
					/*SEO*/
							$this->seo_keyword_page($pdftext,$slug);
						/*SEO ends*/
					$previous_page = $this->session->userdata('previous_page');
					redirect($previous_page, 'refresh');
				}
				else{
					$config['upload_path']          = './assets/admin/pdfs/';
					$config['allowed_types']        = 'pdf';
					$config['max_size']             = 0;
					$config['max_width']            = 0;
					$config['max_height']           = 0;
					$config['remove_spaces']           = TRUE;
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('pdf'))
					{
							$error = array('error' => $this->upload->display_errors());
	
							$this->admin_template->load_template("admin/pdf",$error);
					}
					else
					{
							$data = array('upload_data' => $this->upload->data());
							//get filename:
							$file_name=$data['upload_data']['file_name'];
							$upload_path=$this->upload->upload_path;

							
					}
					$data=array('pdf_file'=>$file_name,'name'=>$pdftext,'slug'=>$slug);
					$this->common->update_data('footer_pdf',$data,$id);
					/*SEO*/
						$this->seo_keyword_page($pdftext,$slug);
					/*SEO ends*/
					$previous_page = $this->session->userdata('previous_page');
					redirect($previous_page, 'refresh');
				}
			}
			else{
				//do nithing
			}
			
			
		}
		
		public function pdf_delete($id)
		{
			$this->common->delete_by_id('footer_pdf',$id);
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		
		public function pdf_edit($id){
			$data_array['all_pdf']=$this->common->get_all_data('footer_pdf');
			$data_array['single_pdf']=$this->common->RA_get_data_by_id('footer_pdf',$id);
			/*SEO*/
			$title=$data_array['single_pdf'][0]['name'];
			$slug=$data_array['single_pdf'][0]['slug'];
			$this->seo_keyword_page($title,$slug);
			/*SEO ends*/
			$this->admin_template->load_template('admin/pdf_edit',$data_array);
		}
		public function subscribers(){
			$data_array['all_subs']=$this->common->get_all_data('footer_subscriber');
			$this->admin_template->load_template('admin/subscribers',$data_array);
		}
		public function subs_delete($id){
			$this->common->delete_by_id('footer_subscriber',$id);
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		
		
		
		######################### our services controllers start here #########################
		public function ourservices(){
			$data_array['all_ourservices']=$this->common->get_all_data('home_page_our_services');
			$this->admin_template->load_template('admin/ourservices',$data_array);
		}
		public function ourservices_action($flag)
		{
			if($flag=="new")
			{
				//check if our services count is 8,if yes then redirect to replace page
				$count=$this->common->get_count('home_page_our_services');
				if($count>=8)
				{
					//redirect to replace page
					//logic pending
				}
				else{
					$service = $this->security->xss_clean($this->input->post('service'));
					$url=$this->security->xss_clean($this->input->post('url'));
					$icon=$this->input->post('icon');
					$data=array(
							'service'=>$service,
							'url'=>$url,
							'icon_code'=>$icon
						);
						$this->common->insert_data('home_page_our_services',$data);
						$previous_page = $this->session->userdata('previous_page');
						redirect($previous_page, 'refresh');
				}
			}
			else if($flag=="update"){
				$service = $this->security->xss_clean($this->input->post('service'));
					$url=$this->security->xss_clean($this->input->post('url'));
					$icon=$this->input->post('icon');
					$id=$this->input->post('id');
					$data=array(
							'service'=>$service,
							'url'=>$url,
							'icon_code'=>$icon
						);
						$this->common->update_data('home_page_our_services',$data,$id);
						$previous_page = $this->session->userdata('previous_page');
						redirect($previous_page, 'refresh');
			}
			else{
				//do nothing
				$previous_page = $this->session->userdata('previous_page');
				redirect($previous_page, 'refresh');
			}
				
		}
		
		public function ourservices_backgroundimage(){
			$data_array['back']=$this->common->get_all_data('home_page_our_services_background');
			$this->admin_template->load_template('admin/ourservices_backgroundimage',$data_array);
		}
		public function ourservices_backgroundimage_update()
		{
				$id = $this->security->xss_clean($this->input->post('id'));
				if (empty($_FILES['bgi']['name'])) {

					$previous_page = $this->session->userdata('previous_page');
					redirect($previous_page, 'refresh');
				}
				else{
					$config['upload_path']          = './assets/public/images/';
					$config['allowed_types']        = 'jpg|gif|png';
					$config['max_size']             = 0;
					$config['max_width']            = 0;
					$config['max_height']           = 0;
					$config['remove_spaces']           = TRUE;
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('bgi'))
					{
							$error = array('error' => $this->upload->display_errors());
	
							$this->admin_template->load_template("admin/ourservices_backgroundimage",$error);
					}
					else
					{
							$data = array('upload_data' => $this->upload->data());
							//print_r($data);
							//get filename:
							$file_name=$data['upload_data']['file_name'];
							$upload_path=$this->upload->upload_path;
							
							//resize the uploaded images
							$this->image_resize($upload_path,$file_name,1920,600);
						
							$data1=array('image'=>$file_name);
					
							$this->common->update_data('home_page_our_services_background',$data1,$id);
					}
					
					$previous_page = $this->session->userdata('previous_page');
					redirect($previous_page, 'refresh');
				}

		}
		
		public function ourservices_delete($id)
		{
			$this->common->delete_by_id('home_page_our_services',$id);
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		
		public function ourservices_edit($id){
			$data_array['all_services']=$this->common->get_all_data('home_page_our_services');
			$data_array['single_service']=$this->common->get_data_by_id('home_page_our_services',$id);
			$this->admin_template->load_template('admin/ourservices_edit',$data_array);
		}
		
		
		
		
		######################### Home sidebar (registration_services) controllers start here #########################
		public function registration_services()
		{
			$data_array['all_quick_link']=$this->common->get_all_data('home_page_registration_service');
			$this->admin_template->load_template('admin/registration_services',$data_array);
		}
		
		public function registration_services_edit($id)
		{
			$data_array['all_quick_link']=$this->common->get_all_data('home_page_registration_service');
			$data_array['single_quick_link']=$this->common->RA_get_data_by_id('home_page_registration_service',$id);
			/*SEO*/
			$title=$data_array['single_quick_link'][0]['name'];
			$slug=$data_array['single_quick_link'][0]['slug'];
			$this->seo_keyword_page($title,$slug);
			/*SEO ends*/
			$data_array['default_mn_bg']=$this->common->RA_get_data_by_id('home_page_our_services_background',1);
			$this->admin_template->load_template('admin/registration_services_edit',$data_array);
		}
		public function registration_service_action($flag)
		{
			if($flag=="new"){
				$rstext=$this->security->xss_clean($this->input->post('rstext'));
				$rsbody=$this->input->post('rsbody');
				$slug = url_title($rstext, 'dash', TRUE);
				$bgit=$this->security->xss_clean($this->input->post('bgit'));
				if (empty($_FILES['bgi']['name']))
				{
					$data=array(
						'name'=>$rstext,
						'body'=>$rsbody,
						'slug'=>$slug,
						'bgit'=>$bgit
					);
					$this->common->insert_data('home_page_registration_service',$data);
				}
				else{
					$config['upload_path']          = './assets/public/images/menu_background/';
					$config['allowed_types']        = 'jpg|gif|png';
					$config['max_size']             = 0;
					$config['max_width']            = 0;
					$config['max_height']           = 0;
					$config['remove_spaces']           = TRUE;
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('bgi'))
					{
							$error = array('error' => $this->upload->display_errors());
	
							$this->admin_template->load_template("admin/registration_service",$error);
					}
					else
					{
							$data = array('upload_data' => $this->upload->data());
							$file_name=$data['upload_data']['file_name'];
							$upload_path=$this->upload->upload_path;
							
							//resize the uploaded images
							$this->image_resize($upload_path,$file_name,1920,600);
						
							$data=array(
								'name'=>$rstext,
								'body'=>$rsbody,
								'slug'=>$slug,
								'bgi'=>$file_name,
								'bgit'=>$bgit
							);
							$this->common->insert_data('home_page_registration_service',$data);
					}
				}
				$this->seo_keyword_page($rstext,$slug);
			}
			
			if($flag=="update"){
				$rstext=$this->security->xss_clean($this->input->post('rstext'));
				$rsbody=$this->input->post('rsbody');
				$id=$this->security->xss_clean($this->input->post('id'));
				$slug = url_title($rstext, 'dash', TRUE);
				$bgit=$this->security->xss_clean($this->input->post('bgit'));
				$this->seo_keyword_page($rstext,$slug);
				if (empty($_FILES['bgi']['name']))
				{
				  $data=array(
					  'name'=>$rstext,
					  'body'=>$rsbody,
					  'slug'=>$slug,
					  'bgit'=>$bgit
				  );
				  $this->common->update_data('home_page_registration_service',$data,$id);
				}
				else{
					$config['upload_path']          = './assets/public/images/menu_background/';
					$config['allowed_types']        = 'jpg|gif|png';
					$config['max_size']             = 0;
					$config['max_width']            = 0;
					$config['max_height']           = 0;
					$config['remove_spaces']           = TRUE;
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('bgi'))
					{
							$error = array('error' => $this->upload->display_errors());
	
							$this->admin_template->load_template("admin/registration_service_edit",$error);
					}
					else
					{
							$data = array('upload_data' => $this->upload->data());
							$file_name=$data['upload_data']['file_name'];
							$upload_path=$this->upload->upload_path;
							
							//resize the uploaded images
							$this->image_resize($upload_path,$file_name,1920,600);
						
							 $data=array(
								'name'=>$rstext,
								'body'=>$rsbody,
								'slug'=>$slug,
								'bgi'=>$file_name,
								'bgit'=>$bgit
							);
							$this->common->update_data('home_page_registration_service',$data,$id);
							
							
					}
				}
				
			}
			
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		
		public function registration_services_delete($id)
		{
			$this->common->delete_by_id('home_page_registration_service',$id);
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		
		
		############################ testimonials start here ###########################
		public function testimonials()
		{
			$data_array['all_testimonials']=$this->common->get_all_data('home_page_testimonials');
			$this->admin_template->load_template('admin/testimonials',$data_array);
		}
		public function testimonial_action($flag)
		{
			if($flag=="new")
			{
				$config['upload_path']          = './assets/public/images/testimonials/';
                $config['allowed_types']        = 'jpg|gif|png';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
				$config['remove_spaces']           = TRUE;
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('photo'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->admin_template->load_template("admin/testimonials",$error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						//get filename:
						$file_name=$data['upload_data']['file_name'];
						$upload_path=$this->upload->upload_path;
						//resize the uploaded images
						$this->image_resize($upload_path,$file_name,150,150);
						$name=$this->security->xss_clean($this->input->post('name'));
						$testimonial=$this->security->xss_clean($this->input->post('testimonial'));

						
						$data=array(
							'name'=>$name,
							'photo'=>$file_name,
							'testimonial'=>$testimonial
						);
						$this->common->insert_data('home_page_testimonials',$data);
						$previous_page = $this->session->userdata('previous_page');
						redirect($previous_page, 'refresh');
                }
			}
			else if($flag=="update")
			{
				$id = $this->security->xss_clean($this->input->post('id'));
				$name = $this->security->xss_clean($this->input->post('name'));
				$testimonial = $this->input->post('testimonial');
				if (empty($_FILES['photo']['name'])) {

					$insert=array(
						'name'=>$name,
						'testimonial'=>$testimonial,
					);
					$this->common->update_data('home_page_testimonials',$insert,$id);
					$previous_page = $this->session->userdata('previous_page');
					redirect($previous_page, 'refresh');
				}
				else{
					$config['upload_path']          = './assets/public/images/testimonials/';
					$config['allowed_types']        = 'jpg|gif|png';
					$config['max_size']             = 0;
					$config['max_width']            = 0;
					$config['max_height']           = 0;
					$config['remove_spaces']           = TRUE;
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('photo'))
					{
							$error = array('error' => $this->upload->display_errors());
	
							$this->admin_template->load_template("admin/testimonials",$error);
					}
					else
					{
							$data = array('upload_data' => $this->upload->data());
							//print_r($data);
							//get filename:
							$file_name=$data['upload_data']['file_name'];
							$upload_path=$this->upload->upload_path;
							
							//resize the uploaded images
							$this->image_resize($upload_path,$file_name,150,150);
						
							$insert=array(
								'name'=>$name,
								'testimonial'=>$testimonial,
								'photo'=>$file_name
							);
					
							$this->common->update_data('home_page_testimonials',$insert,$id);
							$previous_page = $this->session->userdata('previous_page');
							redirect($previous_page, 'refresh');
					}
					
					
				}
			}
			else{
				//do nothing
			}
		}
		
		public function testimonialEdit($id)
		{
			$data_array['single_result']=$this->common->get_data_by_id('home_page_testimonials',$id);
			$data_array['all_testimonials']=$this->common->get_all_data('home_page_testimonials');
			$this->admin_template->load_template('admin/testimonials_edit',$data_array);
		}
		
		
		public function testimonialDelete($id)
		{
			$this->common->delete_by_id('home_page_testimonials',$id);
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		
		############################ news and updates functions start here ###########################
		public function news()
		{
			$data_array['news']='';
			$this->admin_template->load_template('admin/blankpage',$data_array);
		}
		
		############################ menus functions start here ###########################
		
		public function menu($id)
		{
			$parameters=array('id'=>$id);
			$this->admin_template->load_template('admin/menu',$parameters);
		}
		public function add_menu($id)
		{
			/*
				type MM=Main Menu
				SM=SubMenu
			*/
			$id = $this->security->xss_clean($this->input->post('id'));
			$name = $this->security->xss_clean($this->input->post('name'));
			$body = $this->input->post('body');
			$slug = url_title($name, 'dash', TRUE);
			$bgit = $this->security->xss_clean($this->input->post('bgit'));
			if (empty($_FILES['bgi']['name'])) {
				$data=array(
					'menu'=>$name,
					'body'=>$body,
					'slug'=>$slug,
					'mid'=>$id,
					'bgit'=>$bgit
				);
				
				$this->common->insert_data('menus',$data);
				$this->seo_keyword_page($name,$slug);
				$previous_page = $this->session->userdata('previous_page');
				redirect($previous_page, 'refresh');
			}
			else{
					$config['upload_path']          = './assets/public/images/menu_background/';
					$config['allowed_types']        = 'jpg|gif|png';
					$config['max_size']             = 0;
					$config['max_width']            = 0;
					$config['max_height']           = 0;
					$config['remove_spaces']           = TRUE;
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('bgi'))
					{
							$error = array('error' => $this->upload->display_errors());
	
							$this->admin_template->load_template("admin/menu",$error);
					}
					else
					{
							$data = array('upload_data' => $this->upload->data());
							$file_name=$data['upload_data']['file_name'];
							$upload_path=$this->upload->upload_path;
							
							//resize the uploaded images
							$this->image_resize($upload_path,$file_name,1920,600);
						
							$data=array(
								'menu'=>$name,
								'body'=>$body,
								'slug'=>$slug,
								'mid'=>$id,
								'bgi'=>$file_name,
								'bgit'=>$bgit
							);
					
							$this->common->insert_data('menus',$data);
							$this->seo_keyword_page($name,$slug);
							$previous_page = $this->session->userdata('previous_page');
							redirect($previous_page, 'refresh');
					}
			}
				
		}
		
		
		public function menu_edit($id)
		{
			$data_array['menu']=$this->common->RA_get_data_by_id('menus',$id);
			/*SEO*/
			$title=$data_array['menu'][0]['menu'];
			$slug=$data_array['menu'][0]['slug'];
			$this->seo_keyword_page($title,$slug);
			/*SEO ends*/
			$data_array['menu_ql']=$this->common->get_menu_by_mid('menus_quick_links',$id);
			$data_array['default_mn_bg']=$this->common->RA_get_data_by_id('home_page_our_services_background',1);
			$this->admin_template->load_template('admin/menu_edit',$data_array);
		}
		public function menu_update($id)
		{
			$id = $this->security->xss_clean($this->input->post('id'));
			$menu = $this->security->xss_clean($this->input->post('name'));
			$body = $this->input->post('body');
			$slug = url_title($menu, 'dash', TRUE);
			$bgit = $this->security->xss_clean($this->input->post('bgit'));
			if (empty($_FILES['bgi']['name']))
			{
				$data=array(
				'menu'=>$menu,
				'body'=>$body,
				'slug'=>$slug,
				'bgit'=>$bgit
				);
				$this->common->update_data('menus',$data,$id);
				$previous_page = $this->session->userdata('previous_page');
				redirect($previous_page, 'refresh');
			}
			else{
					$config['upload_path']          = './assets/public/images/menu_background/';
					$config['allowed_types']        = 'jpg|gif|png';
					$config['max_size']             = 0;
					$config['max_width']            = 0;
					$config['max_height']           = 0;
					$config['remove_spaces']           = TRUE;
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('bgi'))
					{
							$error = array('error' => $this->upload->display_errors());
	
							$this->admin_template->load_template("admin/menu",$error);
					}
					else
					{
							$data = array('upload_data' => $this->upload->data());
							$file_name=$data['upload_data']['file_name'];
							$upload_path=$this->upload->upload_path;
							
							//resize the uploaded images
							$this->image_resize($upload_path,$file_name,1920,600);
						
							$data=array(
								'menu'=>$menu,
								'body'=>$body,
								'slug'=>$slug,
								'bgi'=>$file_name,
								'bgit'=>$bgit
							);
					
							$this->common->update_data('menus',$data,$id);
							$previous_page = $this->session->userdata('previous_page');
							redirect($previous_page, 'refresh');
					}
			}
		}
		public function menu_delete($id)
		{
			$this->common->delete_by_id('menus',$id);
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		public function menu_q_link($id)
		{
			$parameters=array('id'=>$id);
			$this->admin_template->load_template('admin/menu_q_link',$parameters);
		}
		
		public function add_menu_q_l($id)
		{
			/*
				type MM=Main Menu
				SM=SubMenu
			*/
			$id = $this->security->xss_clean($this->input->post('id'));
			$name = $this->security->xss_clean($this->input->post('name'));
			$body = $this->input->post('body');
			$slug = url_title($name, 'dash', TRUE);
			$bgit = $this->security->xss_clean($this->input->post('bgit'));
			if (empty($_FILES['bgi']['name'])) {
				$data=array(
					'quick_link'=>$name,
					'body'=>$body,
					'slug'=>$slug,
					'mid'=>$id,
					'bgit'=>$bgit
				);
				$this->common->insert_data('menus_quick_links',$data);
				$this->seo_keyword_page($name,$slug);
				$previous_page = $this->session->userdata('previous_page');
				redirect($previous_page, 'refresh');
			}
			else{
				$config['upload_path']          = './assets/public/images/menu_background/';
					$config['allowed_types']        = 'jpg|gif|png';
					$config['max_size']             = 0;
					$config['max_width']            = 0;
					$config['max_height']           = 0;
					$config['remove_spaces']           = TRUE;
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('bgi'))
					{
							$error = array('error' => $this->upload->display_errors());
	
							$this->admin_template->load_template("admin/menu",$error);
					}
					else
					{
							$data = array('upload_data' => $this->upload->data());
							$file_name=$data['upload_data']['file_name'];
							$upload_path=$this->upload->upload_path;
							
							//resize the uploaded images
							$this->image_resize($upload_path,$file_name,1920,600);
						
							$data=array(
								'quick_link'=>$name,
								'body'=>$body,
								'slug'=>$slug,
								'mid'=>$id,
								'bgi'=>$file_name,
								'bgit'=>$bgit
							);
							$this->common->insert_data('menus_quick_links',$data);
							$this->seo_keyword_page($name,$slug);
							$previous_page = $this->session->userdata('previous_page');
							redirect($previous_page, 'refresh');
					}
			}
		}
		public function menu_ql_edit($id)
		{
			$data_array['mql']=$this->common->RA_get_data_by_id('menus_quick_links',$id);
			/*SEO*/
			$title=$data_array['mql'][0]['quick_link'];
			$slug=$data_array['mql'][0]['slug'];
			$this->seo_keyword_page($title,$slug);
			/*SEO ends*/
			$data_array['default_mn_bg']=$this->common->RA_get_data_by_id('home_page_our_services_background',1);
			$this->admin_template->load_template('admin/menu_q_link_edit',$data_array);
		}
		public function menu_q_l_update($id)
		{
			$id = $this->security->xss_clean($this->input->post('id'));
			$quick_link = $this->security->xss_clean($this->input->post('name'));
			$body = $this->input->post('body');
			$slug = url_title($quick_link, 'dash', TRUE);
			$bgit = $this->security->xss_clean($this->input->post('bgit'));
			if (empty($_FILES['bgi']['name']))
			{
				$data=array(
				'quick_link'=>$quick_link,
				'body'=>$body,
				'slug'=>$slug,
				'bgit'=>$bgit
				);
				$this->common->update_data('menus_quick_links',$data,$id);
				$previous_page = $this->session->userdata('previous_page');
				redirect($previous_page, 'refresh');
			}
			else{
					$config['upload_path']          = './assets/public/images/menu_background/';
					$config['allowed_types']        = 'jpg|gif|png';
					$config['max_size']             = 0;
					$config['max_width']            = 0;
					$config['max_height']           = 0;
					$config['remove_spaces']           = TRUE;
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('bgi'))
					{
							$error = array('error' => $this->upload->display_errors());
	
							$this->admin_template->load_template("admin/menu",$error);
					}
					else
					{
							$data = array('upload_data' => $this->upload->data());
							$file_name=$data['upload_data']['file_name'];
							$upload_path=$this->upload->upload_path;
							
							//resize the uploaded images
							$this->image_resize($upload_path,$file_name,1920,600);
						
							$data=array(
							'quick_link'=>$quick_link,
							'body'=>$body,
							'slug'=>$slug,
							'bgi'=>$file_name,
							'bgit'=>$bgit
							);
							$this->common->update_data('menus_quick_links',$data,$id);
							$previous_page = $this->session->userdata('previous_page');
							redirect($previous_page, 'refresh');
					}
			}
		}
		
		public function menu_ql_delete($id)
		{
			$this->common->delete_by_id('menus_quick_links',$id);
			$previous_page = $this->session->userdata('previous_page');
			redirect($previous_page, 'refresh');
		}
		public function seo_keyword_page($title,$slug)
		{
			/*
				check if the title and slug exist in seo_meta table
				then get their data otherwise insert title and slug and then open the page (recursive function)
			*/
			$title=urldecode($title);
			$data_array['seo']=$this->common->RA_get_seo_data($title,$slug);
			
			if(empty($data_array['seo']))
			{
				$this->add_seo_record($title,$slug);
				$this->seo_keyword_page($title,$slug);//recursively function
			}
			else{
				//$this->admin_template->load_template('admin/seo_keyword_page',$data_array);
			}
			
			
		}
		
		public function seo_keyword_page_final($title,$slug)
		{
			/*
				check if the title and slug exist in seo_meta table
				then get their data otherwise insert title and slug and then open the page (recursive function)
			*/
			$title=urldecode($title);
			$data_array['seo']=$this->common->RA_get_seo_data($title,$slug);
			
			if(empty($data_array['seo']))
			{
				$this->add_seo_record($title,$slug);
				$this->seo_keyword_page($title,$slug);//recursively function
			}
			else{
				$this->admin_template->load_template('admin/seo_keyword_page',$data_array);
			}
			
			
		}
		
		public function seo_keyword_page_update()
		{
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$tags = $this->input->post('tags');
			$description = $this->input->post('description');
			$data=array(
			'title'=>$title,
			'slug'=>$slug,
			'tags'=>$tags,
			'description'=>$description
			);
			//print_r($data);
			$this->common->RA_update_seo_data($title,$slug,$data);
			$previous_page = $this->session->userdata('previous_page');
							redirect($previous_page, 'refresh');
		}
		############################ common functions start here ###########################
		public function image_resize($path,$filename,$width,$height){
			$config['source_image'] = $path.$filename;
			$config['maintain_ratio'] = false;
			$config['width'] = $width;
			$config['height'] = $height;
	
			$this->load->library('image_lib', $config);
	
			if ( ! $this->image_lib->resize()){
				$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
			}
		}
		
		private function add_seo_record($title,$slug)
		{
			$data=array('title'=>$title,'slug'=>$slug);
			$this->common->insert_data('seo_meta',$data);
		}
		
		public function logout(){
			$this->session->sess_destroy();
			$previous_page = $this->session->userdata('previous_page');
			return redirect($previous_page, 'refresh');
		}
		
	}
?>