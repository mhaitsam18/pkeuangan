
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
        PIT Daily Work Report
        <small></small>
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
        
            <form action="<?php echo isset($edit) ? base_url().'admin/work_report/update/'.$edit->id : base_url().'admin/work_report/create'; ?>" method="post" enctype="multipart/form-data" class="">
              
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-7">
                    <div class="form-group">
                      <label >Departement</label>
                      <select class="form-control select2" name="departement" style="width: 100%;" required>
                        <option value="">-Pilih-</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Development">Development</option>
                        <option value="Production">Production</option>
                        <option value="PPIC">PPIC</option>
                        <option value="Material Purchasing">Material Purchasing</option>
                        <option value="GA or Engineering">GA or Engineering</option>
                        <option value="IT">IT</option>
                        <option value="Planning/Accounting">Planning/Accounting</option>
                        <option value="GA/HRD">GA/HRD</option>
                        <option value="LEAN">LEAN</option>
                        <option value="QIP/LAB">QIP/LAB</option>
                        <option value="Purchasing">Purchasing</option>
                        <option value="CR">CR</option>
                        <option value="IP">IP</option>
                        <option value="Laminating">Laminating</option>
                        <option value="Print Screen">Print Screen</option>
                        <option value="EPTE">EPTE</option>
                        <option value="Mekanik">Mekanik</option>
                        <option value="PE">PE</option>
                        <option value="Export">Export</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label >User Complain</label>
                      <input type="text" name="user_complain" class="form-control" placeholder="User Complain" required value="<?php echo isset($edit) ? $edit->user_complain : ''; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Problem</label>
                      <select class="form-control select2" name="problem" style="width: 100%;" required>
                        <option value="">-Pilih-</option>
                        <option value="Software">Software</option>
                        <option value="Hardware">Hardware</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label >Progress</label>
                      <input type="text" name="progress" class="form-control" placeholder="Progress" required value="<?php echo isset($edit) ? $edit->progress : ''; ?>"/>
                    </div>
                  </div>

                  <div class="col-md-5">
                    <div class="form-group formImgBefore">
                      <label class="control-label"><i class="fa fa-image"></i> Upload Image Before (.jpg, .jpeg, .png)</label>
                      <input type="file" class="form-control" name="img_before" required="">
                      <span class="help-block imgBeforeTextHelp"></span>
                    </div>
                    <div class="form-group">
                      <label class="control-label"><i class="fa fa-clock-o"></i> Working Time</label>
                      <div class="row">
                        <div class="col-md-8">
                          <button type="button" class="btn btn-success btn-sm btn-flat" id="start"><i class="fa fa-clock-o"></i> Start</button>
                          <button type="button" class="btn btn-danger btn-sm btn-flat" id="stop"><i class="fa fa-clock-o"></i> Stop</button>
                          <button type="button" class="btn btn-default btn-sm btn-flat" id="clear"><i class="fa fa-clock-o"></i> Clear</button>
                        </div>
                        <div class="col-md-4">
                          <code class="pull-right font-19 font-bold" id="timerText">00:00:00</code>
                          <input type="hidden" name="time" value="00:00:00">
                        </div>
                      </div>
                      <span class="help-block">* Diharapkan tidak mengeluarkan browser ketika waktu sedang berjalan</span>
                    </div>
                    <div class="form-group formImgAfter">
                      <label class="control-label"><i class="fa fa-image"></i> Upload Image After (.jpg, .jpeg, .png)</label>
                      <input type="file" class="form-control" name="img_after" disabled="" required="">
                      <span class="help-block imgAfterTextHelp"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                    <a href="<?php echo base_url('admin/work_report'); ?>" class="btn btn-default btn-flat btn-sm"><span class="fa fa-arrow-left"></span> Kembali</a>
                    <button type="submit" class="btn btn-primary btn-flat btn-sm" disabled=""><span class="fa fa-save"></span> Submit</button> 
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

     $('input[name="img_before"]').on('change', function (ev) {
        ev.preventDefault();
        
      });

    $(".select2").select2();

    $('button#clear').click(function(){
      $('button[type="submit"]').prop('disabled', true);
    });

    $('button#stop').click(function(){
      if($('code#timerText').html() !== "00:00:00"){
        $('button[type="submit"]').prop('disabled', false);
        $('input[name="img_after"]').prop('disabled', false);
      }
    });
  });

  var h1 = document.getElementsByTagName('code')[0],
    start = document.getElementById('start'),
    stop = document.getElementById('stop'),
    btnClear = document.getElementById('clear'),
    seconds = 0, minutes = 0, hours = 0,
    t;

  function add() {
      seconds++;
      if (seconds >= 60) {
          seconds = 0;
          minutes++;
          if (minutes >= 60) {
              minutes = 0;
              hours++;
          }
      }
      
      h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
      $('input[name="time"]').val(h1.textContent);

      timer();
  }
  function timer() {
      t = setTimeout(add, 1000);
  }
  

  start.onclick = timer;

  stop.onclick = function() {
      clearTimeout(t);
  };

  btnClear.onclick = function() {
      h1.textContent = "00:00:00";
      seconds = 0; minutes = 0; hours = 0;
  }
</script>
  <?php $this->load->view('/admin/template/notice');?>
</body>
</html>
