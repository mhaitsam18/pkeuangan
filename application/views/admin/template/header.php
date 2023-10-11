<style>
  h3 {
    font-size: 24pt !important;
  }
</style>
<header class="main-header">

  <!-- Logo -->
  <a href="<?= base_url('admin/dashboard') ?>" class="logo" style="border-bottom: 2pt solid pink;">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <?php if ($this->session->userdata('level') == '1') { ?>
      <span class="logo-mini">ADM</span>
    <?php } ?>
    <?php if ($this->session->userdata('level') == '2') { ?>
      <span class="logo-mini">USR</span>
    <?php } ?>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="<?php echo base_url() . 'assets/images/m.png' ?>" width="40"><small> KEUANGAN <small></small></small></span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" style="background:-webkit-linear-gradient(left, #c550a0, red);">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="color: #192226">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <?php
        $id_admin = $this->session->userdata('idadmin');
        $q = $this->db->query("SELECT * FROM tbl_pengguna WHERE pengguna_id='$id_admin'");
        $c = $q->row_array();
        ?>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url() . 'assets/images/' . $c['pengguna_photo']; ?>" class="user-image" alt="">
            <span class="hidden-xs"><?php echo $c['pengguna_nama']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo base_url() . 'assets/images/' . $c['pengguna_photo']; ?>" class="img-circle" alt="">
              <br><br>
              <span class="hidden-xs"><?php echo $c['pengguna_nama']; ?></span>
            </li>
            <!-- Menu Body -->

            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a href="<?php echo base_url() . 'auth/logout' ?>" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="<?php echo base_url('auth/logout') ?>" title="Logout"><i class="fa fa-sign-out"></i></a>
        </li>
      </ul>
    </div>

  </nav>
</header>