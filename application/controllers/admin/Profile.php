<?php

class Profile extends CI_Controller
{
	private $data = array();
	private $where;

	function __construct()
	{
		Parent::__construct();
		if (!isset($_SESSION['logged_in'])) {
			$url = base_url('auth');
			redirect($url);
		};
		$this->load->model('m_pengguna');
	}
	function index()
	{
		$kode = $this->session->userdata('idadmin');
		$x['user'] = $this->m_pengguna->get_pengguna_login($kode);
		$x['data'] = $this->m_pengguna->get_all_pengguna();
		$this->load->view('admin/profile/index', $x);
	}

	function update_pengguna()
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
				$kode = $this->input->post('kode');
				$nama = $this->input->post('xnama');
				$jenkel = $this->input->post('xjenkel');
				$username = $this->input->post('xusername');
				$password = $this->input->post('xpassword');
				$konfirm_password = $this->input->post('xpassword2');
				$email = $this->input->post('xemail');
				$nohp = $this->input->post('xkontak');
				$level = $this->input->post('xlevel');
				if (empty($password) && empty($konfirm_password)) {
					$this->m_pengguna->update_pengguna_profil_tanpa_pass($kode, $nama, $jenkel, $username, $email, $nohp, $level, $gambar);
					echo $this->session->set_flashdata('msg', 'info');
					redirect('admin/profile');
				} elseif ($password <> $konfirm_password) {
					echo $this->session->set_flashdata('msg', 'error');
					redirect('admin/profile');
				} else {
					$this->m_pengguna->update_pengguna_profil($kode, $nama, $jenkel, $username, md5($password), $email, $nohp, $level, $gambar);
					echo $this->session->set_flashdata('msg', 'info');
					redirect('admin/profile');
				}
			} else {
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/profile');
			} 
		} else {
			$kode = $this->input->post('kode');
			$nama = $this->input->post('xnama');
			$jenkel = $this->input->post('xjenkel');
			$username = $this->input->post('xusername');
			$password = $this->input->post('xpassword');
			$konfirm_password = $this->input->post('xpassword2');
			$email = $this->input->post('xemail');
			$nohp = $this->input->post('xkontak');
			$level = $this->input->post('xlevel');
			if (empty($password) && empty($konfirm_password)) {
				$this->m_pengguna->update_pengguna_tanpa_pass_dan_gambar($kode, $nama, $jenkel, $username, $password, $nohp, $level);
				echo $this->session->set_flashdata('msg', 'info');
				redirect('admin/profile');
			} elseif ($password <> $konfirm_password) {
				echo $this->session->set_flashdata('msg', 'error');
				redirect('admin/profile');
			} else {
				$this->m_pengguna->update_pengguna_tanpa_gambar($kode, $nama, $jenkel, $username, $password, $nohp, $level);
				echo $this->session->set_flashdata('msg', 'warning');
				redirect('admin/profile');
			}
		}
	}
}
