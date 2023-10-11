<?php

class Pemasukan extends CI_Controller
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
		$items = $this->get_all('pemasukan');
		$bulan = date('m');
		$tahun = date('Y');
		$this->load->view('/admin/pemasukan/index', array(
			'items' => $items,
			'bulan' => $bulan,
			'tahun' => $tahun,
		));
	}

	function create()
	{

		if ($this->is_post()) {


			if ($this->input->post('penyimpanan') == 'Lainnya') {
				if ($this->input->post('penyimpanan_field')) {
					$post = array(
						'user_id' => $this->input->post('user_id'),
						'jumlah' => $this->input->post('jumlah'),
						'keterangan' => $this->input->post('keterangan'),
						'penyimpanan' => $this->input->post('penyimpanan_field'),
						'tanggal' => $this->input->post('tanggal'),
						'sumber' => $this->input->post('sumber'),
					);
				} else {
					$post = array(
						'user_id' => $this->input->post('user_id'),
						'jumlah' => $this->input->post('jumlah'),
						'keterangan' => $this->input->post('keterangan'),
						'penyimpanan' => $this->input->post('penyimpanan'),
						'tanggal' => $this->input->post('tanggal'),
						'sumber' => $this->input->post('sumber'),
					);
				}
			} else {
				$post = array(
					'user_id' => $this->input->post('user_id'),
					'jumlah' => $this->input->post('jumlah'),
					'keterangan' => $this->input->post('keterangan'),
					'penyimpanan' => $this->input->post('penyimpanan'),
					'tanggal' => $this->input->post('tanggal'),
					'sumber' => $this->input->post('sumber'),
				);
			}

			$save = $this->db->insert('pemasukan', $post);


			if ($save) {
				$this->session->set_flashdata('success', 'Data has been successfully');
			} else {
				$this->session->set_flashdata('error', 'Unknwon error, please try again');
			}
			redirect('/admin/pemasukan');
		}
		// $this->load->view('admin/pemasukan/form');
		$this->load->view('admin/pemasukan/create');
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
			$item = $this->get('pemasukan', $id);
			if (!empty($_FILES['images']['name'])) {
				unlink('http://localhost/BPMP/assets/images/cars/' . $item->images);
			}

			if ($this->db->update('pemasukan', $post, array('id' => $id))) {
				$this->session->set_flashdata('Success', 'Data has been Updated');
				redirect('admin/pemasukan');
			} else {
				$this->session->set_flashdata('error', 'Unknown error, please try again');
			}
		}
		$item = $this->get('pemasukan', $id);
		$data = array(
			'pemasukan'	=> $this->get_all('pemasukan'),
			'item' => $item
		);
		$this->load->view('admin/pemasukan/edit', $data);
	}

	function delete($id = false)
	{
		if ($id) {
			$item = $this->get('pemasukan', $id);
			if ($item && isset($item)) {
				unlink('assets/images/struktur' . $item->images);
			}
			if ($this->db->delete('pemasukan', array('id' => $id))) {
				$this->session->set_flashdata('success', 'Data has been Deleted');
			} else {
				$this->session->set_flashdata('error', 'Unknown error, please try again');
			}
			redirect('admin/pemasukan');
		}
	}
}
