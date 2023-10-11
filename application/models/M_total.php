<?php

class M_total extends CI_Model{

    public function jumlah_artikel()
{   
    $query = $this->db->get('artikel');
    if($query->num_rows()>0)
    {
      return $query->num_rows();
    }
    else
    {
      return 0;
    }
}
    public function pengguna(){
      $this->db->select('*');
      $this->db->from('tbl_pengguna');
      $this->db->where('pengguna_level=2');
      return $this->db->get()->num_rows();
    }
}

?> 	