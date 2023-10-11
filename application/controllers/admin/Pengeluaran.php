<?php

class Pengeluaran extends CI_Controller
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
	}

	function index()
	{
		// $pengeluaran = $this->db
		// 	->select('*')
		// 	->from('pengeluaran')
		// 	->join('rab', 'rab.id=pengeluaran.rab_id');
		// $this->db->last_query();

		$tahun = date('Y');
		if ($this->input->get('bulan')) {
			$bulan = $this->input->get('bulan');
		} else {
			$bulan = date('m');
		}
		$items = $this->get_all('pos');
		$per = $this->get_all('persen');
		$user_id = $this->session->userdata('idadmin');



		$totalPersen = $this->persentasePengeluaran($user_id, $bulan, $tahun);

		$list_rab = $this->db->query("SELECT rab.*, SUM(jumlah) AS jumlah FROM rab
		LEFT JOIN pengeluaran ON pengeluaran.rab_id = rab.id
		WHERE rab.user_id = $user_id AND bulan = $bulan AND tahun = $tahun 
		GROUP BY rab.id");


		$jumlah_pemasukan = $this->db->query("SELECT SUM(jumlah) AS jumlah_pemasukan FROM pemasukan WHERE user_id=$user_id AND MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun")->row()->jumlah_pemasukan;

		$this->load->view('/admin/pengeluaran/index', array(
			'items' => $items,
			$per,
			'totalPersen' => $totalPersen,
			'tahun' => date('Y'),
			'bulan' => $bulan,
			'list_rab' => $list_rab,
			'jumlah_pemasukan' => $jumlah_pemasukan,
		));
	}

	public function rab()
	{
		$tahun = date('Y');
		$bulan = $this->input->post('bulan');
		$items = $this->get_all('pos');
		$per = $this->get_all('persen');
		$user_id = $this->session->userdata('idadmin');



		$totalPersen = $this->persentasePengeluaran($user_id, $bulan, $tahun);

		$list_rab = $this->db->query("SELECT rab.*, SUM(jumlah) AS jumlah FROM rab
		LEFT JOIN pengeluaran ON pengeluaran.rab_id = rab.id
		WHERE rab.user_id = $user_id AND bulan = $bulan AND tahun = $tahun 
		GROUP BY rab.id");
		if ($list_rab->num_rows() <= 0) {
			$this->rab->insertDefaultRab($user_id, $bulan, $tahun);
			$list_rab = $this->db->query("SELECT *, SUM(jumlah) AS jumlah FROM rab
			LEFT JOIN pengeluaran ON pengeluaran.rab_id = rab.id
			WHERE rab.user_id = $user_id AND bulan = $bulan AND tahun = $tahun
			GROUP BY rab.id");
		}





		$jumlah_pemasukan = $this->db->query("SELECT SUM(jumlah) AS jumlah_pemasukan FROM pemasukan WHERE user_id=$user_id AND MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun")->row()->jumlah_pemasukan;
		return $this->load->view('/member/pengeluaran/list-rab', array(
			'items' => $items,
			$per,
			'totalPersen' => $totalPersen,
			'tahun' => date('Y'),
			'bulan' => $bulan,
			'list_rab' => $list_rab,
			'jumlah_pemasukan' => $jumlah_pemasukan,
		));
	}
	public function rabBulan()
	{
		$user_id = $this->session->userdata('idadmin');
		$bulan = $this->input->post('bulan');
		$tahun = date('Y');
		$total_persen = $this->cekpersen($user_id, $bulan, $tahun);

		echo json_encode(['total_persen' => $total_persen]);
	}

	function cekpersen($user_id, $bulan, $tahun)
	{
		$persen = $this->db->query("SELECT SUM(persen) AS persen FROM rab WHERE user_id = $user_id AND bulan = $bulan AND tahun = $tahun")->row();
		$totalPersen = $persen->persen;
		return $totalPersen;
	}

	public function persentasePengeluaran($user_id = null, $bulan = null, $tahun = null)
	{
		$pengeluaran = $this->db->query("SELECT SUM(jumlah) AS jumlah_total FROM pengeluaran WHERE user_id = '$user_id' AND MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun")->row()->jumlah_total;

		$pemasukan = $this->db->query("SELECT SUM(jumlah) AS jumlah_total FROM pemasukan WHERE user_id = '$user_id' AND MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun")->row()->jumlah_total;
		if ($pemasukan != 0) {
			$persen = $pengeluaran / $pemasukan * 100;
		} else {
			$persen = 100;
		}
		return $persen;
	}

	function create()
	{

		if ($this->is_post()) {
			$user_id = $this->session->userdata('idadmin');
			$tahun = date('Y', strtotime($this->input->post('tanggal')));
			$bulan = date('m', strtotime($this->input->post('tanggal')));
			$list_rab = $this->db->query("SELECT * FROM rab WHERE user_id = $user_id AND bulan = $bulan AND tahun = $tahun");
			if ($list_rab->num_rows() <= 0) {
				$this->rab->insertDefaultRab($user_id, $bulan, $tahun);
				$list_rab = $this->db->query("SELECT * FROM rab WHERE user_id = $user_id AND bulan = $bulan AND tahun = $tahun");
			}
			$post = array(
				"user_id" => $this->input->post('user_id'),
				"jumlah" => $this->input->post('jumlah'),
				"tanggal" => $this->input->post('tanggal'),
				"keterangan" => $this->input->post('keterangan'),
				"rab_id" => $this->input->post('rab_id'),
			);
			if ($this->db->insert('pengeluaran', $post)) {
				$pengeluaran_id = $this->db->insert_id();
				if ($this->input->post("nama_rab") == "tabungan" || $this->input->post("nama_rab") == "Tabungan") {
					$this->db->insert('tabungan', [
						'user_id' => $this->input->post('user_id'),
						'jumlah' => $this->input->post('jumlah'),
						'tanggal' => $this->input->post('tanggal'),
						'keterangan' => $this->input->post('keterangan'),
						'penyimpanan' => "Tabungan",
						'channel' => $this->input->post('channel'),
						'pengeluaran_id' => $pengeluaran_id,
					]);
				}
				$this->session->set_flashdata('success', 'Data has been successfully');
			} else {
				$this->session->set_flashdata('error', 'Unknwon error, please try again');
			}
			$data = $this->db->query("select * from pengeluaran where rab_id = " . $this->input->post('rab_id'))->row();
			$rab_id = $data->rab_id;
			$nama_rab = $this->db->query("select * from rab where id = $rab_id")->row();
			redirect('admin/pengeluaran/page/' . $rab_id);
		}
	}

	function update($id)
	{
		$post = $this->input->post();

		if ($this->is_post()) {
			// $config['upload_path'] = './assets/images/struktur/';
			// $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			// $config['encrypt_name'] = TRUE;

			// $this->upload->initialize($config);
			// if(!empty($_FILES['images']['name'])){
			// 	if($this->upload->do_upload('images')){
			// 		$file=$this->upload->data();
			// 		$post['images'] = $file['file_name'];
			// 	}
			// }
			// $item = $this->get('pengeluaran',$id);
			// if(!empty($_FILES['images']['name'])){
			// 	unlink('http://localhost/BPMP/assets/images/cars/'.$item->images);
			// }
			$data = $this->db->query("select * from pengeluaran where id = $id")->row();
			$rab_id = $data->rab_id;
			$nama_rab = $this->db->query("select * from rab where id = $rab_id")->row();
			$nama = $nama_rab->nama;

			$this->db->where('id', $id);
			if ($this->db->update('pengeluaran', [
				'jumlah' => $this->input->post('jumlah'),
				'keterangan' => $this->input->post('keterangan'),
				'tanggal' => $this->input->post('tanggal'),
			])) {
				if ($this->input->post("nama_rab") == "tabungan" || $this->input->post("nama_rab") == "Tabungan") {
					$this->db->where('pengeluaran_id', $id);
					$this->db->update('tabungan', [
						'jumlah' => $this->input->post('jumlah'),
						'tanggal' => $this->input->post('tanggal'),
						'keterangan' => $this->input->post('keterangan'),
					]);
				}
				$this->session->set_flashdata('Success', 'Data has been Updated');
				redirect('admin/pengeluaran/page/' . $rab_id . '/' . $nama);
			} else {
				$this->session->set_flashdata('error', 'Unknown error, please try again');
			}
		}
		$item = $this->get('pengeluaran', $id);
		$data = array(
			'pengeluaran'	=> $this->get_all('pengeluaran'),
			'item' => $item
		);
		$this->load->view('admin/pengeluaran/edit', $data);
	}

	function delete($id = false)
	{
		if ($id) {
			$data = $this->db->query("select * from pengeluaran where id = $id")->row();
			$rab_id = $data->rab_id;
			$nama_rab = $this->db->query("select * from rab where id = $rab_id")->row();
			$nama = $nama_rab->nama;
			if ($this->db->delete('pengeluaran', array('id' => $id))) {
				$this->db->delete('tabungan', ['pengeluaran_id' => $id]);
				$this->session->set_flashdata('success', 'Data has been Deleted');
			} else {
				$this->session->set_flashdata('error', 'Unknown error, please try again');
			}
			redirect('admin/pengeluaran/page/' . $rab_id . '/' . $nama);
		}
	}

	function page($id, $nama = null)
	{
		$menu = $this->db->query('select * from rab where id = ' . $id)->row_array();
		// $items = $this->get_all('pengeluaran');
		$this->load->view('/admin/pengeluaran/pengeluaranRAB', array('menu' => $menu, 'nama_menu' => $menu['nama']));
	}
}
