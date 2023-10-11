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
                <h1>Data Pelunasan </h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="">
                        </div>

                        <div class="box">
                            <?php if ($this->session->userdata('level') == '1') { ?>
                                <div class="box-header">
                                    <a class="btn btn-success btn-flat btn-sm" href="<?php echo base_url('/admin/artikel/create'); ?>"><span class="fa fa-user-plus"></span> Tambah Data</a>
                                </div>
                            <?php } ?>
                            <div class="box-body">

                                <table id="datatables" class="table table-striped table-xs table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="3%">No</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Hutang</th>
                                            <th>Tanggal Pelunasan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $no = 0;
                                        foreach ($items as $utama) : $no++;
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $no; ?>.</td>
                                                <td>
                                                    <?php echo convRupiah($utama->jumlah_bayar); ?></td>
                                                <td><?= $utama->tanggal_hutang; ?></td>
                                                <td><?= $utama->tanggal_bayar; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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