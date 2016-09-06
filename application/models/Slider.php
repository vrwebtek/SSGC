<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Slider extends CI_Model{
		public function insert($filename,$sliderText)
		{
			$sql = "INSERT INTO `home_page_slider`(`id`, `image`, `image_text`) VALUES ('',".$this->db->escape($filename).",".$this->db->escape($sliderText).")";
			$this->db->query($sql);
		}
		public function get_all_sliders()
		{
			$query = $this->db->get('home_page_slider');
            return $query->result();
		}
	}
?>