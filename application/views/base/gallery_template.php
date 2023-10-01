<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Jewel Bazar</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/chartist/css/chartist.min.css">
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="<?php echo base_url(); ?>" class="brand-logo">
                <img class="logo-abbr" src="<?php echo base_url(); ?>/assets/images/logo.png" />
                <img class="brand-title" src="<?php echo base_url(); ?>/assets/images/logo-text.png" />
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->


        <!--**********************************
            Header start
        ***********************************-->
        <?php include('header.php'); ?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include('left_menu.php'); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            EventList
        ***********************************-->

        <!-- <?php
                if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'dashboard') {
                    include('event_side_bar.php');
                }
                ?> -->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body <?php echo ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'dashboard') ? 'rightside-event' : '';  ?>">
            <!-- row -->
            <div class="container-fluid">
                <?php echo $content; ?>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Developed by <a href="https://alphasoftz.com/" target="_blank">AlphasoftZ</a> <?php echo date('Y'); ?></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?php echo base_url(); ?>assets/vendor/global/global1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-datetimepicker/js/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Apex Chart -->
    <script src="<?php echo base_url(); ?>assets/vendor/apexchart/apexchart.js"></script>

    <!-- Chart piety plugin files -->
    <script src="<?php echo base_url(); ?>assets/vendor/peity/jquery.peity.min.js"></script>

    <!-- Dashboard 1 -->
    <script src="<?php echo base_url(); ?>assets/js/dashboard/dashboard-1.js"></script>

    <!-- Datatable -->
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins-init/datatables.init.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/deznav-init.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/demo.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/sweetalert.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/select2/js/select2.min.js"></script>
</body>

</html>
<script>
$(document).ready(function() {
    $("select").select2();
});
</script>