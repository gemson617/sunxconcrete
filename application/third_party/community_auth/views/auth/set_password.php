<!doctype html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Log In | Expat</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* BASIC */

        a {
            color: #92badd;
            display: inline-block;
            text-decoration: none;
            font-weight: 400;
        }

        h2 {
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
            margin: 40px 8px 10px 8px;
            color: #cccccc;
        }



        /* STRUCTURE */

        .wrapper {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            min-height: 100%;
            padding: 20px;
        }

        #formContent {
            -webkit-border-radius: 10px 10px 10px 10px;
            border-radius: 10px 10px 10px 10px;
            background: #fff;
            padding: 30px;
            width: 90%;
            max-width: 450px;
            position: relative;
            padding: 0px;
            -webkit-box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
            box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        #formFooter {
            background-color: #f6f6f6;
            border-top: 1px solid #dce8f1;
            padding: 25px;
            text-align: center;
            -webkit-border-radius: 0 0 10px 10px;
            border-radius: 0 0 10px 10px;
        }



        /* TABS */

        h2.inactive {
            color: #cccccc;
        }

        h2.active {
            color: #0d0d0d;
            border-bottom: 2px solid #5fbae9;
        }



        /* FORM TYPOGRAPHY*/

        input[type=button],
        input[type=submit],
        input[type=reset] {
            background-color: #16702d;
            border: none;
            color: white;
            padding: 15px 11px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            font-size: 13px;
            -webkit-box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
            box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
            -webkit-border-radius: 5px 5px 5px 5px;
            border-radius: 5px 5px 5px 5px;
            margin: 5px 20px 40px 20px;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        input[type=button]:hover,
        input[type=submit]:hover,
        input[type=reset]:hover {
            background-color: #c4221c;
        }

        input[type=button]:active,
        input[type=submit]:active,
        input[type=reset]:active {
            -moz-transform: scale(0.95);
            -webkit-transform: scale(0.95);
            -o-transform: scale(0.95);
            -ms-transform: scale(0.95);
            transform: scale(0.95);
        }

        input[type=text] {
            background-color: #f6f6f6;
            border: none;
            color: #0d0d0d;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px;
            width: 85%;
            border: 2px solid #f6f6f6;
            -webkit-transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -ms-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;
            -webkit-border-radius: 5px 5px 5px 5px;
            border-radius: 5px 5px 5px 5px;
        }

        input[type=text]:focus {
            background-color: #fff;
            border-bottom: 2px solid #5fbae9;
        }

        input[type=text]:placeholder {
            color: #cccccc;
        }



        /* ANIMATIONS */

        /* Simple CSS3 Fade-in-down Animation */
        .fadeInDown {
            -webkit-animation-name: fadeInDown;
            animation-name: fadeInDown;
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        @-webkit-keyframes fadeInDown {
            0% {
                opacity: 0;
                -webkit-transform: translate3d(0, -100%, 0);
                transform: translate3d(0, -100%, 0);
            }

            100% {
                opacity: 1;
                -webkit-transform: none;
                transform: none;
            }
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                -webkit-transform: translate3d(0, -100%, 0);
                transform: translate3d(0, -100%, 0);
            }

            100% {
                opacity: 1;
                -webkit-transform: none;
                transform: none;
            }
        }

        /* Simple CSS3 Fade-in Animation */
        @-webkit-keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @-moz-keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fadeIn {
            opacity: 0;
            -webkit-animation: fadeIn ease-in 1;
            -moz-animation: fadeIn ease-in 1;
            animation: fadeIn ease-in 1;

            -webkit-animation-fill-mode: forwards;
            -moz-animation-fill-mode: forwards;
            animation-fill-mode: forwards;

            -webkit-animation-duration: 1s;
            -moz-animation-duration: 1s;
            animation-duration: 1s;
        }

        .fadeIn.first {
            -webkit-animation-delay: 0.4s;
            -moz-animation-delay: 0.4s;
            animation-delay: 0.4s;
        }

        .fadeIn.second {
            -webkit-animation-delay: 0.6s;
            -moz-animation-delay: 0.6s;
            animation-delay: 0.6s;
        }

        .fadeIn.third {
            -webkit-animation-delay: 0.8s;
            -moz-animation-delay: 0.8s;
            animation-delay: 0.8s;
        }

        .fadeIn.fourth {
            -webkit-animation-delay: 1s;
            -moz-animation-delay: 1s;
            animation-delay: 1s;
        }

        /* Simple CSS3 Fade-in Animation */
        .underlineHover:after {
            display: block;
            left: 0;
            bottom: -10px;
            width: 0;
            height: 2px;
            background-color: #56baed;
            content: "";
            transition: width 0.2s;
        }

        .underlineHover:hover {
            color: #0d0d0d;
        }

        .underlineHover:hover:after {
            width: 100%;
        }



        /* OTHERS */

        *:focus {
            outline: none;
        }

        #icon {
            width: 60%;
        }

        #pass_form {
            margin: 10px;
        }

        label,
        span {
            font-family: verdana;
            font-size: 10px;
        }

        input {
            padding: 2px;
            color: gray;
        }

        #passstrength {
            border: 1px solid #f6f6f6;
            width: 145px;
            height: 10px;
        }

        #progress {
            margin: 0px 87px;
        }

        #progress span,
        #progress div {
            float: left;
        }

        #progress span {
            margin: 0 5px;
        }

        #bar {
            height: 10px;
        }

        .medium {
            width: 75%;
            background-color: orange;
        }

        .bad {
            width: 25%;
            background-color: red;
        }

        .strong {
            width: 100%;
            background-color: green;
        }

        .normal {
            width: 50%;
            background-color: yellow;
        }
    </style>


    <style>
        @import url(http://fonts.googleapis.com/css?family=Lobster);

        #page {
            margin: 0 15px;
            padding-top: 30px;
        }

        .btn-primary {
            background-color: #fa1954;
            border: 0;
            margin: 10px 0;
        }

        .btn-primary:hover {
            background-color: #db053d;
        }

        .form-group.error input {
            border-color: #ee4141;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(238, 65, 65, .4);
        }

        .form-group.error label.error {
            margin-top: 5px;
            color: #ee4141;
        }

        .pod h3 {
            text-align: center;
            margin: 10px 0 30px;
            font-family: 'Lobster', cursive;
        }

        #password-info {
            margin: 20px 0;
            overflow: hidden;
            text-shadow: 0 1px 0 #fff;
        }

        #password-info ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        #password-info ul li {
            padding: 10px 10px 10px 50px;
            margin-bottom: 1px;
            background: #f4f4f4;
            font-size: 12px;
            transition: 250ms ease;
            position: relative;
        }

        #password-info ul li .icon-container {
            display: block;
            width: 40px;
            background: #92bce0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            text-align: center;
        }

        #password-info ul li .icon-container .fa {
            color: white;
            padding-top: 10px;
            position: relative;
            top: 2px;
        }

        #password-info ul li .tip {
            color: #5ca6d5;
            text-decoration: underline;
        }

        #password-info ul li.valid {
            color: #129652;
        }

        #password-info ul li.valid .icon-container {
            background-color: #18c36b;
        }

        #password-info ul li span.invalid {
            color: #ff642e;
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
                    <!-- <div class="text-center">
                        <a href="index.php" class="mb-5 d-block auth-logo">
                            <img src="<?php echo site_url(); ?>assets/images/logo-dark.png" alt="" height="" class="logo logo-dark">
                            <img src="<?php echo site_url(); ?>assets/images/logo-light.png" alt="" height="70" class="logo logo-light">
                        </a>
                    </div> -->
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-12">
                    <div class="card">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Enter your password.</p>
                            </div>
                            <div class="p-2 mt-1">


                                <!--NEW PASS-->
                                <form action="<?php echo site_url('auth/set_new_password'); ?>" method="post">
                                    <!--PASSWORD VALIDATION-->
                                    <div id="page">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3 col-lg-12 col-lg-offset-4">
                                                <div class="pod">
                                                    <h3>Reset password</h3>
                                                    <fieldset class="fieldset-password">
                                                        <!-- <div id="alert-invalid-password" class="alert alert-danger hide">Please enter a valid password</div> -->
                                                        <p>All checkmarks must turn green in order to proceed</p>
                                                        <div id="password-info">
                                                            <ul>
                                                                <li id="length" class="invalid clearfix">
                                                                    <span class="icon-container">
                                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                                    </span>
                                                                    At least 8 characters
                                                                </li>
                                                                <li id="capital" class="invalid clearfix">
                                                                    <span class="icon-container">
                                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                                    </span>
                                                                    At least 1 uppercase letter
                                                                </li>
                                                                <li id="lowercase" class="invalid clearfix">
                                                                    <span class="icon-container">
                                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                                    </span>
                                                                    At least 1 lowercase letter
                                                                </li>
                                                                <li id="number-special" class="invalid clearfix">
                                                                    <span class="icon-container">
                                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                                    </span>
                                                                    At least 1 number or <span title="&#96; &#126; &#33; &#64; &#35; &#36; &#37; &#94; &#38; &#42; &#40; &#41; &#43; &#61; &#124; &#59; &#58; &#39; &#34; &#44; &#46; &#60; &#62; &#47; &#63; &#92; &#45;" class="special-characters tip">special character</span>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <br>
                                                        <div class="mb-3">

                                                            <input type="text" id="input-password" class="required form-control" autocomplete="off" name="password" placeholder="password">
                                                            <!-- <input type="password" name="password" id="password" autocomplete="off" maxlength="255" class="form-control" placeholder="Enter password" /> -->
                                                        </div>
                                                        <div class="mb-3">

                                                            <input type="text" id="input-password1" class="required form-control" name="confirm_password" autocomplete="off" maxlength="255" placeholder="Confirm password" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <span id='message'></span>
                                                        </div>
                                                        <input type="hidden" name="user_email" value="<?php echo $_GET['e'];?>">
                                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                    </fieldset>
                                                    <div class="form-actions clearfix">
                                                        <input type="submit" class="fadeIn fourth mybtn" value="Choose Your Password">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--NEW PASS-->

                                    <!-- <div class="mb-3">
                                        <label class="form-label" for="username">Password</label>
                                        <input type="password" name="password" id="password" autocomplete="off" maxlength="255" class="form-control" placeholder="Enter password" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Confirm Password</label>
                                        <input type="password" id="confirm_password" name="confirm_password" autocomplete="off" maxlength="255" class="form-control" placeholder="Enter password" />
                                    </div>
                                    <div class="mb-3">
                                    <span id='message'></span>
                                    </div>
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <button name="submit" value="sumbit" class="btn btn-xs btn-primary">Submit</button> -->
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>© <script>
                                document.write(new Date().getFullYear())
                            </script> whistle.ws. </p>
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

    <script>
        $('#input-password, #input-password1').on('keyup', function() {
            if ($('#input-password').val() == $('#input-password1').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else
                $('#message').html('Not Matching').css('color', 'red');
        });
    </script>

</body>

</html>


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>

  $(function(){
      $(".mybtn").prop("disabled", true);
  });
/* Strong = 8 caracteres alfanuméricos + mayúsculas + símbolos
 * Medium = 7 caracteres alfanuméricos + mayúsculas
 * Normal = 6 o más caracteres
 * Bad = el resto
 */
document.querySelector('#input-password').onkeyup = function(e) {
  var result = document.querySelector('#bar'),
      pass = this.value,
      strong = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g"),
      medium = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g"),
      normal = new RegExp("(?=.{6,}).*", "g"),
      meter;
  if (pass.length) {
    if (strong.test(pass)) {
      meter = "strong";
    } else if (medium.test(pass)) {
      meter = "medium";
    } else if (normal.test(pass)) {
      meter = "normal";
    } else {
      meter = "bad";
    }
  } else {
    meter = "";
  }
  result.className = meter;
  return true;
};



// Tooltips
// -----------------------------------------

// Only initialise tooltips if devices is non touch
if (!('ontouchstart' in window)) {
    $('.tip').tooltip();
}

// Password Validation
// -----------------------------------------

$(function passwordValidation() {

    var pwdInput = $('#input-password');
    var pwdInputText = $('#input-password-text'); // This is the input type="text" version for showing password
    var pwdValid = false;

    var A;
    var B;
    var C;
    var D;
    function validatePwdStrength() {

        var pwdValue = $(this).val(); // This works because when it's called it's called from the pwdInput, see end

        // Validate the length
        if (pwdValue.length > 7) {
            $('#length').removeClass('invalid').addClass('valid');
            pwdValid = true;
            A=true;
        } else {
            $('#length').removeClass('valid').addClass('invalid');
            A=false;
        }

        // Validate capital letter
        if (pwdValue.match(/[A-Z]/)) {
            $('#capital').removeClass('invalid').addClass('valid');
            pwdValid = pwdValid && true;
            B=true;
        } else {
            $('#capital').removeClass('valid').addClass('invalid');
            pwdValid = false;
            B=false;
        }

        // Validate lowercase letter
        if (pwdValue.match(/[a-z]/)) {
            $('#lowercase').removeClass('invalid').addClass('valid');
            pwdValid = pwdValid && true;
            C=true;
        } else {
            $('#lowercase').removeClass('valid').addClass('invalid');
            pwdValid = false;
            C=false;
        }

        // Validate number or special character
        if (pwdValue.match(/[\d`~!@#$%\^&*()+=|;:'",.<>\/?\\\-]/)) {
            $('#number-special').removeClass('invalid').addClass('valid');
            pwdValid = pwdValid && true;
            D=true;
        } else {
            $('#number-special').removeClass('valid').addClass('invalid');
            pwdValid = false;
            D=false;
        }

        if(A && B && C && D){
            $(".mybtn").prop('disabled', false);
        }else{
          $(".mybtn").prop('disabled', true);
        }
    }

   

    pwdInput.bind('change keyup input', validatePwdStrength); // Keyup is a bit unpredictable
    pwdInputText.bind('change keyup input', validatePwdStrength); // This is the input type="text" version for showing password

  

}); // END passwordValidation()

</script>