<!doctype html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>SUNXCONCRETE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Whistle Blower" name="description" />
    <meta content="Whistle" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo site_url('assets/images/favicon.ico'); ?>">

    <!-- Bootstrap Css -->
    <link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo site_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo site_url('assets/css/app.min.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .text-primary {
            color: #c32027 !important;
        }

        .btn-primary {
            color: #fff;
            background-color: #c0171c;
            border-color: #c4151b;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #dc141d;
            border-color: #dc141d;
        }
    </style>
</head>

<?php   
if ($this->session->flashdata('alert_success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> <?php echo $this->session->flashdata('alert_success'); ?>
    </div>
<?php
}

if ($this->session->flashdata('alert_danger')) {
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Error!</strong> <?php echo $this->session->flashdata('alert_danger'); ?>
    </div>
<?php
}

if ($this->session->flashdata('alert_warning')) {
?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> <?php echo $this->session->flashdata('alert_warning'); ?>
    </div>
<?php
}
if (validation_errors()) {
?>
    <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
<?php echo validation_errors(); ?>
</div> -->
<?php
}
?>
<body class="authentication-bg">

    
    <div class="account-pages">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="index.php" class="mb-5 d-block auth-logo">
                            <img src="assets/images/logo-dark.png" alt="" height="" class="logo logo-dark">
                            <img src="assets/images/logo-light.png" alt="" height="70" class="logo logo-light">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-12">
                    <div class="card">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Enter OTP.</p>
                            </div>
                            <div class="p-2 mt-1">

                                <form id="reg_form" action="<?php echo site_url('Dashboard/validate_otp'); ?>" method="post">
                                    <div class="mb-3">
                                        <label class="form-label" for="username">OTP</label>
                                        <input type="number" name="otp" id="login_string" autocomplete="off" class="form-control" placeholder="Enter OTP" required />
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                    </div>
                                    <p><strong>If you do not see the email in a few minutes, check your “junk mail” folder or “spam” folder.</strong></p>
                                    <button name="submit" value="sumbit" class="btn btn-xs btn-primary">Submit</button>
                                    <button type="button" value="resend_otp" class="btn btn-xs btn-info" onclick="resend_otp(<?php echo $user_id; ?>);">Resend OTP</button>
                                </form>

                            </div>

                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>© <script>
                                document.write(new Date().getFullYear())
                            </script> Expat. </p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?php echo site_url('assets/libs/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/libs/metismenu/metisMenu.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/libs/simplebar/simplebar.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/libs/node-waves/waves.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/libs/waypoints/lib/jquery.waypoints.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/libs/jquery.counterup/jquery.counterup.min.js'); ?>"></script>

    <script src="<?php echo site_url('assets/js/app.js'); ?>"></script>

</body>

</html>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert.js"></script>
<script>
    $(function() {
        $('#reg_form').validate({ // initialize the plugin
            rules: {
                email: {
                    required: true,
                    email: true
                },
            }
        });
    });

    function resend_otp(user_id){
        $.ajax({
                type: "POST",
                url: "<?php echo base_url('Dashboard/resend_otp'); ?>",
                data: {
                    'user_id': user_id
                },
                success: function(data) {
                    Swal.fire(
                        'OTP SEND!',
                        'OTP SEND SUCCESSFULLY',
                        'success'
                    );
                    //window.location.reload();
                    //console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
    }
</script>