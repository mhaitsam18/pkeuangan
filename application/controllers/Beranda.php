<?php

class Beranda extends CI_Controller {
    
	function index(){
        $this->load->view('/user/template/header');
        $this->load->view('/user/template/navbar');
		$this->load->view('/user/beranda');
        $this->load->view('/user/template/footer');
	}

    function lowongan(){
        $items = $this->get_all('lowongan');
        $this->load->view('/user/template/header');
        $this->load->view('/user/template/navbar');
		$this->load->view('/user/lowongan', array('items'=>$items));
        $this->load->view('/user/template/footer');
	}

    function event(){
        $items = $this->get_all('event');
        $this->load->view('/user/template/header');
        $this->load->view('/user/template/navbar');
		$this->load->view('/user/event', array('items'=>$items));
        $this->load->view('/user/template/footer');
	}

}