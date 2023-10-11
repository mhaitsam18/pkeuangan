<center>
    <h3>RAB Bulan <?= cari_bulan($bulan) ?> Tahun <?= $tahun ?></h3>
    <h3>
        Total Persentase :
        <?php if ($totalPersen == 0) {
            echo "0";
        } else {
            echo $totalPersen;
        } ?> % <br>
    </h3>
</center>
<div class="row">
    <div class="col-md-1">
        <?php
        $disable = "disabled";
        if ($totalPersen < 100 && $tahun >= date('Y')) {
            if ($tahun == date('Y')) {
                if ($bulan >= date('m')) {
                    $disable = "";
                }
            } else {
                $disable = "";
            }
        }
        ?>
        <a href="<?= base_url("admin/rab/create?bulan=$bulan"); ?>" class="btn btn-sm btn-success <?= $disable ?>">Tambah Data</a>
    </div>
    <div class="col-md-4">
        <form action="">
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="tahun" id="tahun" value="<?= $tahun ?>">
                </div>
                <div class="col-md-6">
                    <select name="bulan" id="bulan" class="form-control">
                        <option value="" selected disabled>Pilih Bulan</option>
                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                            <option class="opsi-bulan" value="<?= $i ?>" <?= ($i == $bulan) ? 'selected' : '' ?>><?= cari_bulan($i) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>
<table id="datatables" class="table table-striped table-xs table-bordered">
    <thead>
        <tr>
            <th width="3%">No</th>
            <th>Nama</th>
            <th>Persentase</th>
            <th>Min - Max</th>
            <th>Total</th>
            <?php if ($this->session->userdata('level') == '2' && $tahun >= date('Y')) : ?>
                <?php if ($tahun == date('Y')) : ?>
                    <?php if ($bulan >= date('m')) : ?>
                        <th>Action</th>
                    <?php endif; ?>
                <?php else : ?>
                    <th>Action</th>
                <?php endif; ?>
            <?php endif; ?>
            <?php
            $pemt = 0;
            $id_admin = $this->session->userdata('idadmin');
            $pem = $this->db->query("SELECT * FROM pemasukan WHERE user_id='$id_admin' AND MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun");
            foreach ($pem->result() as $as) :;
                $pemh[] = $as->jumlah;
                $pemt = array_sum($pemh);
            endforeach;
            ?>
            <?php $mb = $pemt ?>
            <?php
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $id_admin = $this->session->userdata('idadmin');
        $totalKeseluruhan = 0;
        $no = 0;
        foreach ($list_rab->result() as $utama) : $no++;
        ?>
            <tr>
                <td class="text-center"><?php echo $no; ?>.</td>
                <td><?= $utama->nama; ?></td>
                <td><?= $utama->persen; ?>%</td>
                <td>
                    <?php if ($utama->is_default == 1) : ?>
                        <?= $utama->min; ?>% - <?= $utama->max; ?>%
                    <?php else : ?>
                        0% - <?= (100 - $totalPersen + $utama->persen) ?>%
                    <?php endif; ?>
                </td>
                <td><?php $i = $utama->persen;
                    $o = $i / 100;
                    $p = $o * $mb;
                    $totalKeseluruhan += $p;
                    echo convRupiah($p);
                    ?>
                </td>
                <?php if ($this->session->userdata('level') == '2' && $tahun >= date('Y')) : ?>
                    <?php if ($tahun == date('Y')) : ?>
                        <?php if ($bulan >= date('m')) : ?>
                            <td class="text-center">
                                <?php if ($utama->is_default == 1) { ?>
                                    <a onclick="return confirm('Edit data?');" href="<?php echo site_url('/admin/rab/update/' . $utama->id); ?>" class="btn btn-xs btn-success btn-flat"><i class="fa fa-edit"></i></a>
                                <?php } else { ?>
                                    <a onclick="return confirm('Edit data?');" href="<?php echo site_url('/admin/rab/update/' . $utama->id); ?>" class="btn btn-xs btn-success btn-flat"><i class="fa fa-edit"></i></a>
                                    <a onclick="return confirm('Hapus data?');" href="<?php echo site_url('/admin/rab/delete/' . $utama->id); ?>" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                                <?php } ?>
                            </td>
                        <?php endif; ?>
                    <?php else : ?>
                        <td class="text-center">
                            <?php if ($utama->is_default == 1) { ?>
                                <a onclick="return confirm('Edit data?');" href="<?php echo site_url('/admin/rab/update/' . $utama->id); ?>" class="btn btn-xs btn-success btn-flat"><i class="fa fa-edit"></i></a>
                            <?php } else { ?>
                                <a onclick="return confirm('Edit data?');" href="<?php echo site_url('/admin/rab/update/' . $utama->id); ?>" class="btn btn-xs btn-success btn-flat"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Hapus data?');" href="<?php echo site_url('/admin/rab/delete/' . $utama->id); ?>" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                        </td>
                    <?php endif; ?>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" class="text-center">Total Keseluruhan</th>
            <th><?= convRupiah($totalKeseluruhan) ?></th>
        </tr>
    </tfoot>
</table>
<script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>

<script>
    $(function() {
        $('#datatables').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
    });
    $(document).ready(function() {
        var isi = $('#persen_total').val();
        console.log(isi);
    });
</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script>
    $("#bulan").on('change', function() {
        var bulan = $(this).val();
        var tahun = $("#tahun").val();
        $.ajax({
            url: "<?= base_url('admin/rab/rab') ?>",
            type: "post",
            data: {
                'bulan': bulan,
                'tahun': tahun
            },
            success: function(data) {
                $('.rab').html(data);
            }
        });
    });
    $("#tahun").on('change', function() {
        $("#bulan").val("");
    });
</script>