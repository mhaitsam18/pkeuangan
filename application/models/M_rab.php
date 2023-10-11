<?php
class M_rab extends CI_Model
{
    public function insertDefaultRab($user_id = null, $bulan = null, $tahun = null)
    {
        $this->db->insert('rab', [
            'nama' => 'Zakat',
            'pos_id' => 1,
            'user_id' => $user_id,
            'persen' => 0,
            'min' => 0,
            'max' => 10,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'is_default' => 1,
        ]);
        $this->db->insert('rab', [
            'nama' => 'Tabungan',
            'pos_id' => 2,
            'user_id' => $user_id,
            'persen' => 10,
            'min' => 10,
            'max' => 15,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'is_default' => 1,
        ]);
        $this->db->insert('rab', [
            'nama' => 'Cicilan Hutang',
            'pos_id' => 3,
            'user_id' => $user_id,
            'persen' => 30,
            'min' => 0,
            'max' => 30,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'is_default' => 1,
        ]);
        $this->db->insert('rab', [
            'nama' => 'Kebutuhan Rutin',
            'pos_id' => 4,
            'user_id' => $user_id,
            'persen' => 10,
            'min' => 10,
            'max' => 20,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'is_default' => 1,
        ]);
        $this->db->insert('rab', [
            'nama' => 'Konsumsi',
            'pos_id' => 5,
            'user_id' => $user_id,
            'persen' => 20,
            'min' => 20,
            'max' => 30,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'is_default' => 1,
        ]);
        $this->db->insert('rab', [
            'nama' => 'Pendidikan',
            'pos_id' => 6,
            'user_id' => $user_id,
            'persen' => 20,
            'min' => 10,
            'max' => 20,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'is_default' => 1,
        ]);
        $this->db->insert('rab', [
            'nama' => 'Kesehatan',
            'pos_id' => 7,
            'user_id' => $user_id,
            'persen' => 5,
            'min' => 5,
            'max' => 10,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'is_default' => 1,
        ]);
        // $this->db->insert('rab', [
        //     'nama' => 'Lain-lain',
        //     'pos_id' => 8,
        //     'user_id' => $user_id,
        //     'persen' => 5,
        //     'min' => 0,
        //     'max' => 10,
        //     'bulan' => $bulan,
        //     'tahun' => $tahun,
        //     'is_default' => 1,
        // ]);
    }
}
