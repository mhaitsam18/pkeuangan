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
                <h1>Data Hutang </h1>
            </section>
            <?php $id_admin = $this->session->userdata('idadmin'); ?>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-body ">
                                        <form action="<?php echo base_url() . 'admin/Hutang/create'; ?>" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="user_id" value="<?= $id_admin ?>">
                                            <input type="hidden" name="level" value="1">
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah  </label>
                                                <input type="number" min="100" name="jumlah" class="form-control" id="jumlah" placeholder="Masukkan jumlah hutang" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal">Tanggal</label>
                                                <input class="form-control" type="date" name="tanggal" id="tanggal" required>
                                            </div>
                                            <a href="<?php echo base_url('admin/hutang'); ?>" class="btn btn-default btn-flat btn-sm"><span class="fa fa-arrow-left"></span> Kembali</a>
                                            <button type="submit" class="btn btn-primary btn-flat btn-sm" href=""><span class="fa fa-save"></span> Tambah</button>
                                        </form>
                                    </div>
                                </div>
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
    </script>

    <?php $this->load->view('/admin/template/notice'); ?>

</body>

</html>