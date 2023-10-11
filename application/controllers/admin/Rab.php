<?php
class Rab extends CI_Controller
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
		if ($this->input->get('tahun')) {
			$tahun = $this->input->get('tahun');
		} else {
			$tahun = date('Y');
		}
		if ($this->input->get('bulan')) {
			$bulan = $this->input->get('bulan');
		} else {
			$bulan = date('m');
		}

		$user_id = $this->session->userdata('idadmin');
		$list_rab = $this->db->query("SELECT * FROM rab WHERE user_id = $user_id AND bulan = $bulan AND tahun = $tahun");
		if ($list_rab->num_rows() <= 0) {
			$this->rab->insertDefaultRab($user_id, $bulan, $tahun);
			$list_rab = $this->db->query("SELECT * FROM rab WHERE user_id = $user_id AND bulan = $bulan AND tahun = $tahun");
		}
		$items = $this->get_all('pos');
		$per = $this->get_all('persen');
		$persen = $this->db->query("SELECT SUM(persen) AS persen FROM rab WHERE user_id = '$user_id' AND bulan = $bulan AND tahun = $tahun")->row();
		$list_rab = $this->db->query("SELECT * FROM rab WHERE user_id = $user_id AND bulan = $bulan AND tahun = $tahun");
		$totalPersen = $persen->persen;
		$this->load->view('/admin/rab/index', array(
			'items' => $items,
			$per,
			'totalPersen' => $totalPersen,
			'tahun' => date('Y'),
			'bulan' => $bulan,
			'list_rab' => $list_rab,
		));
	}

	public function rab()
	{
		// $tahun = date('Y');
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$items = $this->get_all('pos');
		$per = $this->get_all('persen');
		$user_id = $this->session->userdata('idadmin');

		$list_rab = $this->db->query("SELECT * FROM rab WHERE user_id = $user_id AND bulan = $bulan AND tahun = $tahun");
		if ($list_rab->num_rows() <= 0) {
			$this->rab->insertDefaultRab($user_id, $bulan, $tahun);
			$list_rab = $this->db->query("SELECT * FROM rab WHERE user_id = $user_id AND bulan = $bulan AND tahun = $tahun");
		}
		$persen = $this->db->query("SELECT SUM(persen) AS persen FROM rab WHERE user_id = $user_id AND bulan = $bulan AND tahun = $tahun")->row();
		$totalPersen = $persen->persen;
		return $this->load->view('/member/rab/list-rab', array(
			'items' => $items,
			$per,
			'totalPersen' => $totalPersen,
			'tahun' => $tahun,
			'bulan' => $bulan,
			'list_rab' => $list_rab,
		));
	}
	public function rabBulan()
	{
		$user_id = $this->session->userdata('idadmin');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$total_persen = $this->cekpersen($user_id, $bulan, $tahun);

		echo json_encode(['total_persen' => $total_persen]);
	}

	function create()
	{

		if ($this->is_post()) {
			$max_id = $this->db->query('select max(id) as max from rab')->row();
			$nama = $this->input->post('nama');
			$tahun = date('Y');
			$bulan = $this->input->post('bulan');
			$user_id = $this->input->post('user_id');
			$persen = str_replace(',', '.', $this->input->post('persen'));
			$max = $this->input->post('max');
			$min = $this->input->post('min');
			$post = array(
				'nama' => $nama,
				'pos_id' => null,
				'user_id' => $user_id,
				'persen' => $persen,
				'max' => $max,
				'min' => $min,
				'bulan' => $bulan,
				'tahun' => $tahun,
				'is_default' => 0,
			);
			if ($persen + $this->cekpersen($user_id, $bulan, $tahun) <= 100) {
				$this->db->insert('rab', $post);
				$this->session->set_flashdata('success', 'Data has been successfully');
			} else {
				$this->session->set_flashdata('error', 'Persen Melebihi 100%');
			}
			redirect('/admin/rab/index?bulan=' . $bulan);
		}
		$user_id = $this->session->userdata('idadmin');
		$bulan = $this->input->get('bulan');
		$tahun = date('Y');
		$this->db->select("SUM(jumlah) AS total_pemasukan");
		$pemasukan = $this->db->get_where('pemasukan', [
			'user_id' => $user_id,
			'MONTH(tanggal)' => $bulan,
			'YEAR(tanggal)' => $tahun
		])->row()->total_pemasukan;
		if (!$pemasukan) {
			$pemasukan = 0;
		}

		$data['pemasukan'] = $pemasukan;
		$data['bulan'] = $bulan;
		$data['totalPersen'] = $this->db->query("SELECT SUM(persen) AS total_persen FROM rab WHERE user_id = $user_id AND bulan = $bulan AND tahun = $tahun")->row()->total_persen;
		$this->load->view('admin/rab/form', $data);
	}

	function update($id)
	{
		$user_id = $this->session->userdata('idadmin');
		if ($this->is_post()) {
			$persen_post = str_replace(',', '.', $this->input->post('persen'));
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$max = $this->input->post('max');
			$min = $this->input->post('min');
			$post = array(
				'persen' => $persen_post,
			);

			$query = $this->db->query("select * from rab where id = $id")->row();
			if ($max > 0) {
				if ($persen_post > $max) {
					$this->session->set_flashdata('error', 'Persen tidak dapat lebih dari ' . $max . '%');
					redirect('admin/rab/index?bulan=' . $bulan);
				}

				if ($persen_post < $min) {
					$this->session->set_flashdata('error', 'Persen tidak dapat kurang dari ' . $min . '%');
					redirect('admin/rab/index?bulan=' . $bulan);
				}
			}
			$persen = $this->db->query("SELECT * FROM rab WHERE id != $id AND user_id = $user_id AND bulan = $bulan AND tahun = $tahun")->result_array();
			$total = 0;
			foreach ($persen as $row) {
				$total += $row['persen'];
			}
			if ($persen_post + $total <= 100) {
				$this->db->update('rab', $post, array('id' => $id));
				$this->session->set_flashdata('Success', 'Data has been Updated');
				redirect('admin/rab/index?bulan=' . $bulan);
			} else {
				$this->session->set_flashdata('error', 'Persen tidak dapat lebih dari 100%');
			}
		}
		$item = $this->db->query("SELECT * FROM rab WHERE id = $id")->row();
		$this->db->select("SUM(jumlah) AS total_pemasukan");
		$pemasukan = $this->db->get_where('pemasukan', [
			'user_id' => $user_id,
			'MONTH(tanggal)' => $item->bulan,
			'YEAR(tanggal)' => $item->tahun
		])->row()->total_pemasukan;
		if (!$pemasukan) {
			$pemasukan = 0;
		}
		$nominal = $pemasukan * $item->persen / 100;
		$totalPersen = $this->db->query("SELECT SUM(persen) AS total_persen FROM rab WHERE user_id = $user_id AND bulan = $item->bulan AND tahun = $item->tahun")->row()->total_persen;
		$data = array(
			'rab'	=> $this->get_all('rab'),
			'item' => $item,
			'nominal' => $nominal,
			'pemasukan' => $pemasukan,
			'totalPersen' => $totalPersen,
		);
		$this->load->view('admin/rab/edit', $data);
	}
	public function persentase()
	{
		$pemasukan = $this->input->post('pemasukan');
		$nominal = $this->input->post('nominal');
		if ($pemasukan != 0) {
			$persentase = $nominal / $pemasukan * 100;
		} else {
			$persentase = 0;
		}
		echo $persentase;
	}

	public function nominal()
	{
		$pemasukan = $this->input->post('pemasukan');
		$persentase = $this->input->post('persentase');
		$nominal = $pemasukan * $persentase / 100;

		echo $nominal;
	}

	function delete($id = false)
	{
		if ($id) {
			if ($this->db->delete('rab', array('id' => $id))) {
				$this->session->set_flashdata('success', 'Data has been Deleted');
			} else {
				$this->session->set_flashdata('error', 'Unknown error, please try again');
			}
			redirect('admin/rab');
		}
	}

	function cekpersen($user_id, $bulan, $tahun)
	{
		$persen = $this->db->query("SELECT SUM(persen) AS persen FROM rab WHERE user_id = $user_id AND bulan = $bulan AND tahun = $tahun")->row();
		$totalPersen = $persen->persen;
		return $totalPersen;
	}
}
