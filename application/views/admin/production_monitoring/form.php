
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_NAME; ?></title>
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/select2/select2.min.css'?>">
  <?php $this->load->view('/admin/template/metafile'); ?>
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/iCheck/square/blue.css'?>">
</head>
<body class="hold-transition <?php echo APP_SKIN; ?> sidebar-mini">
<div class="wrapper">

  <!--Header-->
  <?php $this->load->view('/admin/template/header');?>

  <!--sidebar-->
  <?php $this->load->view('/admin/template/sidebar');?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        PIT Daily Checking Production Scan 
        <small><b>Cell <?php echo $cell->cell; ?></b></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>PIT Daily Work Report</li>
        <li class="active">Form</li>
      </ol>
    </section>

    <section class="content">

      <div class="row">
        <div class="col-md-9">
          <div class="box">
        
            <form action="<?php echo site_url('/admin/production_monitoring/create/'.$cell->id); ?>" method="post" enctype="multipart/form-data" class="">
              
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th colspan="2" class="bg-red">Data Monitoring Based On Cell <?php echo $cell->cell; ?> <span class="pull-right label label-default">ID #<?php echo $cell->id; ?></span></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=0; foreach ($cell_attributes as $cell_attribute): $no++; ?>
                        <tr>
                          <th width="30%"><?php echo $no; ?>. <?php echo $cell_attribute->attributes_name; ?></th>
                          <td>
                            <?php 
                              $cell_attribute_master = $this->db->where('parent_id', $cell_attribute->attributes_id)->get('pit_cell_attributes')->result();
                              $no2=0; foreach($cell_attribute_master as $cam): $no2++; ?>

                              <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-5 p-b-5">
                                  <span class="attr_name"><?php echo $no.'.'.$no2.'. '.$cam->attributes; ?></span>
                                </div>
                                <div class="col-md-2 p-b-5">
                                  <div class="">
                                    <label style="font-weight: 400">
                                      <input type="radio" name="attr_value_<?php echo $cell_attribute->attributes_id.'_'.$cam->id; ?>" class="flat-red" checked="" value="On">
                                      On
                                    </label>
                                  </div>
                                </div>
                                <div class="col-md-2 p-b-5">
                                  <div class="">
                                    <label style="font-weight: 400">
                                      <input type="radio" name="attr_value_<?php echo $cell_attribute->attributes_id.'_'.$cam->id; ?>" class="flat-red" value="Off">
                                      Off
                                    </label>
                                  </div>
                                </div>
                              </div>

                            <?php endforeach ?>
                          </td>
                        </tr>
                        <?php endforeach ?>
                        <tr>
                          <th>Problem</th>
                          <td><input type="text" name="problem" class="form-control form-control-sm" placeholder="enter a description of the problem if any"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                    <a href="<?php echo base_url('admin/production_monitoring'); ?>" class="btn btn-default btn-flat btn-sm"><span class="fa fa-arrow-left"></span> Kembali</a>
                    <button type="submit" class="btn btn-primary btn-flat btn-sm"><span class="fa fa-save"></span> Submit</button> 
                    <div class="pull-right">
                       <div class="checkbox icheck">
                          <label>
                            <input type="checkbox" name="stay_page"> Tetap dihalaman ini setelah submit
                          </label>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.box -->

            <div class="row">
              <div class="col-md-8">
               <!-- /.box -->

             </div>
             <!-- /.col (left) -->
             <div class="col-md-4">
              <!-- /.box -->
            </form>
            
            <!-- /.box -->
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->

  </section>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('/admin/template/footer'); ?>


</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<script src="<?php echo base_url().'assets/ckeditor/ckeditor.js'?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url().'assets/plugins/select2/select2.full.min.js'?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url().'assets/plugins/iCheck/icheck.min.js'?>"></script>

<script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>

<script>
  $(function () {
     $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });

    $(".select2").select2();
  });

</script>
  <?php $this->load->view('/admin/template/notice');?>
</body>
</html>
