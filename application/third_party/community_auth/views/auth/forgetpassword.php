<!doctype html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Log In | Dangote Refinery</title>
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

<body class="authentication-bg">

    <div class="home-btn d-none d-sm-block">
        <a href="index.php" class="text-dark"><i class="mdi mdi-home-variant h2"></i></a>
    </div>
    <div class="account-pages">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-12">
                    <div class="card">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Enter your email address for reset link.</p>
                            </div>
                            <div class="p-2 mt-1">

                                <form id="reg_form" action="<?php echo site_url('auth/forgotpassword_process'); ?>" method="post">
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Email</label>
                                        <input type="email" name="email" id="login_string" autocomplete="off" maxlength="255" class="form-control" placeholder="Enter Email" required/>
                                    </div>
                                    <p><strong>If you do not see the email in a few minutes, check your “junk mail” folder or “spam” folder.</strong></p>
                                <button name="submit" value="sumbit" class="btn btn-xs btn-primary">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>© <script>
                                document.write(new Date().getFullYear())
                            </script> Mahesh V & CO. </p>
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
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
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

</script>