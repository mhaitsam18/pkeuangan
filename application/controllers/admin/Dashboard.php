<?php

class Dashboard extends CI_Controller {

	private $data = array(); 

	function __construct(){
		parent::__construct();
		if(!isset($_SESSION['logged_in'])){
      $url=base_url('auth');
      redirect($url);
    };
	$this->load->library('user_agent');
	$this->load->model('M_total');  
	}
	function index(){
		$data['artikel'] = $this->M_total->jumlah_artikel();
		$data['pengguna'] = $this->M_total->pengguna();
		$this->load->view('admin/dashboard/index',$data);
	
	}
	
}