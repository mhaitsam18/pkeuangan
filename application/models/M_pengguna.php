<?php
class M_pengguna extends CI_Model
{

	function get_all_pengguna()
	{
		$hsl = $this->db->query("SELECT tbl_pengguna.*,IF(pengguna_jenkel='L','Laki-Laki','Perempuan') AS jenkel FROM tbl_pengguna");
		return $hsl;
	}

	function get_all_pengguna_customer()
	{
		$hsl = $this->db->query("SELECT tbl_pengguna.*,IF(pengguna_jenkel='L','Laki-Laki','Perempuan') AS jenkel FROM tbl_pengguna WHERE pengguna_level != 1");
		return $hsl;
	}

	function simpan_pengguna($nama, $no_ktp, $jenkel, $username, $password, $nohp, $level, $gambar, $foto_ktp)
	{
		$hsl = $this->db->query("INSERT INTO tbl_pengguna (pengguna_nama,pengguna_no_ktp,pengguna_jenkel,pengguna_username,pengguna_password,pengguna_nohp,pengguna_level,pengguna_photo, pengguna_foto_ktp) VALUES ('$nama','$no_ktp','$jenkel','$username',md5('$password'),'$nohp','$level','$gambar','$foto_ktp')");
		return $hsl;
	}

	function simpan_pengguna_tanpa_gambar($nama, $no_ktp, $jenkel, $username, $password, $nohp, $status, $level, $unik)
	{
		$hsl = $this->db->query("INSERT INTO tbl_pengguna (pengguna_nama,pengguna_no_ktp, pengguna_jenkel,pengguna_username,pengguna_password,pengguna_nohp,pengguna_status,pengguna_unik,pengguna_level) VALUES ('$nama','$no_ktp','$jenkel','$username',md5('$password'),'$nohp','$status','$unik','$level')");
		return $hsl;
	}
	function simpan_pengguna_dengan_gambar($nama, $no_ktp, $jenkel, $username, $password, $nohp, $status, $level, $unik, $gambar, $foto_ktp)
	{
		$hsl = $this->db->query("INSERT INTO tbl_pengguna (pengguna_nama,pengguna_no_ktp, pengguna_jenkel,pengguna_username,pengguna_password,pengguna_nohp,pengguna_status,pengguna_unik,pengguna_level,pengguna_photo, pengguna_foto_ktp) VALUES ('$nama','$no_ktp','$jenkel','$username',md5('$password'),'$nohp','$status','$unik','$level','$gambar', '$foto_ktp')");
		return $hsl;
	}

	//UPDATE PENGGUNA //
	function update_pengguna_tanpa_pass($kode, $nama, $jenkel, $username, $password, $nohp, $level, $gambar)
	{
		$hsl = $this->db->query("UPDATE tbl_pengguna set pengguna_nama='$nama',pengguna_jenkel='$jenkel',pengguna_username='$username',pengguna_nohp='$nohp',pengguna_level='$level',pengguna_photo='$gambar' where pengguna_id='$kode'");
		return $hsl;
	}

	function update_pengguna_profil($kode, $nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar)
	{
		$hsl = $this->db->query("UPDATE tbl_pengguna set pengguna_nama='$nama', pengguna_jenkel='$jenkel', pengguna_username='$username', pengguna_password='$password', pengguna_nohp='$nohp', pengguna_level='$level', pengguna_photo='$gambar' where pengguna_id='$kode'");
		return $hsl;
	}
	function update_pengguna_profil_tanpa_password($kode, $nama, $jenkel, $username, $email, $nohp, $level, $gambar)
	{
		$hsl = $this->db->query("UPDATE tbl_pengguna set pengguna_nama='$nama', pengguna_jenkel='$jenkel', pengguna_username='$username', pengguna_nohp='$nohp', pengguna_level='$level', pengguna_photo='$gambar' where pengguna_id='$kode'");
		return $hsl;
	}
	function update_pengguna($kode, $nama, $jenkel, $username, $password, $nohp, $level, $gambar)
	{
		$hsl = $this->db->query("UPDATE tbl_pengguna set pengguna_nama='$nama',pengguna_jenkel='$jenkel',pengguna_username='$username',pengguna_password=md5('$password'),pengguna_nohp='$nohp',pengguna_level='$level',pengguna_photo='$gambar' where pengguna_id='$kode'");
		return $hsl;
	}

	function update_pengguna_tanpa_pass_dan_gambar($kode, $nama, $jenkel, $username, $password, $nohp, $level)
	{
		$hsl = $this->db->query("UPDATE tbl_pengguna set pengguna_nama='$nama',pengguna_jenkel='$jenkel',pengguna_username='$username',pengguna_nohp='$nohp',pengguna_level='$level' where pengguna_id='$kode'");
		return $hsl;
	}
	function update_pengguna_tanpa_gambar($kode, $nama, $jenkel, $username, $password, $nohp, $level)
	{
		$hsl = $this->db->query("UPDATE tbl_pengguna set pengguna_nama='$nama',pengguna_jenkel='$jenkel',pengguna_username='$username',pengguna_password=md5('$password'),pengguna_nohp='$nohp',pengguna_level='$level' where pengguna_id='$kode'");
		return $hsl;
	}
	//END UPDATE PENGGUNA//

	function hapus_pengguna($kode)
	{
		$hsl = $this->db->query("DELETE FROM tbl_pengguna where pengguna_id='$kode'");
		return $hsl;
	}
	function getusername($id)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_pengguna where pengguna_id='$id'");
		return $hsl;
	}
	function resetpass($id, $pass)
	{
		$hsl = $this->db->query("UPDATE tbl_pengguna set pengguna_password=md5('$pass') where pengguna_id='$id'");
		return $hsl;
	}

	function get_pengguna_login($kode)
	{
		$hsl = $this->db->query("SELECT * FROM tbl_pengguna where pengguna_id='$kode'");
		return $hsl;
	}
	public function level($lvl)
	{
		return  $this->db->get_where('tbl_pengguna', $lvl);
	}
}
