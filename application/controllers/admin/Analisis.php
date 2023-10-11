<?php

class Analisis extends CI_Controller
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

		$this->load->view('/admin/analisis/index', array(
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
		return $this->load->view('/member/analisis/list-rab-pengeluaran', array(
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
}
