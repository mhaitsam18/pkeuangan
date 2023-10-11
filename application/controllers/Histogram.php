<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Histogram extends CI_Controller
{

    function __construct()
    {
        Parent::__construct();
        $this->load->model('M_laporan');
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function tabungan()
    {
        $user_id = $this->session->userdata('idadmin');
        $bulan = date('m');
        $tahun = date('Y');
        $avg_tabungan_minggu[1] = $this->M_laporan->tabTM1($user_id, $bulan, $tahun) / 7;
        $avg_tabungan_minggu[2] = $this->M_laporan->tabTM2($user_id, $bulan, $tahun) / 7;
        $avg_tabungan_minggu[3] = $this->M_laporan->tabTM3($user_id, $bulan, $tahun) / 7;
        $avg_tabungan_minggu[4] = $this->M_laporan->tabTM4($user_id, $bulan, $tahun) / 7;
        $avg_tabungan_minggu[5] = $this->M_laporan->tabRM5($user_id, $bulan, $tahun);
        $sum_tabungan_minggu[1] = $this->M_laporan->tabTM1($user_id, $bulan, $tahun);
        $sum_tabungan_minggu[2] = $this->M_laporan->tabTM2($user_id, $bulan, $tahun);
        $sum_tabungan_minggu[3] = $this->M_laporan->tabTM3($user_id, $bulan, $tahun);
        $sum_tabungan_minggu[4] = $this->M_laporan->tabTM4($user_id, $bulan, $tahun);
        $sum_tabungan_minggu[5] = $this->M_laporan->tabTM5($user_id, $bulan, $tahun);


        $avg_tabungan_bulan = $this->M_laporan->tabTBbagi4minggu($user_id, $tahun);
        $sum_tabungan_bulan = $this->M_laporan->tabTB($user_id, $tahun);

        $this->db->distinct();
        $this->db->select("YEAR(tanggal) AS tahun");
        $data_tahun = $this->db->get_where('tabungan', [
            'user_id' => $user_id
        ])->result();
        $this->load->view('member/histogram/tabungan', [
            'tahun' => $tahun,
            'data_tahun' => $data_tahun,
            'bulan' => $bulan,
            'avg_tabungan_minggu' => $avg_tabungan_minggu,
            'sum_tabungan_minggu' => $sum_tabungan_minggu,
            'avg_tabungan_bulan' => $avg_tabungan_bulan,
            'sum_tabungan_bulan' => $sum_tabungan_bulan,
        ]);
    }

    public function tabungan_mingguan()
    {
        $user_id = $this->session->userdata('idadmin');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $avg_tabungan_minggu[1] = $this->M_laporan->tabTM1($user_id, $bulan, $tahun) / 7;
        $avg_tabungan_minggu[2] = $this->M_laporan->tabTM2($user_id, $bulan, $tahun) / 7;
        $avg_tabungan_minggu[3] = $this->M_laporan->tabTM3($user_id, $bulan, $tahun) / 7;
        $avg_tabungan_minggu[4] = $this->M_laporan->tabTM4($user_id, $bulan, $tahun) / 7;
        $avg_tabungan_minggu[5] = $this->M_laporan->tabRM5($user_id, $bulan, $tahun);
        $sum_tabungan_minggu[1] = $this->M_laporan->tabTM1($user_id, $bulan, $tahun);
        $sum_tabungan_minggu[2] = $this->M_laporan->tabTM2($user_id, $bulan, $tahun);
        $sum_tabungan_minggu[3] = $this->M_laporan->tabTM3($user_id, $bulan, $tahun);
        $sum_tabungan_minggu[4] = $this->M_laporan->tabTM4($user_id, $bulan, $tahun);
        $sum_tabungan_minggu[5] = $this->M_laporan->tabTM5($user_id, $bulan, $tahun);

        $this->load->view('member/histogram/tabungan-mingguan', [
            'tahun' => $tahun,
            'bulan' => $bulan,
            'avg_tabungan_minggu' => $avg_tabungan_minggu,
            'sum_tabungan_minggu' => $sum_tabungan_minggu,
        ]);
    }
    public function tabungan_bulanan()
    {
        $user_id = $this->session->userdata('idadmin');
        $tahun = $this->input->post('tahun');


        $avg_tabungan_bulan = $this->M_laporan->tabTBbagi4minggu($user_id, $tahun);
        $sum_tabungan_bulan = $this->M_laporan->tabTB($user_id, $tahun);

        $this->load->view('member/histogram/tabungan-bulanan', [
            'tahun' => $tahun,
            'avg_tabungan_bulan' => $avg_tabungan_bulan,
            'sum_tabungan_bulan' => $sum_tabungan_bulan,
        ]);
    }



    public function pengeluaran()
    {
        $user_id = $this->session->userdata('idadmin');
        $bulan = date('m');
        $tahun = date('Y');
        $avg_pengeluaran_minggu[1] = $this->M_laporan->pengTM1($user_id, $bulan, $tahun) / 7;
        $avg_pengeluaran_minggu[2] = $this->M_laporan->pengTM2($user_id, $bulan, $tahun) / 7;
        $avg_pengeluaran_minggu[3] = $this->M_laporan->pengTM3($user_id, $bulan, $tahun) / 7;
        $avg_pengeluaran_minggu[4] = $this->M_laporan->pengTM4($user_id, $bulan, $tahun) / 7;
        $avg_pengeluaran_minggu[5] = $this->M_laporan->pengRM5($user_id, $bulan, $tahun);
        $sum_pengeluaran_minggu[1] = $this->M_laporan->pengTM1($user_id, $bulan, $tahun);
        $sum_pengeluaran_minggu[2] = $this->M_laporan->pengTM2($user_id, $bulan, $tahun);
        $sum_pengeluaran_minggu[3] = $this->M_laporan->pengTM3($user_id, $bulan, $tahun);
        $sum_pengeluaran_minggu[4] = $this->M_laporan->pengTM4($user_id, $bulan, $tahun);
        $sum_pengeluaran_minggu[5] = $this->M_laporan->pengTM5($user_id, $bulan, $tahun);


        $avg_pengeluaran_bulan = $this->M_laporan->pengTBbagi4minggu($user_id, $tahun);
        $sum_pengeluaran_bulan = $this->M_laporan->pengTB($user_id, $tahun);

        $avg_pengeluaran_10_tahun = $this->M_laporan->pengR10T($user_id);
        $sum_pengeluaran_10_tahun = $this->M_laporan->pengT10T($user_id);

        $this->db->distinct();
        $this->db->select("YEAR(tanggal) AS tahun");
        $data_tahun = $this->db->get_where('pengeluaran', [
            'user_id' => $user_id
        ])->result();
        $this->load->view('member/histogram/pengeluaran', [
            'tahun' => $tahun,
            'data_tahun' => $data_tahun,
            'bulan' => $bulan,
            'avg_pengeluaran_minggu' => $avg_pengeluaran_minggu,
            'sum_pengeluaran_minggu' => $sum_pengeluaran_minggu,
            'avg_pengeluaran_bulan' => $avg_pengeluaran_bulan,
            'sum_pengeluaran_bulan' => $sum_pengeluaran_bulan,
            'avg_pengeluaran_10_tahun' => $avg_pengeluaran_10_tahun,
            'sum_pengeluaran_10_tahun' => $sum_pengeluaran_10_tahun,
        ]);
    }

    public function pengeluaran_mingguan()
    {
        $user_id = $this->session->userdata('idadmin');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $avg_pengeluaran_minggu[1] = $this->M_laporan->pengTM1($user_id, $bulan, $tahun) / 7;
        $avg_pengeluaran_minggu[2] = $this->M_laporan->pengTM2($user_id, $bulan, $tahun) / 7;
        $avg_pengeluaran_minggu[3] = $this->M_laporan->pengTM3($user_id, $bulan, $tahun) / 7;
        $avg_pengeluaran_minggu[4] = $this->M_laporan->pengTM4($user_id, $bulan, $tahun) / 7;
        $avg_pengeluaran_minggu[5] = $this->M_laporan->pengRM5($user_id, $bulan, $tahun);
        $sum_pengeluaran_minggu[1] = $this->M_laporan->pengTM1($user_id, $bulan, $tahun);
        $sum_pengeluaran_minggu[2] = $this->M_laporan->pengTM2($user_id, $bulan, $tahun);
        $sum_pengeluaran_minggu[3] = $this->M_laporan->pengTM3($user_id, $bulan, $tahun);
        $sum_pengeluaran_minggu[4] = $this->M_laporan->pengTM4($user_id, $bulan, $tahun);
        $sum_pengeluaran_minggu[5] = $this->M_laporan->pengTM5($user_id, $bulan, $tahun);

        $this->load->view('member/histogram/pengeluaran-mingguan', [
            'tahun' => $tahun,
            'bulan' => $bulan,
            'avg_pengeluaran_minggu' => $avg_pengeluaran_minggu,
            'sum_pengeluaran_minggu' => $sum_pengeluaran_minggu,
        ]);
    }
    public function pengeluaran_bulanan()
    {
        $user_id = $this->session->userdata('idadmin');
        $tahun = $this->input->post('tahun');


        $avg_pengeluaran_bulan = $this->M_laporan->pengTBbagi4minggu($user_id, $tahun);
        $sum_pengeluaran_bulan = $this->M_laporan->pengTB($user_id, $tahun);

        $this->load->view('member/histogram/pengeluaran-bulanan', [
            'tahun' => $tahun,
            'avg_pengeluaran_bulan' => $avg_pengeluaran_bulan,
            'sum_pengeluaran_bulan' => $sum_pengeluaran_bulan,
        ]);
    }
}
