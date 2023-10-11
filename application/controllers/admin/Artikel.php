<?php

class Artikel extends CI_Controller
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
		$this->db->select('artikel.*, AVG(rating) AS avg_rating, COUNT(ulasan) AS count_ulasan');
		$this->db->join('ulasan', 'artikel.id = ulasan.id_artikel', 'left');
		$this->db->group_by('artikel.id');
		$items = $this->db->get('artikel')->result();
		$this->load->view('/admin/artikel/index', array('items' => $items));
	}
	function gambar($id_artikel)
	{
		$data['items'] = $this->db->get_where('gambar_artikel', ['id_artikel' => $id_artikel])->result();
		$data['artikel'] = $this->db->get_where('artikel', ['id' => $id_artikel])->row();
		$this->load->view('/admin/artikel/gambar/index', $data);
	}

	public function insertGambar()
	{

		if ($this->is_post()) {
			$upload_image = $_FILES['gambar']['name'];
			if ($upload_image) {
				$post = $this->input->post();
				$config['upload_path'] = './assets/images/struktur';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
				$config['encrypt_name'] = TRUE;

				$this->upload->initialize($config);
				if (!empty($_FILES['gambar']['name'])) {
					if ($this->upload->do_upload('gambar')) {
						$file = $this->upload->data();
						$post['gambar'] = $file['file_name'];
					}
				}
			} else {
				$this->session->set_flashdata('error', 'Tidak ada gambar tersedia');
				redirect($_SERVER['HTTP_REFERER']);
			}

			if ($this->db->insert('gambar_artikel', $post)) {
				$this->session->set_flashdata('success', 'Gambar berhasil diupload');
			} else {
				$this->session->set_flashdata('error', 'Unknwon error, please try again');
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
		$this->load->view('admin/artikel/gambar');
	}

	function create()
	{

		if ($this->is_post()) {
			$post = [
				'nama' => $this->input->post('nama'),
				'tanggal' => $this->input->post('tanggal'),
				'detail' => $this->input->post('detail'),
				'images' => $this->input->post('images'),
				'youtube' => ambilYoutube($this->input->post('youtube')),
			];
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
			if ($this->db->insert('artikel', $post)) {
				$this->session->set_flashdata('success', 'Data has been successfully');
			} else {
				$this->session->set_flashdata('error', 'Unknwon error, please try again');
			}
			redirect('/admin/artikel');
		}
		$this->load->view('admin/artikel/form');
	}

	function update($id)
	{
		$post = [
			'nama' => $this->input->post('nama'),
			'tanggal' => $this->input->post('tanggal'),
			'detail' => $this->input->post('detail'),
			'images' => $this->input->post('images'),
			'youtube' => ambilYoutube($this->input->post('youtube')),
		];

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
			$item = $this->get('artikel', $id);
			if (!empty($_FILES['images']['name'])) {
				unlink('http://localhost/BPMP/assets/images/cars/' . $item->images);
			}

			if ($this->db->update('artikel', $post, array('id' => $id))) {
				$this->session->set_flashdata('Success', 'Data has been Updated');
				redirect('admin/artikel');
			} else {
				$this->session->set_flashdata('error', 'Unknown error, please try again');
			}
		}
		$item = $this->get('artikel', $id);
		$data = array(
			'artikel'	=> $this->get_all('artikel'),
			'item' => $item
		);
		$this->load->view('admin/artikel/edit', $data);
	}

	function delete($id = false)
	{
		if ($id) {
			$item = $this->get('artikel', $id);
			if ($item && isset($item)) {
				unlink('assets/images/struktur' . $item->images);
			}
			if ($this->db->delete('artikel', array('id' => $id))) {
				$this->session->set_flashdata('success', 'Data has been Deleted');
			} else {
				$this->session->set_flashdata('error', 'Unknown error, please try again');
			}
			redirect('admin/artikel');
		}
	}

	function liat($id)
	{

		$item = $this->get('artikel', $id);
		$ulasan = $this->db->get_where('ulasan', [
			'id_artikel' => $id,
			'id_pengguna' => $this->session->userdata('idadmin'),
		])->row();


		$this->db->join('tbl_pengguna', 'tbl_pengguna.pengguna_id = ulasan.id_pengguna');
		$list_ulasan = $this->db->get_where('ulasan', [
			'id_artikel' => $id
		]);
		$this->db->select('AVG(rating) AS hasil');
		$rating = $this->db->get_where('ulasan', [
			'id_artikel' => $id
		])->row();
		$gambar = $this->db->get_where('gambar_artikel', [
			'id_artikel' => $id
		])->result();

		$data = array(
			'artikel'	=> $this->get_all('artikel'),
			'item' => $item,
			'ulasan' => $ulasan,
			'list_ulasan' => $list_ulasan->result(),
			'jumlah_ulasan' => $list_ulasan->num_rows(),
			'rating' => $rating->hasil,
			'gambar' => $gambar,
		);
		$this->load->view('admin/artikel/lihat', $data);
	}

	public function createUlasan()
	{
		$this->db->insert('ulasan', [
			'id_pengguna' => $this->input->post('id_pengguna'),
			'id_artikel' => $this->input->post('id_artikel'),
			'rating' => $this->input->post('rating'),
			'ulasan' => $this->input->post('ulasan')
		]);
		$this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">
				Komentar baru telah ditambahkan
				</div>');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function updateUlasan($id_ulasan)
	{
		$this->db->where('id', $id_ulasan);
		$this->db->update('ulasan', [
			'id_pengguna' => $this->input->post('id_pengguna'),
			'id_artikel' => $this->input->post('id_artikel'),
			'rating' => $this->input->post('rating'),
			'ulasan' => $this->input->post('ulasan'),
			'updated_at' => date('Y-m-d H:i:s'),
		]);
		$this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">
				Komentar baru telah ditambahkan
				</div>');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function tambahJumlahShare()
	{
		$jumlah = $this->db->get_where('artikel', ['id' => $this->input->post('id')])->row()->jumlah_share + 1;
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('artikel', [
			'jumlah_share' => $jumlah
		]);
		echo json_encode(['text' => "dibagikan sebanyak $jumlah kali"]);
	}

	public function kirimWhatsApp($no_wa = '', $pesan = '')
	{
		$no_wa = $this->input->post('no_wa');
		$pesan = urlencode($this->input->post('url'));
		$no_wa_dibalik = strrev($no_wa);
		$awal_no_wa = substr($no_wa_dibalik, -1);
		if ($awal_no_wa == '0') {
			$no_wa = '+62' . substr($no_wa, 1);
		}
		header("location: http://api.whatsapp.com/send?phone=$no_wa&text=$pesan");
	}

	public function deleteGambar($id_gambar = null)
	{
		$this->db->delete('gambar_artikel', ['id' => $id_gambar]);
		redirect($_SERVER['HTTP_REFERER']);
	}
}
