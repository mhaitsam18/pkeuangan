<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo APP_NAME; ?></title>

    <?php $this->load->view('/admin/template/metafile'); ?>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />

</head>

<body class="hold-transition <?php echo APP_SKIN; ?> sidebar-mini">
    <div class="wrapper">

        <?php $this->load->view('/admin/template/header'); ?>
        <?php $this->load->view('/admin/template/sidebar'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Data Pemasukan </h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <h4>Tambah Pemasukan</h4>
                                <?php
                                $id_admin = $this->session->userdata('idadmin');
                                ?>
                                <form action="<?php echo base_url() . 'admin/pemasukan/create'; ?>" method="post" enctype="multipart/form-data" id="form_pemasukan">
                                    <input type="hidden" name="user_id" value="<?= $id_admin ?>">
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah Pemasukan </label>
                                        <input type="number" min="1000" name="jumlah" class="form-control" placeholder="Masukkan Jumlah Pemasukan" required id="jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="sumber">Sumber Pemasukan</label>
                                        <select name="sumber" class="form-control" id="sumber" required>
                                            <option value="" selected disabled>Pilih Sumber Pemasukan</option>
                                            <option value="Gaji">Gaji</option>
                                            <option value="Bisnis">Bisnis</option>
                                            <option value="Hadiah">Hadiah</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea rows="3" cols="30" name="keterangan" id="keterangan" placeholder="Masukkan keterangan" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="penyimpanan">Penyimpanan</label>
                                        <select name="penyimpanan" class="form-control" id="penyimpanan" required>
                                            <option value="" selected disabled>Pilih Penyimpanan</option>
                                            <option value="Tunai">Tunai</option>
                                            <option value="Rekening">Rekening</option>
                                            <option value="Gopay">Gopay</option>
                                            <option value="Ovo">Ovo</option>
                                            <option value="Dana">Dana</option>
                                            <option value="Link Aja">Link Aja</option>
                                            <option value="Shopee Pay">Shopee Pay</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        <!-- <input type="text" name="penyimpanan_field" class="form-control" id="penyimpanan_field" placeholder="Masukkan Penyimpanan Lainnya" required> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input class="form-control" type="date" name="tanggal" required>
                                    </div>
                                    <a href="<?php echo base_url('admin/pemasukan'); ?>" class="btn btn-default btn-flat btn-sm"><span class="fa fa-arrow-left"></span> Kembali</a>
                                    <button type="submit" class="btn btn-primary btn-flat btn-sm" id="submit"><span class="fa fa-save"></span> Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php $this->load->view('/admin/template/footer'); ?>
    </div>
    </div>
    </div>
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
            $('#penyimpanan_field').hide();
            $('#penyimpanan').on('change', function() {
                var isi = $('#penyimpanan').val();
                if (isi == 'Lainnya') {
                    $('#penyimpanan_field').show();
                } else {
                    $('#penyimpanan_field').hide();
                }
            });
            $('#submit').click(function() {
                $('#form_pemasukan').submit();
            });
        });
    </script>

    <?php $this->load->view('/admin/template/notice'); ?>

</body>

</html>