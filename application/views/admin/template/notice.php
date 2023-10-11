
<script src="<?php echo base_url().'assets/dist/js/jquery.blockUI.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>

<?php if ($this->session->flashdata('success')): ?>
  <script type="text/javascript">
    $.toast({
      heading: 'Success', text: "<?php echo $this->session->flashdata('success'); ?>", icon: 'success', position: 'top-right', hideAfter: 6000,
    });
  </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
  <script type="text/javascript">
    $.toast({
      heading: 'Error', text: "<?php echo $this->session->flashdata('error'); ?>", icon: 'error', position: 'top-right', hideAfter: 6000,
    });
  </script>
<?php endif; ?>

<?php if ($this->session->flashdata('warning')): ?>
  <script type="text/javascript">
    $.toast({
      heading: 'Warning', text: "<?php echo $this->session->flashdata('warning'); ?>", icon: 'warning', position: 'top-right', hideAfter: 6000,
    });
  </script>
<?php endif; ?>