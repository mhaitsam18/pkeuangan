<?php

class Pengguna extends CI_Controller
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
		$this->load->model('m_pengguna');
		$this->load->library('upload');
	}

	function index()
	{
		$kode = $this->session->userdata('idadmin');
		$x['user'] = $this->m_pengguna->get_pengguna_login($kode);
		$x['data'] = $this->m_pengguna->get_all_pengguna();
		$this->load->view('admin/pengguna/index', $x);
	}

	public function cekTanggal()
	{
		$jumlah_hari = $this->input->post('jumlah_hari');
		$tgl1    = date('Y-m-d'); // menentukan tanggal awal
		$tgl2    = date('Y-m-d', strtotime("+$jumlah_hari days", strtotime($tgl1))); // penjumlahan tanggal sebanyak 7 hari
		echo json_encode(['tanggal' => $tgl2]);
	}

	public function cekJumlahHari()
	{
		$tanggal = $this->input->post('tanggal');
		$tgl1 = new DateTime(date('Y-m-d'));
		$tgl2 = new DateTime($tanggal);
		$jarak = $tgl2->diff($tgl1);

		echo json_encode(['jumlah_hari' => $jarak->days]);
	}

	public function blok_pengguna()
	{
		if ($this->input->post('blok') == '3') {
			$data = [
				'tanggal_nonaktif' => date('Y-m-d'),
				'tanggal_aktif' => $this->input->post('tanggal'),
				'pengguna_status' => $this->input->post('blok'),
			];
		} else {
			$data = [
				'tanggal_nonaktif' => date('Y-m-d'),
				'pengguna_status' => $this->input->post('blok'),
			];
		}
		$this->db->where('pengguna_id', $this->input->post('pengguna_id'));
		$this->db->update('tbl_pengguna', $data);
		echo $this->input->post('no_ktp');
		$this->db->insert('blokirktp', ['no_ktp' => $this->input->post('no_ktp')]);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function buka_blok($pengguna_id = null)
	{
		$data = [
			'tanggal_nonaktif' => null,
			'tanggal_aktif' => null,
			'pengguna_status' => 1,
		];

		$this->db->where('pengguna_id', $pengguna_id);
		$this->db->update('tbl_pengguna', $data);
		$no_ktp = $this->db->get_where('tbl_pengguna', ['pengguna_id' => $pengguna_id])->row()->pengguna_no_ktp;
		$this->db->delete('blokirktp', ['no_ktp' => $no_ktp]);
		redirect($_SERVER['HTTP_REFERER']);
	}

	function simpan_pengguna()
	{
		$config['upload_path'] = './assets/images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		$gambar = "";
		$foto_ktp = "";
		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '60%';
				$config['width'] = 300;
				$config['height'] = 300;
				$config['new_image'] = './assets/images/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];
			} else {
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/pengguna');
			}
		}
		if (!empty($_FILES['filefoto_ktp']['name'])) {
			if ($this->upload->do_upload('filefoto_ktp')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '60%';
				$config['width'] = 300;
				$config['height'] = 300;
				$config['new_image'] = './assets/images/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$foto_ktp = $gbr['file_name'];
			} else {
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/pengguna');
			}
		}
		$nama = $this->input->post('xnama');
		$no_ktp = $this->input->post('xno_ktp');
		$jenkel = $this->input->post('xjenkel');
		$username = $this->input->post('xusername');
		$password = $this->input->post('xpassword');
		$konfirm_password = $this->input->post('xpassword2');
		$nohp = $this->input->post('xkontak');
		$level = $this->input->post('xlevel');
		if ($password <> $konfirm_password) {
			echo $this->session->set_flashdata('msg', 'error');
			redirect('admin/pengguna');
		}
		$this->m_pengguna->simpan_pengguna($nama, $no_ktp, $jenkel, $username, $password, $nohp, $level, $gambar, $foto_ktp);
		echo $this->session->set_flashdata('msg', 'success');
		redirect('admin/pengguna');
	}

	function update_pengguna()
	{

		$config['upload_path'] = './assets/images/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '60%';
				$config['width'] = 300;
				$config['height'] = 300;
				$config['new_image'] = './assets/images/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];
				$kode = $this->input->post('kode');
				$nama = $this->input->post('xnama');
				$jenkel = $this->input->post('xjenkel');
				$username = $this->input->post('xusername');
				$password = $this->input->post('xpassword');
				$konfirm_password = $this->input->post('xpassword2');
				$nohp = $this->input->post('xkontak');
				$level = $this->input->post('xlevel');
				if (empty($password) && empty($konfirm_password)) {
					$this->m_pengguna->update_pengguna_tanpa_pass($kode, $nama, $jenkel, $username, $password, $nohp, $level, $gambar);
					echo $this->session->set_flashdata('msg', 'info');
					redirect('admin/pengguna');
				} elseif ($password <> $konfirm_password) {
					echo $this->session->set_flashdata('msg', 'error');
					redirect('admin/pengguna');
				} else {
					$this->m_pengguna->update_pengguna($kode, $nama, $jenkel, $username, $password, $nohp, $level, $gambar);
					echo $this->session->set_flashdata('msg', 'info');
					redirect('admin/pengguna');
				}
			} else {
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/pengguna');
			}
		} else {
			$kode = $this->input->post('kode');
			$nama = $this->input->post('xnama');
			$jenkel = $this->input->post('xjenkel');
			$username = $this->input->post('xusername');
			$password = $this->input->post('xpassword');
			$konfirm_password = $this->input->post('xpassword2');
			$nohp = $this->input->post('xkontak');
			$level = $this->input->post('xlevel');
			if (empty($password) && empty($konfirm_password)) {
				$this->m_pengguna->update_pengguna_tanpa_pass_dan_gambar($kode, $nama, $jenkel, $username, $password, $nohp, $level);
				echo $this->session->set_flashdata('msg', 'info');
				redirect('admin/pengguna');
			} elseif ($password <> $konfirm_password) {
				echo $this->session->set_flashdata('msg', 'error');
				redirect('admin/pengguna');
			} else {
				$this->m_pengguna->update_pengguna_tanpa_gambar($kode, $nama, $jenkel, $username, $password, $nohp, $level);
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/pengguna');
			}
		}
	}

	function hapus_pengguna()
	{
		$kode = $this->input->post('kode');
		$data = $this->m_pengguna->get_pengguna_login($kode);
		$q = $data->row_array();
		$p = $q['pengguna_photo'];
		$path = base_url() . 'assets/images/' . $p;
		delete_files($path);
		$this->m_pengguna->hapus_pengguna($kode);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('admin/pengguna');
	}

	function reset_password()
	{

		$id = $this->uri->segment(4);
		$get = $this->m_pengguna->getusername($id);
		if ($get->num_rows() > 0) {
			$a = $get->row_array();
			$b = $a['pengguna_username'];
		}
		$pass = rand(123456, 999999);
		$this->m_pengguna->resetpass($id, $pass);
		echo $this->session->set_flashdata('msg', 'show-modal');
		echo $this->session->set_flashdata('uname', $b);
		echo $this->session->set_flashdata('upass', $pass);
		redirect('admin/pengguna');
	}
}
