<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model("CIFriends");
		
		$this->load->library('pagination');
    }
    
    public function index()
    {
		$this->load->view("index.php");
    }
	
	public function get_international_friends($country_id,$page = 0){
		$friends = $this->CIFriends->get_international_friends($page/25+1,$country_id);
		$countries = $this->CIFriends->get_countries();

		$config['base_url'] = base_url()."/welcome/get_international_friends/".$country_id;
		$config['total_rows'] = $friends[1];
		$config['per_page'] = 25; 
		$config['uri_segment'] = 4;
		
		$this->pagination->initialize($config);
		$data["friends"] = $friends;
		$data["countries"] = $countries;
		$this->load->view("users_view",$data);
	}
	
	public function get_no_friends($page = 0){
		$friends = $this->CIFriends->no_friends(1,$page/25+1);

		$config['base_url'] = base_url()."/welcome/get_no_friends";
		$config['total_rows'] = $friends[1];
		$config['per_page'] = 25; 

		$this->pagination->initialize($config); 

		$data["friends"] = $friends;
		$this->load->view("users_view",$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */