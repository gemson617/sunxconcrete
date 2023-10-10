<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="sunxconcrete" name="description" />
    <meta content="" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo site_url('assets/images/logo.jpg');?>">



    <!-- <link href="<?php echo base_url('assets/libs/select2/css/select2.min.css'); ?>" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/app.min.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/libs/spectrum-colorpicker2/spectrum.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/%40chenfengyuan/datepicker/datepicker.min.css'); ?>">
      <!-- Time picker -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <link href="<?php echo base_url('assets/libs/bootstrap-4.0.0/assets/css/docs.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/popup_boostrap/css/bootstrap.min.css'); ?>" rel="stylesheet" id="bootstrap-css">
<script src="<?php echo base_url('assets/popup_boostrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/popup_boostrap/jquery/jquery-1.11.1.min.js'); ?>"></script>

</head>

<body data-sidebar="dark">
    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include('header.php'); ?>
        <?php include('left_menu.php'); ?>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <?php echo $content; ?>
        </div>

        <?php include('footer.php'); ?>
    </div>
    <!-- END layout-wrapper -->
    <?php 
    ?>


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!-- JAVASCRIPT -->

    <!-- apexcharts -->
    <script src="<?php echo base_url('assets/libs/apexcharts/apexcharts.min.js'); ?>"></script>

    <!-- dashboard init -->
    <script src="<?php echo base_url('assets/js/pages/dashboard.init.js'); ?>"></script>


    <script src="<?php echo base_url('assets/libs/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/metismenu/metisMenu.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/simplebar/simplebar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/node-waves/waves.min.js'); ?>"></script>
   
    <script src="<?php echo base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/spectrum-colorpicker2/spectrum.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/%40chenfengyuan/datepicker/datepicker.min.js'); ?>"></script>
    <!-- form advanced init -->
    <script src="<?php echo base_url('assets/js/pages/form-advanced.init.js'); ?>"></script>

    <!-- Required datatable js -->
    <script src="<?php echo base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <!-- Buttons examples -->
    <script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/jszip/jszip.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/pdfmake/build/pdfmake.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/pdfmake/build/vfs_fonts.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/ajax.aspnetcdn.com_ajax_jquery.validate_1.11.1_jquery.validate.min.js'); ?>"></script>
	<!-- <script src="{{ asset('agas') }}"></script> -->

    <!-- Responsive examples -->
    <script src="<?php echo base_url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/pages/datatables.init.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/pages/form-validation.init.js'); ?>"></script>
    <!-- Sweet Alerts js -->
    <script src="<?php echo base_url(); ?>assets/js/sweetalert.js"></script>

    <!-- jquery step -->
    <script src="<?php echo base_url(); ?>assets/libs/jquery-steps/build/jquery.steps.min.js"></script>

    <?php if ($this->auth_level != 6) { ?>
        <!-- form wizard init -->
        <script src="<?php echo base_url(); ?>assets/js/pages/form-wizard.init.js"></script>
    <?php } ?>
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <!-- <script src="<?php echo base_url('assets/js/table2excel.js');?>"></script> -->
    <script src="<?php echo base_url('assets/js/jquery.table2excel.js');?>"></script>
    <link href="<?php echo base_url('assets/libs/select2/css/select2.min.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('assets/libs/select2/js/select2.min.js'); ?>"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/apexcharts.init.js"></script>
    <!-- Time picker -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap-4.0.0/assets/js/doc.min.js"></script> 
</body>



</html>

<script>
    $(function(){
        $('select').select2();
    });
</script>