<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class User extends CI_Model{
		public function check_user($user,$pass)
		{
			//$q=$this->db->where(['username'=>$user, 'password'=>$pass])
					//->get('user');
					$q=$this->db->query("select * from `user` where `username`='$user' and `password`='$pass'");
					
					
			if($q->num_rows())
			{
				return $q->row()->id;
			}
			else{
				return FALSE;
			}
		}
	}
?>