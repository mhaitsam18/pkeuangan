
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME; ?></title>
  
  <?php $this->load->view('/admin/template/metafile'); ?>
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>

 </head>
 <body class="hold-transition <?php echo APP_SKIN; ?> sidebar-mini">
  <div class="wrapper">

   <?php $this->load->view('/admin/template/header');?>
   <?php $this->load->view('/admin/template/sidebar');?>
   <div class="content-wrapper">
    <section class="content-header">
      <h1>Production Monitoring</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Production Monitoring</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="">

            <div class="box">
              <div class="box-header">
                <a class="btn btn-success pull-right btn-flat btn-sm m-l-5"><span class="fa fa-print"></span> Export (.xls)</a>
                <a class="btn btn-default pull-right btn-flat btn-sm m-l-5"><span class="fa fa-print"></span> Cetak</a>
                <a class="btn btn-primary pull-right btn-flat btn-sm" data-toggle="modal" data-target="#modalCell"><span class="fa fa-plus"></span> Add a New Data</a>
                <a class="btn btn-danger pull-right btn-flat btn-sm m-r-5"><span class="fa fa-filter"></span> Filter data</a>
              </div>
              <div class="box-body table-responsive">
                <table id="datatables" class="table table-striped table-xs">
                  <thead>
                    <tr>
                      <th width="3%">No</th>
                      <th>Date</th>
                      <th>Cell Name</th>
                      <th width="5%">Status</th>
                      <th>Problem</th>
                      <th width="5%" data-orderable="false">Detail</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=0; foreach ($items as $item): $no++; ?>
                    <tr>
                      <td><?php echo $no; ?>.</td>
                      <td><?php echo date('Ymd', strtotime($item->created_date)); ?></td>
                      <td><?php echo $item->cell_name; ?></td>
                      <td>
                        <?php
                          $check_status = $this->db
                                                ->where('cell_id', $item->cell_id)
                                                ->where('created_date', $item->created_date)
                                                ->where('value', 'Off')
                                                ->get('pit_production_monitoring')
                                                ->num_rows();
                          if($check_status > 0): ?>
                          <span class="label label-danger block m-t-5">ERROR</span>
                          <?php else: ?>
                          <span class="label label-success block m-t-5">OK</span>
                          <?php endif; ?>
                      </td>
                      <td><?php echo !empty($item->problem) ? $item->problem : '<span class="font-trans font-italic">N/A</span>'; ?></td>
                      <td><a href="" class="btn btn-primary btn-xs btn-flat btn-block"><i class="fa fa-file-o"></i> Detail</a></td>
                    </tr>
                    <?php endforeach ?>
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

  <div class="modal fade" id="modalCell" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-red">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Pilih Cell Yang Akan Diisi</h4>
        </div>

        <div class="modal-body">
          <div class="row">
            <?php foreach ($cells as $cell): ?>
            <div class="col-md-2 m-b-10">
              <a href="<?php echo site_url('/admin/production_monitoring/create/'.$cell->id); ?>" class="btn btn-primary btn-flat btn-block"><?php echo $cell->cell; ?></a>
            </div>
            <?php endforeach ?>
          </div>
        </div>
        
      </form>
    </div>
  </div>

    <script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
    <script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>

    <script>
      $(function () {
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

    <?php $this->load->view('/admin/template/notice');?>
    
    </body>
  </html>
