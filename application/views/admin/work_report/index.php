
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
      <h1>Daily Work Report</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Daily Work Report</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="">

            <div class="box">
              <div class="box-header">
                <a class="btn btn-primary pull-right btn-flat btn-sm" href="<?php echo base_url('/admin/work_report/create'); ?>"><span class="fa fa-plus"></span> Add a New Data</a>
              </div>
              <div class="box-body">
                <table id="datatables" class="table table-striped table-xs">
                  <thead>
                    <tr>
                      <th width="3%">No</th>
                      <th>Date</th>
                      <th>PIT User</th>
                      <th>Problem</th>
                      <th>Timer</th>
                      <th>User Complain</th>
                      <th>Departement</th>
                      <th width="3%" data-orderable="false"><i class="fa fa-trash"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=0; foreach ($items as $item): $no++; ?>
                    <tr>
                      <td><?php echo $no; ?>.</td>
                      <td>
                        <a href="javascript:void(0)" data-target="#modalDetail" data-id="<?php echo $item->id; ?>">
                          <?php echo date('Y-m-d', strtotime($item->created_date)); ?>
                        </a>
                      </td>
                      <td><?php echo $item->created_by; ?></td>
                      <td><?php echo $item->problem; ?></td>
                      <td><?php echo $item->time; ?></td>
                      <td><?php echo $item->user_complain; ?></td>
                      <td><?php echo $item->departement; ?></td>
                      <td><a href="<?php echo site_url('/admin/work_report/delete/'.$item->id); ?>" onclick="return confirm('Hapus data?')" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></a></td>
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

  <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-blue">
          <h4 class="modal-title" id="myModalLabel">Detail Data Work Report</h4>
        </div>
        <div class="modal-body" id="resultContentDetail">
        </div>
      </div>
    </div>
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

    <?php $this->load->view('/admin/template/notice');?>


    <script>
      $(function () {
        $('#datatables').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "iDisplayLength": 25
        });

        $('a[data-target="#modalDetail"]').click(function(){
          $.get('<?php echo site_url("/admin/work_report/detail/"); ?>'+$(this).data('id'), function(resp){
            $('div#resultContentDetail').html(resp);
          });
          $('#modalDetail').modal('show');
        });

      });
    </script>
    
    </body>
  </html>
