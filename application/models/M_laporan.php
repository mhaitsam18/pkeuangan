<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{
    public function pemasukanh($id, $tanggal, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('pemasukan');
        $this->db->where('pemasukan.user_id', $id);
        $this->db->where('YEAR(pemasukan.tanggal)', $tahun);
        $this->db->where('MONTH(pemasukan.tanggal)', $bulan);
        $this->db->where('DAY(pemasukan.tanggal)', $tanggal);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }

    public function pemasukanb($id, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('pemasukan');
        $this->db->where('pemasukan.user_id', $id);
        $this->db->where('YEAR(pemasukan.tanggal)', $tahun);
        $this->db->where('MONTH(pemasukan.tanggal)', $bulan);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }

    public function pemasukant($id, $tahun)
    {
        $this->db->select('*');
        $this->db->from('pemasukan');
        $this->db->where('pemasukan.user_id', $id);
        $this->db->where('YEAR(pemasukan.tanggal)', $tahun);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }

    public function pengh($id, $tanggal, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->where('MONTH(pengeluaran.tanggal)', $bulan);
        $this->db->where('DAY(pengeluaran.tanggal)', $tanggal);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }

    public function pengb($id, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->where('MONTH(pengeluaran.tanggal)', $bulan);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }

    public function pengRM1($id, $bulan, $tahun)
    {
        $this->db->select('AVG(jumlah) AS avg_jumlah');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->where('MONTH(pengeluaran.tanggal)', $bulan);
        $this->db->where('DAY(pengeluaran.tanggal) >=', 1);
        $this->db->where('DAY(pengeluaran.tanggal) <=', 7);
        return $this->db->get()->row()->avg_jumlah;
    }
    public function pengRM2($id, $bulan, $tahun)
    {
        $this->db->select('AVG(jumlah) AS avg_jumlah');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->where('MONTH(pengeluaran.tanggal)', $bulan);
        $this->db->where('DAY(pengeluaran.tanggal) >=', 8);
        $this->db->where('DAY(pengeluaran.tanggal) <=', 14);
        return $this->db->get()->row()->avg_jumlah;
    }
    public function pengRM3($id, $bulan, $tahun)
    {
        $this->db->select('AVG(jumlah) AS avg_jumlah');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->where('MONTH(pengeluaran.tanggal)', $bulan);
        $this->db->where('DAY(pengeluaran.tanggal) >=', 15);
        $this->db->where('DAY(pengeluaran.tanggal) <=', 21);
        return $this->db->get()->row()->avg_jumlah;
    }
    public function pengRM4($id, $bulan, $tahun)
    {
        $this->db->select('AVG(jumlah) AS avg_jumlah');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->where('MONTH(pengeluaran.tanggal)', $bulan);
        $this->db->where('DAY(pengeluaran.tanggal) >=', 22);
        $this->db->where('DAY(pengeluaran.tanggal) <=', 28);
        return $this->db->get()->row()->avg_jumlah;
    }
    public function pengRM5($id, $bulan, $tahun)
    {
        $this->db->select('AVG(jumlah) AS avg_jumlah');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->where('MONTH(pengeluaran.tanggal)', $bulan);
        $this->db->where('DAY(pengeluaran.tanggal) >=', 29);
        return $this->db->get()->row()->avg_jumlah;
    }
    public function pengTM1($id, $bulan, $tahun)
    {
        $this->db->select('SUM(jumlah) AS sum_jumlah');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->where('MONTH(pengeluaran.tanggal)', $bulan);
        $this->db->where('DAY(pengeluaran.tanggal) >=', 1);
        $this->db->where('DAY(pengeluaran.tanggal) <=', 7);
        return $this->db->get()->row()->sum_jumlah;
    }
    public function pengTM2($id, $bulan, $tahun)
    {
        $this->db->select('SUM(jumlah) AS sum_jumlah');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->where('MONTH(pengeluaran.tanggal)', $bulan);
        $this->db->where('DAY(pengeluaran.tanggal) >=', 8);
        $this->db->where('DAY(pengeluaran.tanggal) <=', 14);
        return $this->db->get()->row()->sum_jumlah;
    }
    public function pengTM3($id, $bulan, $tahun)
    {
        $this->db->select('SUM(jumlah) AS sum_jumlah');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->where('MONTH(pengeluaran.tanggal)', $bulan);
        $this->db->where('DAY(pengeluaran.tanggal) >=', 15);
        $this->db->where('DAY(pengeluaran.tanggal) <=', 21);
        return $this->db->get()->row()->sum_jumlah;
    }
    public function pengTM4($id, $bulan, $tahun)
    {
        $this->db->select('SUM(jumlah) AS sum_jumlah');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->where('MONTH(pengeluaran.tanggal)', $bulan);
        $this->db->where('DAY(pengeluaran.tanggal) >=', 22);
        $this->db->where('DAY(pengeluaran.tanggal) <=', 28);
        return $this->db->get()->row()->sum_jumlah;
    }
    public function pengTM5($id, $bulan, $tahun)
    {
        $this->db->select('SUM(jumlah) AS sum_jumlah');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->where('MONTH(pengeluaran.tanggal)', $bulan);
        $this->db->where('DAY(pengeluaran.tanggal) >=', 29);
        return $this->db->get()->row()->sum_jumlah;
    }

    public function pengt($id, $tahun)
    {
        $this->db->select('*');
        $this->db->from('pengeluaran');
        $this->db->where('pengeluaran.user_id', $id);
        $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }

    public function pengRB($id, $tahun)
    {
        $avg_bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $this->db->select('AVG(jumlah) AS avg_jumlah');
            $this->db->from('pengeluaran');
            $this->db->where('pengeluaran.user_id', $id);
            $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
            $this->db->where('MONTH(pengeluaran.tanggal)', $i);
            $avg = $this->db->get()->row()->avg_jumlah;

            if ($avg) {
                $avg_bulan[$i] = $avg;
            } else {
                $avg_bulan[$i] = 0;
            }
        }
        return $avg_bulan;
    }
    public function pengTB($id, $tahun)
    {
        $sum_bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $this->db->select('SUM(jumlah) AS sum_jumlah');
            $this->db->from('pengeluaran');
            $this->db->where('pengeluaran.user_id', $id);
            $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
            $this->db->where('MONTH(pengeluaran.tanggal)', $i);
            $sum = $this->db->get()->row()->sum_jumlah;

            if ($sum) {
                $sum_bulan[$i] = $sum;
            } else {
                $sum_bulan[$i] = 0;
            }
        }
        return $sum_bulan;
    }
    public function pengTBbagi4minggu($id, $tahun)
    {
        $sum_bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $this->db->select('SUM(jumlah) AS sum_jumlah');
            $this->db->from('pengeluaran');
            $this->db->where('pengeluaran.user_id', $id);
            $this->db->where('YEAR(pengeluaran.tanggal)', $tahun);
            $this->db->where('MONTH(pengeluaran.tanggal)', $i);
            $sum = $this->db->get()->row()->sum_jumlah;

            if ($sum) {
                $sum_bulan[$i] = $sum / 4;
            } else {
                $sum_bulan[$i] = 0;
            }
        }
        return $sum_bulan;
    }
    public function pengR10T($id)
    {
        $avg_tahun = [];
        $tahun = date('Y') - 10;
        for ($i = $tahun; $i <= date('Y'); $i++) {
            $this->db->select('AVG(jumlah) AS avg_jumlah');
            $this->db->from('pengeluaran');
            $this->db->where('pengeluaran.user_id', $id);
            $this->db->where('YEAR(pengeluaran.tanggal)', $i);
            $avg = $this->db->get()->row()->avg_jumlah;

            if ($avg) {
                $avg_tahun[$i] = $avg;
            } else {
                $avg_tahun[$i] = 0;
            }
        }
        return $avg_tahun;
    }
    public function pengT10T($id)
    {
        $sum_tahun = [];
        $tahun = date('Y') - 10;
        for ($i = $tahun; $i <= date('Y'); $i++) {
            $this->db->select('SUM(jumlah) AS sum_jumlah');
            $this->db->from('pengeluaran');
            $this->db->where('pengeluaran.user_id', $id);
            $this->db->where('YEAR(pengeluaran.tanggal)', $i);
            $sum = $this->db->get()->row()->sum_jumlah;

            if ($sum) {
                $sum_tahun[$i] = $sum;
            } else {
                $sum_tahun[$i] = 0;
            }
        }
        return $sum_tahun;
    }

    public function tabh($id, $tanggal, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->where('MONTH(tabungan.tanggal)', $bulan);
        $this->db->where('DAY(tabungan.tanggal)', $tanggal);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }

    public function tabb($id, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->where('MONTH(tabungan.tanggal)', $bulan);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }
    public function tabRM1($id, $bulan, $tahun)
    {
        $this->db->select('AVG(jumlah) AS avg_jumlah');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->where('MONTH(tabungan.tanggal)', $bulan);
        $this->db->where('DAY(tabungan.tanggal) >=', 1);
        $this->db->where('DAY(tabungan.tanggal) <=', 7);
        $row = $this->db->get()->row()->avg_jumlah;
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }
    public function tabRM2($id, $bulan, $tahun)
    {
        $this->db->select('AVG(jumlah) AS avg_jumlah');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->where('MONTH(tabungan.tanggal)', $bulan);
        $this->db->where('DAY(tabungan.tanggal) >=', 8);
        $this->db->where('DAY(tabungan.tanggal) <=', 14);
        $row = $this->db->get()->row()->avg_jumlah;
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }
    public function tabRM3($id, $bulan, $tahun)
    {
        $this->db->select('AVG(jumlah) AS avg_jumlah');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->where('MONTH(tabungan.tanggal)', $bulan);
        $this->db->where('DAY(tabungan.tanggal) >=', 15);
        $this->db->where('DAY(tabungan.tanggal) <=', 21);
        $row = $this->db->get()->row()->avg_jumlah;
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }
    public function tabRM4($id, $bulan, $tahun)
    {
        $this->db->select('AVG(jumlah) AS avg_jumlah');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->where('MONTH(tabungan.tanggal)', $bulan);
        $this->db->where('DAY(tabungan.tanggal) >=', 22);
        $this->db->where('DAY(tabungan.tanggal) <=', 28);
        $row = $this->db->get()->row()->avg_jumlah;
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }
    public function tabRM5($id, $bulan, $tahun)
    {
        $this->db->select('AVG(jumlah) AS avg_jumlah');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->where('MONTH(tabungan.tanggal)', $bulan);
        $this->db->where('DAY(tabungan.tanggal) >=', 29);
        $row = $this->db->get()->row()->avg_jumlah;
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }
    public function tabTM1($id, $bulan, $tahun)
    {
        $this->db->select('SUM(jumlah) AS sum_jumlah');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->where('MONTH(tabungan.tanggal)', $bulan);
        $this->db->where('DAY(tabungan.tanggal) >=', 1);
        $this->db->where('DAY(tabungan.tanggal) <=', 7);
        $row = $this->db->get()->row()->sum_jumlah;
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }
    public function tabTM2($id, $bulan, $tahun)
    {
        $this->db->select('SUM(jumlah) AS sum_jumlah');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->where('MONTH(tabungan.tanggal)', $bulan);
        $this->db->where('DAY(tabungan.tanggal) >=', 8);
        $this->db->where('DAY(tabungan.tanggal) <=', 14);
        $row = $this->db->get()->row()->sum_jumlah;
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }
    public function tabTM3($id, $bulan, $tahun)
    {
        $this->db->select('SUM(jumlah) AS sum_jumlah');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->where('MONTH(tabungan.tanggal)', $bulan);
        $this->db->where('DAY(tabungan.tanggal) >=', 15);
        $this->db->where('DAY(tabungan.tanggal) <=', 21);
        $row = $this->db->get()->row()->sum_jumlah;
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }
    public function tabTM4($id, $bulan, $tahun)
    {
        $this->db->select('SUM(jumlah) AS sum_jumlah');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->where('MONTH(tabungan.tanggal)', $bulan);
        $this->db->where('DAY(tabungan.tanggal) >=', 22);
        $this->db->where('DAY(tabungan.tanggal) <=', 28);
        $row = $this->db->get()->row()->sum_jumlah;
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }
    public function tabTM5($id, $bulan, $tahun)
    {
        $this->db->select('SUM(jumlah) AS sum_jumlah');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->where('MONTH(tabungan.tanggal)', $bulan);
        $this->db->where('DAY(tabungan.tanggal) >=', 29);
        $row = $this->db->get()->row()->sum_jumlah;
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public function tabRB($id, $tahun)
    {
        $avg_bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $this->db->select('AVG(jumlah) AS avg_jumlah');
            $this->db->from('tabungan');
            $this->db->where('tabungan.user_id', $id);
            $this->db->where('YEAR(tabungan.tanggal)', $tahun);
            $this->db->where('MONTH(tabungan.tanggal)', $i);
            $avg = $this->db->get()->row()->avg_jumlah;

            if ($avg) {
                $avg_bulan[$i] = $avg;
            } else {
                $avg_bulan[$i] = 0;
            }
        }
        return $avg_bulan;
    }
    public function tabTB($id, $tahun)
    {
        $sum_bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $this->db->select('SUM(jumlah) AS sum_jumlah');
            $this->db->from('tabungan');
            $this->db->where('tabungan.user_id', $id);
            $this->db->where('YEAR(tabungan.tanggal)', $tahun);
            $this->db->where('MONTH(tabungan.tanggal)', $i);
            $sum = $this->db->get()->row()->sum_jumlah;
            if ($sum) {
                $sum_bulan[$i] = $sum;
            } else {
                $sum_bulan[$i] = 0;
            }
        }
        return $sum_bulan;
    }
    public function tabTBbagi4minggu($id, $tahun)
    {
        $sum_bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $this->db->select('SUM(jumlah) AS sum_jumlah');
            $this->db->from('tabungan');
            $this->db->where('tabungan.user_id', $id);
            $this->db->where('YEAR(tabungan.tanggal)', $tahun);
            $this->db->where('MONTH(tabungan.tanggal)', $i);
            $sum = $this->db->get()->row()->sum_jumlah;

            if ($sum) {
                $sum_bulan[$i] = $sum / 4;
            } else {
                $sum_bulan[$i] = 0;
            }
        }
        return $sum_bulan;
    }

    public function tabt($id, $tahun)
    {
        $this->db->select('*');
        $this->db->from('tabungan');
        $this->db->where('tabungan.user_id', $id);
        $this->db->where('YEAR(tabungan.tanggal)', $tahun);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }

    public function huth($id, $tanggal, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('hutang');
        $this->db->where('hutang.user_id', $id);
        $this->db->where('YEAR(hutang.tanggal)', $tahun);
        $this->db->where('MONTH(hutang.tanggal)', $bulan);
        $this->db->where('DAY(hutang.tanggal)', $tanggal);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }

    public function hutb($id, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('hutang');
        $this->db->where('hutang.user_id', $id);
        $this->db->where('YEAR(hutang.tanggal)', $tahun);
        $this->db->where('MONTH(hutang.tanggal)', $bulan);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }

    public function hutt($id, $tahun)
    {
        $this->db->select('*');
        $this->db->from('hutang');
        $this->db->where('hutang.user_id', $id);
        $this->db->where('YEAR(hutang.tanggal)', $tahun);
        $this->db->order_by('tanggal');
        return $this->db->get()->result();
    }
}
