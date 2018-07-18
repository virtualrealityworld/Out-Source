<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CIActive
 *
 * @author OEM
 */
class CIFriends extends CI_Model{
	
	private $users;
	private $page_count = 25;
    //put your code here
    public function __construct() {
        parent::__construct();
		$this->users=array();
		for($i=1;$i<10717;$i++){
			$this->users[$i] = 0;
		}
    }

	public function no_friends($user_id,$page_number) {
		
        $sql = "SELECT fr1,fr2 FROM friends WHERE friends_id = {$user_id}";
		$query = $this->db->query($sql);
		
		foreach ($query->result() as $row)
		{
		   $fr1 = $row->fr1;
		   $fr2 = $row->fr2;
		   $users[$fr1]=1;
		   $users[$fr2]=1;
		}
		
		$i=1;
		$j=0;
		$no_frinds = array();
		
		foreach($this->users as $key => $user){
			if($user==0){
				$no_frinds[$j]=$key;
				$j++;
			}
			$i++;
		}
		
		$this->db->limit($this->page_count, ($page_number-1)*$this->page_count);
		$this->db->where_in('user_id', $no_frinds);
		$query = $this->db->get('users');

		$result = array();
		$result[0] = $query->result();
		$result[1] = count($no_frinds);
		return $result;
    }
	
	public function get_international_friends($page_number,$country_id){
		$sql = "SELECT friends_id FROM friends WHERE fr1 = 1 OR fr2 = 1";
		$query = $this->db->query($sql);
		$arr = array();
		$i=0;
		
		foreach ($query->result() as $row)
		{
		   $arr[$i] = $row->friends_id;
		   $i++;
		}
		
		$this->db->limit($this->page_count, ($page_number-1)*$this->page_count);
		$this->db->where('country', $country_id); 
		$this->db->where_in('user_id', $arr);
		$query = $this->db->get('users');

		$result = array();
		$result[0] = $query->result();
		
		$this->db->where('country', $country_id); 
		$this->db->where_in('user_id', $arr);
		$query = $this->db->get('users');
		
		$result[1] = $query->num_rows();
		return $result;
	}
	
	public function get_countries(){
		$query = $this->db->get("lang_table");
		
		return $query->result();
	}
}
