<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="<?= base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js'; ?>"></script> -->
<script src="<?= base_url() . 'assets/bootstrap/js/bootstrap.min.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/fastclick/fastclick.js'; ?>"></script>
<script src="<?= base_url() . 'assets/dist/js/app.min.js'; ?>"></script>
<script src="<?= base_url() . 'assets/dist/js/demo.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/toast/jquery.toast.min.js'; ?>"></script>
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

<script src="<?= base_url() . 'assets/dist/js/jquery.blockUI.js' ?>"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>

<?php if ($this->session->flashdata('success')) : ?>
    <script type="text/javascript">
        $.toast({
            heading: 'Success',
            text: "<?= $this->session->flashdata('success'); ?>",
            icon: 'success',
            position: 'top-right',
            hideAfter: 6000,
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')) : ?>
    <script type="text/javascript">
        $.toast({
            heading: 'Error',
            text: "<?= $this->session->flashdata('error'); ?>",
            icon: 'error',
            position: 'top-right',
            hideAfter: 6000,
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('warning')) : ?>
    <script type="text/javascript">
        $.toast({
            heading: 'Warning',
            text: "<?= $this->session->flashdata('warning'); ?>",
            icon: 'warning',
            position: 'top-right',
            hideAfter: 6000,
        });
    </script>
<?php endif; ?>