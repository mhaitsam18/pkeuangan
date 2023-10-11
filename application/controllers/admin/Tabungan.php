<?php
class Tabungan extends CI_Controller
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
		$items = $this->get_all('tabungan');

		$this->db->distinct();
		$this->db->select("YEAR(tanggal) AS tahun");
		$tahun = $this->db->get('tabungan')->result();
		$this->load->view('/admin/tabungan/index', array(
			'items' => $items,
			'data_tahun' => $tahun,
			'tahun' => date('Y'),
		));
	}

	public function box()
	{
		$tahun = $this->input->post('tahun');

		$items = $this->db->get_where('tabungan', [
			'YEAR(tanggal)' => $tahun
		]);
		$this->load->view('/admin/tabungan/box-tahun', array(
			'items' => $items,
			'tahun' => $tahun,
		));
	}
	public function table()
	{
		$tahun = $this->input->post('tahun');

		$items = $this->db->get_where('tabungan', [
			'YEAR(tanggal)' => $tahun
		]);
		$this->load->view('/admin/tabungan/table-tahun', array(
			'items' => $items,
			'tahun' => $tahun,
		));
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

			if ($this->input->post('channel') == 'others') {
				if ($this->input->post('othercolor')) {
					$post = array(
						'user_id' => $this->input->post('user_id'),
						'jumlah' => $this->input->post('jumlah'),
						'keterangan' => $this->input->post('keterangan'),
						'penyimpanan' => "Tabungan",
						'tanggal' => $this->input->post('tanggal'),
						'channel' => $this->input->post('othercolor'),
					);
				} else {
					$post = array(
						'user_id' => $this->input->post('user_id'),
						'jumlah' => $this->input->post('jumlah'),
						'keterangan' => $this->input->post('keterangan'),
						'penyimpanan' => "Tabungan",
						'tanggal' => $this->input->post('tanggal'),
						'channel' => $this->input->post('channel'),
					);
				}
			} else {
				$post = array(
					'user_id' => $this->input->post('user_id'),
					'jumlah' => $this->input->post('jumlah'),
					'keterangan' => $this->input->post('keterangan'),
					'penyimpanan' => "Tabungan",
					'tanggal' => $this->input->post('tanggal'),
					'channel' => $this->input->post('channel'),
				);
			}

			$tahun = date('Y', strtotime($this->input->post('tanggal')));
			$bulan = date('m', strtotime($this->input->post('tanggal')));

			$rab_id = $this->db->get_where('rab', [
				'bulan' => $bulan,
				'tahun' => $tahun,
				'pos_id' => 2,
				'user_id' => $this->input->post('user_id'),
			])->row()->id;
			$this->db->insert('pengeluaran', [
				'user_id' => $this->input->post('user_id'),
				'jumlah' => $this->input->post('jumlah'),
				'keterangan' => $this->input->post('keterangan'),
				'tanggal' => $this->input->post('tanggal'),
				'rab_id' => $rab_id,
			]);
			$post['pengeluaran_id'] = $this->db->insert_id();
			$save = $this->db->insert('tabungan', $post);
			if ($save) {
				$this->session->set_flashdata('success', 'Data has been successfully');
			} else {
				$this->session->set_flashdata('error', 'Unknwon error, please try again');
			}
			redirect('/admin/tabungan');
		}
		$this->load->view('admin/tabungan/form');
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
			$item = $this->get('tabungan', $id);
			if (!empty($_FILES['images']['name'])) {
				unlink('http://localhost/assets/images/' . $item->images);
			}

			if ($this->input->post('channel') == 'others') {
				if ($this->input->post('othercolor')) {
					$post = array(
						'jumlah' => $this->input->post('jumlah'),
						'keterangan' => $this->input->post('keterangan'),
						'penyimpanan' => "Tabungan",
						'tanggal' => $this->input->post('tanggal'),
						'channel' => $this->input->post('othercolor'),
					);
				} else {
					$post = array(
						'jumlah' => $this->input->post('jumlah'),
						'keterangan' => $this->input->post('keterangan'),
						'penyimpanan' => "Tabungan",
						'tanggal' => $this->input->post('tanggal'),
						'channel' => $this->input->post('channel'),
					);
				}
			} else {
				$post = array(
					'jumlah' => $this->input->post('jumlah'),
					'keterangan' => $this->input->post('keterangan'),
					'penyimpanan' => "Tabungan",
					'tanggal' => $this->input->post('tanggal'),
					'channel' => $this->input->post('channel'),
				);
			}
			$tahun = date('Y', strtotime($this->input->post('tanggal')));
			$bulan = date('m', strtotime($this->input->post('tanggal')));

			$rab_id = $this->db->get_where('rab', [
				'bulan' => $bulan,
				'tahun' => $tahun,
				'pos_id' => 2,
				'user_id' => $this->input->post('user_id')
			])->row()->id;

			$this->db->where('id', $this->input->post('pengeluaran_id'));
			$this->db->update('pengeluaran', [
				'jumlah' => $this->input->post('jumlah'),
				'keterangan' => $this->input->post('keterangan'),
				'tanggal' => $this->input->post('tanggal'),
				'rab_id' => $rab_id,
			]);

			$this->db->where('id', $id);
			$save = $this->db->update('tabungan', $post);
			if ($save) {
				$this->session->set_flashdata('success', 'Data has been successfully');
			} else {
				$this->session->set_flashdata('error', 'Unknwon error, please try again');
			}
			redirect('/admin/tabungan');
		}
		$item = $this->get('tabungan', $id);
		$data = array(
			'tabungan'	=> $this->get_all('tabungan'),
			'item' => $item
		);
		$this->load->view('admin/tabungan/edit', $data);
	}

	function delete($id = false)
	{
		if ($id) {
			// $pengeluaran_id = $this->db->get_where('tabungan', ['id' => $id])->row()->pengeluaran_id;
			$item = $this->get('tabungan', $id);
			if ($item && isset($item)) {
				unlink('assets/images/struktur' . $item->images);
			}
			if ($this->db->delete('tabungan', array('id' => $id))) {
				$this->db->delete('pengeluaran', ['id' => $item->pengeluaran_id]);
				$this->session->set_flashdata('success', 'Data has been Deleted');
			} else {
				$this->session->set_flashdata('error', 'Unknown error, please try again');
			}
			redirect('admin/tabungan');
		}
	}
}
