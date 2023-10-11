<table id="datatables" class="table table-striped table-xs table-bordered">
    <thead>
        <tr>
            <th width="3%">No</th>
            <th>Tanggal tabungan</th>
            <th>Keterangan</th>
            <th>Uang Tersimpan</th>
            <th>Channel</th>
            <th>Jumlah</th>
            <?php if ($this->session->userdata('level') == '2') { ?>
                <th>Aksi</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>

        <?php
        $id_admin = $this->session->userdata('idadmin');
        $query = $this->db->query("SELECT * FROM tabungan WHERE user_id='$id_admin' AND YEAR(tanggal) = $tahun");
        $no = 1; ?>
        <?php foreach ($query->result() as $utama) : ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?>.</td>
                <td><?= $utama->tanggal; ?></td>
                <td><?php echo $utama->keterangan; ?></td>
                <td><?php echo $utama->penyimpanan; ?></td>
                <td><?php echo $utama->channel; ?></td>
                <td>
                    <?php echo convRupiah($utama->jumlah); ?>
                </td>
                <td class="text-center">
                    <a onclick="return confirm('Edit data?');" href="<?php echo site_url('/admin/tabungan/update/' . $utama->id); ?>" class="btn btn-xs btn-success btn-flat"><i class="fa fa-edit"></i></a>
                    <a onclick="return confirm('Hapus data?');" href="<?php echo site_url('/admin/tabungan/delete/' . $utama->id); ?>" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>