<?php

class Hutang extends CI_Controller
{

	private $data = array();
	private $where;

	function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['logged_in'])) {
			$url = base_url('auth');
			redirect($url);
		};
	}

	function index()
	{
		$items = $this->get_all('hutang');
		$this->load->view('/admin/hutang/index', array('items' => $items));
	}

	function insert()
	{
		$items = $this->get_all('hutang');
		$this->load->view('/admin/hutang/create', array('items' => $items));
	}

	function create()
	{

		if ($this->is_post()) {
			$post = $this->input->post();
			$config['upload_path'] = './assets/images/struktur';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);
			if (!empty($_FILES['images']['name'])) {
				if ($this->upload->do_upload('images')) {
					$file = $this->upload->data();
					$post['images'] = $file['file_name'];
				}
			}

			if ($this->db->insert('hutang', $post)) {
				$this->session->set_flashdata('success', 'Data has been successfully');
			} else {
				$this->session->set_flashdata('error', 'Unknwon error, please try again');
			}
			redirect('/admin/hutang');
		}
	}

	function update($id)
	{
		$post = $this->input->post();

		if ($this->is_post()) {
			$config['upload_path'] = './assets/images/struktur/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);
			if (!empty($_FILES['images']['name'])) {
				if ($this->upload->do_upload('images')) {
					$file = $this->upload->data();
					$post['images'] = $file['file_name'];
				}
			}
			$item = $this->get('hutang', $id);
			if (!empty($_FILES['images']['name'])) {
				unlink('http://localhost/BPMP/assets/images/cars/' . $item->images);
			}

			if ($this->db->update('hutang', $post, array('id' => $id))) {
				$this->session->set_flashdata('Success', 'Data has been Updated');
				redirect('admin/hutang');
			} else {
				$this->session->set_flashdata('error', 'Unknown error, please try again');
			}
		}
		$item = $this->get('hutang', $id);
		$data = array(
			'hutang'	=> $this->get_all('hutang'),
			'item' => $item
		);
		$this->load->view('admin/hutang/edit', $data);
	}


	function delete($id = false)
	{
		if ($id) {
			$item = $this->get('hutang', $id);
			if ($item && isset($item)) {
				unlink('assets/images/struktur' . $item->images);
			}
			if ($this->db->delete('hutang', array('id' => $id))) {
				$this->session->set_flashdata('success', 'Data has been Deleted');
			} else {
				$this->session->set_flashdata('error', 'Unknown error, please try again');
			}
			redirect('admin/hutang');
		}
	}

	function bayar($id)
	{
		if ($this->input->post('submit') == 'Submit') {
			$hutang = $this->db->query("select * from hutang where id = $id")->row_array();
			$bayar = $this->input->post('jumlah_bayar');
			$tanggal = date('Y-m-d');
			$id_admin = $this->session->userdata('idadmin');
			$this->db->insert('bayar', array('jumlah_bayar' => $bayar, 'tanggal' => $tanggal, 'user_id' => $id_admin, 'hutang_id' => $id));
			if ($hutang['jumlah'] > $bayar) {
				$sisa = $hutang['jumlah'] - $bayar;
				$this->db->query("update hutang set jumlah = $sisa where id = $id");
				$this->session->set_flashdata('Success', 'Hutang telah diangsur');
				redirect('admin/hutang');
			} else if ($hutang['jumlah'] == $bayar) {
				$this->db->query("update hutang set level = 2 where id = $id");
				$this->session->set_flashdata('Success', 'Hutang telah lunas');
				redirect('admin/hutang');
			} else {
				$this->session->set_flashdata('error', 'Pembayaran melebihi jumlah hutang');
				redirect('admin/hutang');
			}
		} else {
			$item = $this->get('hutang', $id);
			$this->load->view('/admin/hutang/bayar', array('item' => $item));
		}
	}

	function bayar_old($id)
	{
		$post = $this->input->post();

		if ($this->is_post()) {
			$config['upload_path'] = './assets/images/struktur/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);
			if (!empty($_FILES['images']['name'])) {
				if ($this->upload->do_upload('images')) {
					$file = $this->upload->data();
					$post['images'] = $file['file_name'];
				}
			}
			$item = $this->get('hutang', $id);
			if (!empty($_FILES['images']['name'])) {
				unlink('http://localhost/BPMP/assets/images/cars/' . $item->images);
			}

			if ($this->db->update('hutang', $post, array('id' => $id))) {
				$this->session->set_flashdata('Success', 'Data has been Updated');
				redirect('admin/hutang');
			} else {
				$this->session->set_flashdata('error', 'Unknown error, please try again');
			}
		}
	}
	function rincian()
	{
		$id_admin = $this->session->userdata('idadmin');
		$this->db->select("*, hutang.tanggal AS tanggal_hutang, bayar.tanggal AS tanggal_bayar");
		$this->db->join('hutang', 'bayar.hutang_id = hutang.id');
		$bayar = $this->db->get_where('bayar', ['bayar.user_id' => $id_admin])->result();
		$data = array('items' => $bayar);
		// $item = $data->result();
		// print_r($data);
		$this->load->view('admin/Hutang/rincian', $data);
	}
}
