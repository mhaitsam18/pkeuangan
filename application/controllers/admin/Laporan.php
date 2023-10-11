<?php

class Laporan extends CI_Controller
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
        $this->load->model('M_laporan');
    }

    function index()
    {
        $this->load->view('/admin/laporan/index');
    }
    function pemasukan()
    {
        $this->load->view('/admin/laporan/laporan-pemasukan');
    }
    function pengeluaran()
    {
        $this->load->view('/admin/laporan/laporan-pengeluaran');
    }
    function tabungan()
    {
        $this->load->view('/admin/laporan/laporan-tabungan');
    }
    function hutang()
    {
        $this->load->view('/admin/laporan/laporan-hutang');
    }

    public function pemasukanh()
    {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data = array(
            'id'    => $id,
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->M_laporan->pemasukanh($id, $tanggal, $bulan, $tahun),
        );
        $this->load->view('/admin/laporan/pemasukanh', $data, FALSE);
    }

    public function pemasukanb()
    {
        $id = $this->input->post('id');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data = array(
            'id'    => $id,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->M_laporan->pemasukanb($id, $bulan, $tahun),
        );
        $this->load->view('/admin/laporan/pemasukanb', $data, FALSE);
    }

    public function pemasukant()
    {
        $id = $this->input->post('id');
        $tahun = $this->input->post('tahun');
        $data = array(
            'id'    => $id,
            'tahun' => $tahun,
            'laporan' => $this->M_laporan->pemasukant($id, $tahun),
        );
        $this->load->view('/admin/laporan/pemasukant', $data, FALSE);
    }

    public function pengh()
    {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data = array(
            'id'    => $id,
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->M_laporan->pengh($id, $tanggal, $bulan, $tahun),
        );
        $this->load->view('/admin/laporan/pengh', $data, FALSE);
    }

    public function pengb()
    {
        $id = $this->input->post('id');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data = array(
            'id'    => $id,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->M_laporan->pengb($id, $bulan, $tahun),
            'laporan_minggu1' => $this->M_laporan->pengRM1($id, $bulan, $tahun),
            'laporan_minggu2' => $this->M_laporan->pengRM2($id, $bulan, $tahun),
            'laporan_minggu3' => $this->M_laporan->pengRM3($id, $bulan, $tahun),
            'laporan_minggu4' => $this->M_laporan->pengRM4($id, $bulan, $tahun),
            'laporan_minggu5' => $this->M_laporan->pengRM5($id, $bulan, $tahun),
            't_laporan_minggu1' => $this->M_laporan->pengTM1($id, $bulan, $tahun),
            't_laporan_minggu2' => $this->M_laporan->pengTM2($id, $bulan, $tahun),
            't_laporan_minggu3' => $this->M_laporan->pengTM3($id, $bulan, $tahun),
            't_laporan_minggu4' => $this->M_laporan->pengTM4($id, $bulan, $tahun),
            't_laporan_minggu5' => $this->M_laporan->pengTM5($id, $bulan, $tahun),
        );
        $this->load->view('/admin/laporan/pengb', $data, FALSE);
    }

    public function pengt()
    {
        $id = $this->input->post('id');
        $tahun = $this->input->post('tahun');
        $data = array(
            'id'    => $id,
            'tahun' => $tahun,
            'laporan' => $this->M_laporan->pengt($id, $tahun),
            'laporan_bulan' => $this->M_laporan->pengRB($id, $tahun),
        );
        $this->load->view('/admin/laporan/pengt', $data, FALSE);
    }

    public function tabh()
    {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data = array(
            'id'    => $id,
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->M_laporan->tabh($id, $tanggal, $bulan, $tahun),
        );
        $this->load->view('/admin/laporan/tabunganh', $data, FALSE);
    }

    public function tabb()
    {
        $id = $this->input->post('id');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data = array(
            'id'    => $id,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->M_laporan->tabb($id, $bulan, $tahun),
        );
        $this->load->view('/admin/laporan/tabunganb', $data, FALSE);
    }

    public function tabt()
    {
        $id = $this->input->post('id');
        $tahun = $this->input->post('tahun');
        $data = array(
            'id'    => $id,
            'tahun' => $tahun,
            'laporan' => $this->M_laporan->tabt($id, $tahun),
        );
        $this->load->view('/admin/laporan/tabungant', $data, FALSE);
    }

    public function huth()
    {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data = array(
            'id'    => $id,
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->M_laporan->huth($id, $tanggal, $bulan, $tahun),
        );
        $this->load->view('/admin/laporan/huth', $data, FALSE);
    }

    public function hutb()
    {
        $id = $this->input->post('id');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data = array(
            'id'    => $id,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->M_laporan->hutb($id, $bulan, $tahun),
        );
        $this->load->view('/admin/laporan/hutb', $data, FALSE);
    }

    public function hutt()
    {
        $id = $this->input->post('id');
        $tahun = $this->input->post('tahun');
        $data = array(
            'id'    => $id,
            'tahun' => $tahun,
            'laporan' => $this->M_laporan->hutt($id, $tahun),
        );
        $this->load->view('/admin/laporan/hutt', $data, FALSE);
    }
}
