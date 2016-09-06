<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Common_operation_insert_update_delete extends CI_Model{
		
		public function insert_data($tablename,$data)
		{
			$this->db->insert($tablename,$data);
		}
		public function get_all_data($tablename)
		{
			$query = $this->db->get($tablename);
            return $query->result();
		}
		
		public function get_all_data_by_limit($tablename,$limit)
		{
			$query = $this->db->get($tablename);
			$this->db->limit(10);
            return $query->result();
		}
		
		public function get_data_by_id($tablename,$id)
		{
			$query = $this->db->where('id',$id)
								->get($tablename);
            return $query->result();
		}
		
		
		public function update_data($tablename,$data,$id)
		{
			$this->db->where('id',$id)
					->update($tablename,$data);
								
				return($this->db->affected_rows());
		}
		
		public function delete_all($tablename)
		{
		}
		public function delete_by_id($tablename,$id)
		{
			$this->db->where('id', $id);
			$this->db->delete($tablename);
		}
		public function get_count($tablename)
		{
			return($this->db->count_all_results($tablename));
		}
		
		public function get_menu_by_mid($tablename,$id)
		{
			$query = $this->db->where('mid',$id)
								->get($tablename);
            return $query->result();
		}
		
		public function get_submenu($tablename,$id)
		{
			$query = $this->db->where('mid !=',$id)
								->get($tablename);
            return $query->result();
		}
		
		
		#### this controller is used for public pages only ####
		public function get_data_by_slug($tablename,$slug)
		{
			$query = $this->db->where('slug',$slug)
								->get($tablename);
            return $query->result();
		}
		
		public function RA_get_data_by_slug($tablename,$slug)
		{
			$query = $this->db->where('slug',$slug)
								->get($tablename);
            return $query->result_array();
		}
		
		public function RA_get_menu_by_mid($tablename,$id)
		{
			$query = $this->db->where('mid',$id)
								->get($tablename);
			
            	return $query->result_array();
			
		}
		
		public function RA_get_data_by_id($tablename,$id)
		{
			$query = $this->db->where('id',$id)
								->get($tablename);
            return $query->result_array();
		}
		public function RA_get_all_data($tablename)
		{
			$query = $this->db->get($tablename);
            return $query->result_array();
		}
		
		public function RA_get_seo_data($title,$slug)
		{
			$query = $this->db->where(array('title'=>$title,'slug'=>$slug))
								->get('seo_meta');
			
            	return $query->result_array();
		}
		public function RA_update_seo_data($title,$slug,$data)
		{
			$query = $this->db->where(array('title'=>$title,'slug'=>$slug))
								->update('seo_meta',$data);
								return($this->db->affected_rows());
		}
	}
?>