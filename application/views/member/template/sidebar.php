<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <?php if ($this->session->userdata('level') == '1') { ?>
                <li class="header">NAVIGASI MENU UTAMA</li>
                <li class="<?php echo menus_active('dashboard'); ?>">
                    <a href="<?php echo base_url() . 'admin/dashboard' ?>">
                        <i class="fa fa-dashboard"></i> <span>Dasbor</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>

                <li class="<?php echo menus_active('artikel'); ?>">
                    <a href="<?php echo base_url() . 'admin/artikel' ?>">
                        <i class="fa fa-picture-o"></i> <span>Artikel</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>
                <li class="<?php echo menus_active('pengguna'); ?>">
                    <a href="<?php echo base_url() . 'admin/pengguna' ?>">
                        <i class="fa fa-users"></i> <span>Manajemen Pengguna</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url() . 'auth/logout' ?>">
                        <i class="fa fa-sign-out"></i> <span>Keluar</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($this->session->userdata('level') == '2') { ?>
                <li class="header">NAVIGASI MENU UTAMA</li>
                <li class="<?php echo menus_active('dashboard'); ?>">
                    <a href="<?php echo base_url() . 'admin/dashboard' ?>">
                        <i class="fa fa-dashboard"></i> <span>Dasbor</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>

                <li class="<?php echo menus_active('pemasukan'); ?>">
                    <a href="<?php echo base_url() . 'admin/pemasukan' ?>">
                        <i class="fa fa-plus-circle"></i> <span>Pemasukan</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>

                <!-- <li class="treeview <?php echo menus_active(false, array('struktur', 'bp', 'kepala')); ?>"> -->
                <li class="<?php echo menus_active('pengeluaran'); ?>">
                    <a href="<?= base_url('admin/pengeluaran/') ?>">
                        <i class="fa fa-database"></i>
                        <span>Pengeluaran</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                            <!-- <i class="fa fa-angle-left pull-right"></i> -->
                        </span>
                    </a>
                    <!-- <ul class="treeview-menu"> -->
                    <!-- <li class="<?php echo menus_active('pengeluaran'); ?>">
              <a href="<?= base_url('/admin/pengeluaran'); ?>">
                <i class="fa fa-server"></i>Keseluruhan</a>
            </li> -->
                    <!-- <?php
                            $id_admin = $this->session->userdata('idadmin');
                            $bulan = date('m');
                            $tahun = date('Y');
                            $rab = $this->db->query("SELECT * FROM rab WHERE user_id = $id_admin AND bulan = $bulan AND tahun = $tahun")->result_array();
                            foreach ($rab as $row) :
                            ?>
              <li class="<?php echo menus_active('pengeluaran-' . $row['nama']); ?>">
                <a href="<?php echo base_url() . 'admin/pengeluaran/page/' . $row['id'] . '/' . $row['nama'] ?>">
                  <i class="fa fa-server"></i><?= $row['nama'] ?></a>
              </li>
            <?php endforeach ?> -->
                    <!-- </ul> -->
                </li>

                <li class="<?php echo menus_active('artikel'); ?>">
                    <a href="<?php echo base_url() . 'admin/artikel' ?>">
                        <i class="fa fa-picture-o"></i> <span>Artikel</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>

                <li class="<?php echo menus_active('profile'); ?>">
                    <a href="<?php echo base_url() . 'admin/profile' ?>">
                        <i class="fa fa-user"></i> <span>Profil</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>

                <li class="<?php echo menus_active('tabungan'); ?>">
                    <a href="<?php echo base_url() . 'admin/tabungan' ?>">
                        <i class="fa fa-bank"></i> <span>Tabungan</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>

                <li class="<?php echo menus_active('hutang'); ?>">
                    <a href="<?php echo base_url() . 'admin/hutang' ?>">
                        <i class="fa fa-money"></i> <span>Hutang</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>

                <li class="<?php echo menus_active('rab'); ?>">
                    <a href="<?php echo base_url() . 'admin/rab' ?>">
                        <i class="fa fa-check"></i> <span>RAB</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>

                <li class="<?php echo menus_active('analisis'); ?>">
                    <a href="<?php echo base_url() . 'admin/analisis' ?>">
                        <i class="fa fa-bar-chart"></i> <span>Analisis</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>

                <!-- <li class="<?php echo menus_active('laporan'); ?>">
          <a href="<?php echo base_url() . 'admin/laporan' ?>">
            <i class="fa fa-database"></i> <span>Lap. Akhir</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li> -->

                <li class="treeview <?= menus_active('laporan'); ?>">
                    <a href="<?= base_url('admin/laporan') ?>">
                        <i class="fa fa-file"></i>
                        <span>Laporan</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?= menus_active('laporan-pemasukan'); ?>">
                            <a href="<?= base_url('/admin/laporan/pemasukan'); ?>">
                                <i class="fa fa-file"></i>Pemasukan</a>
                        </li>
                        <li class="<?= menus_active('laporan-pengeluaran'); ?>">
                            <a href="<?= base_url('/admin/laporan/pengeluaran'); ?>">
                                <i class="fa fa-file"></i>Pengeluaran</a>
                        </li>
                        <li class="<?= menus_active('laporan-tabungan'); ?>">
                            <a href="<?= base_url('/admin/laporan/tabungan'); ?>">
                                <i class="fa fa-file"></i>Tabungan</a>
                        </li>
                        <li class="<?= menus_active('laporan-hutang'); ?>">
                            <a href="<?= base_url('/admin/laporan/hutang'); ?>">
                                <i class="fa fa-file"></i>Hutang</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo base_url() . 'auth/logout' ?>">
                        <i class="fa fa-sign-out"></i> <span>Keluar</span>
                        <span class="pull-right-container">
                            <small class="label pull-right"></small>
                        </span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </section>
</aside>