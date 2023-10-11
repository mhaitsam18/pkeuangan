<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo APP_NAME; ?></title>

    <?php $this->load->view('/admin/template/metafile'); ?>

</head>

<body class="hold-transition <?php echo APP_SKIN; ?> sidebar-mini">
    <div class="wrapper">

        <?php $this->load->view('/admin/template/header'); ?>
        <?php $this->load->view('/admin/template/sidebar'); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Laporan
                    <small></small>
                </h1>
            </section>
            <?php
            $id_admin = $this->session->userdata('idadmin');
            $q = $this->db->query("SELECT * FROM tbl_pengguna WHERE pengguna_id='$id_admin'");
            $c = $q->row_array();
            ?>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body text-center">
                                <h1>Laporan Tabungan </h1>
                                <div class="col-md-4">
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: #367fa9;">
                                            <h3 class="card-title">Laporan Harian</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <?php echo form_open('admin/laporan/tabh'); ?>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Tanggal</label>
                                                        <input type="hidden" name="id" value="<?= $c['pengguna_id']; ?>">
                                                        <select name="tanggal" class="form-control">
                                                            <?php
                                                            $mulai = 1;
                                                            for ($i = $mulai; $i < $mulai + 31; $i++) {
                                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Bulan</label>
                                                        <select name="bulan" class="form-control">
                                                            <?php
                                                            $mulai = 1;
                                                            for ($i = $mulai; $i < $mulai + 12; $i++) {
                                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Tahun</label>
                                                        <select name="tahun" class="form-control">
                                                            <?php
                                                            $mulai = date('Y');
                                                            for ($i = $mulai; $i > $mulai - 11; $i--) {
                                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-block" style="background-color: #367fa9;"><i class="fa fa-print"></i> Cetak Laporan</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>

                                <!-- Laporan Bulanan -->
                                <div class="col-md-4">
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: #367fa9;">
                                            <h3 class="card-title">Laporan Bulanan</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <?php echo form_open('admin/laporan/tabb'); ?>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Bulan</label>
                                                        <input type="hidden" name="id" value="<?= $c['pengguna_id']; ?>">
                                                        <select name="bulan" class="form-control">
                                                            <?php
                                                            $mulai = 1;
                                                            for ($i = $mulai; $i < $mulai + 12; $i++) {
                                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tahun</label>
                                                        <select name="tahun" class="form-control">
                                                            <?php
                                                            $mulai = date('Y');
                                                            for ($i = $mulai; $i > $mulai - 11; $i--) {
                                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-block" style="background-color:#367fa9;"><i class="fa fa-print"></i> Cetak Laporan</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php echo form_close() ?>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>

                                <!-- Laporan Tahunan -->
                                <div class="col-md-4">
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: #367fa9;">
                                            <h3 class="card-title">Laporan Tahunan</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <?php echo form_open('admin/laporan/tabt'); ?>
                                            <div class="row">
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Tahun</label>
                                                    <input type="hidden" name="id" value="<?= $c['pengguna_id']; ?>">
                                                    <select name="tahun" class="form-control">
                                                        <?php
                                                        $mulai = date('Y');
                                                        for ($i = $mulai; $i > $mulai - 11; $i--) {
                                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-block" style="background-color: #367fa9;"><i class="fa fa-print"></i> Cetak Laporan</button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo form_close() ?>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->

                    </div>
                </div>
            </section>
        </div>
        <?php $this->load->view('/admin/template/footer'); ?>

    </div>

    <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</body>

</html>