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
                <h1>Data Gambar </h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="">

                            <div class="box">
                                <div class="box-header">
                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#gambarModal">Tambah Gambar</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="gambarModal" tabindex="-1" aria-labelledby="gambarModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="gambarModalLabel">Tambah Gambar</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('Admin/Artikel/insertGambar') ?>" method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_artikel" value="<?= $artikel->id ?>">
                                                        <div class="form-group">
                                                            <label for="gambar">Unggah Gambar</label>
                                                            <input type="file" class="form-control" name="gambar" id="gambar">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <h2><?= $artikel->nama ?></h2>
                                    <table id="datatables" class="table table-striped table-xs table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="3%">No</th>
                                                <th>Tanggal diupload</th>
                                                <th>Gambar Artikel</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($items as $item) : $no++; ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no; ?>.</td>
                                                    <td><?php echo $item->created_at; ?></td>
                                                    <td><img src="<?= base_url('/assets/images/struktur/' . $item->gambar); ?>" width="100"></td>
                                                    <td class="text-center">
                                                        <?php if ($this->session->userdata('level') == '1') : ?>
                                                            <a onclick="return confirm('Hapus gambar?');" href="<?php echo site_url('/admin/artikel/deleteGambar/' . $item->id); ?>" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></a>
                                                        <?php endif; ?>
                                                    </td>
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