<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Home_model extends CI_Model{
		public function __construct()
		{
			// Call the CI_Model constructor
                parent::__construct();
		}
		public function get_slider()
		{
			$query = $this->db->get('home_page_slider');
            return $query->result();
		}
		public function get_home_body()
		{
			$query = $this->db->get('home_page');
            return $query->result();
		}
	}
?>