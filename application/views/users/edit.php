<style>
    :root {
        --color-blue: #1777E5;
        --color-blue-light: #D7E8FC;
        --color-blue-ultra-light: #EDF4FC;
        --color-dark-grey: #46494D;
        --color-border: #C2D8F2;
        --color-red-light: #F2DDDA;
        --color-red: #E0351B;

        --container-width: 1080px;
        --form-control-height: 50px;

        --base-font: 'Roboto', sans-serif;
    }

    .eye {
        width: 13px;
        height: 13px;
        border: solid 1px #1777e5;
        border-radius: 75% 15%;
        transform: rotate(45deg);
        opacity: .75;
        position: absolute;
        top: 19px;
        right: 13px;
        cursor: pointer;
        z-index: 200;
    }

    .eye.closed {
        background: #1777e5;
        opacity: .5;
    }

    .eye:before {
        content: '';
        display: block;
        position: absolute;
        width: 5px;
        height: 5px;
        border: solid 1px #1777e5;
        border-radius: 50%;
        left: 3px;
        top: 3px;
    }

    .form-control {
        background-color: #fff;
        min-height: var(--form-control-height);
        color: var(--color-dark-grey);
        border: 1px solid var(--color-border);
        border-radius: 5px;
        font-size: 15px;
        padding: 12px 20px;
        font-family: var(--base-font);
        box-sizing: border-box;
    }

    .control {
        position: relative;
    }

    button.form-control {
        background: royalblue;
        color: #fff;
    }

    .rez {
        width: 200px;
        margin: 10px 0;
    }
</style>
<div class="page-content">
    <div class="container">
    <?php
        if ($this->auth_level >= 8 || $this->auth_level == 4) { 
            ?>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Employee Management</h4>
                    <div class="page-title-right">                       
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <?php
        if ($this->session->flashdata('alert_success')) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('alert_success'); ?>
            </div>
        <?php
        }
        if ($this->session->flashdata('alert_danger')) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('alert_danger'); ?>
            </div>
        <?php
        }
        if ($this->session->flashdata('alert_warning')) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('alert_warning'); ?>
            </div>
        <?php
        }
        ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo site_url('users/edit/'.$default['user_id']); ?>" method="post" class="needs-validation" novalidate>
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">First Name <span class="mandatory">*</span></label>
                                        <input type="text" name="first_name" class="form-control" id="validationCustom02" placeholder="Enter First Name" value="<?php echo $default['first_name'];?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        First Name Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Last Name <span class="mandatory">*</span></label>
                                        <input type="text" name="last_name" class="form-control" id="validationCustom02" placeholder="Enter Last Name" value="<?php echo $default['last_name'];?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Last Name Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Address <span class="mandatory"></span></label>
                                        <input type="text" name="address" class="form-control" id="validationCustom02" value="<?php echo $default['address'];?>" placeholder="Enter Address" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Address Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">PAN Number <span class="mandatory"></span></label>
                                        <input type="text" name="pan_number" class="form-control" id="pan_number" placeholder="Enter PAN Number" value="<?php echo $default['pan_number'];?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        PAN Number Required.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Aadhar Card Number <span class="mandatory"></span></label>
                                        <input type="text" name="aadhar_no" class="form-control" id="aadhar_no" placeholder="Enter Aadhar Card Number" value="<?php echo $default['aadhar_no'];?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Aadhar Card Number Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Date of Birth <span class="mandatory"></span></label>
                                        <input type="date" name="dob" class="form-control" id="dob" placeholder="Enter Date of Birth" value="<?php echo $default['dob'];?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Date of Birth Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Date of Joining <span class="mandatory"></span></label>
                                        <input type="date" name="doj" class="form-control" id="doj" placeholder="Enter Date of Joining" value="<?php echo $default['doj'];?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Date of Joining Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Bank Name <span class="mandatory"></span></label>
                                        <input type="text" name="bank" class="form-control" id="bank" placeholder="Enter Bank Name" value="<?php echo $default['bank'];?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Bank Name Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Bank Account Number <span class="mandatory"></span></label>
                                        <input type="text" name="account_no" class="form-control" id="account_no" placeholder="Enter Bank Account Number" value="<?php echo $default['account_no'];?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Bank Account Number Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">IFSC <span class="mandatory"></span></label>
                                        <input type="text" name="ifsc_no" class="form-control" id="ifsc_no" placeholder="Enter IFSC" value="<?php echo $default['ifsc_no'];?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        IFSC Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Email <span class="mandatory">*</span></label>
                                        <input type="text" name="email" class="form-control" id="validationCustom02" placeholder="Enter Email" value="<?php echo $default['email'];?>" onchange="return validateEmail(event);" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Email Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Contact Number <span class="mandatory">*</span></label>
                                        <input type="text" name="contact_number" class="form-control" id="validationCustom02" placeholder="Enter Contact Number" value="<?php echo $default['mobile'];?>" onkeypress="return isNumberKey(event);" maxlength="10" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Contact Number Required.
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Address <span class="mandatory"></span></label>
                                        <input type="text" name="address" class="form-control" id="validationCustom02" placeholder="Enter Address"  value="<?php echo $default['address'];?>">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Address Required.
                                        </div>
                                    </div>
                                </div> -->
                              
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Choose Role <span class="mandatory">*</span></label>
                                        <select name="role_id" class="form-control" id="validationCustom02 role_id" required disabled>
                                            <option value="">Select Role</option>
                                            <?php foreach ($role as $d) { ?>
                                                <option <?php if($default['auth_level'] == $d->id) { echo "selected"; } ?> value="<?php echo $d->id; ?>"><?php echo $d->role_name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Role Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Password</label>
                                        <!-- <input type="password" class="form-control" name="password" id="password" required> -->
                                        <div class="control">
                                            <input class="form-control key w-100" id="password" type="password" name="password" placeholder="Password">
                                            <i class="eye showPwd1"></i>
                                        </div>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Passwsord Required.
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Confirm Password</label>
                                        
                                        <div class="control">
                                            <input class="form-control key w-100" id="confirm_password" type="password" name="confirm_password" placeholder="Confirm Password">
                                            <i class="eye showPwd"></i>
                                        </div>                                        
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Confirm Password Required.
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <span id="passstrength"></span>
                                    </div>
                                </div>
                                <span id='message'></span>                                                    
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit" value="submit" name="submit">Submit</button>
                                <a href="<?php echo site_url('users'); ?>"><button class="btn btn-warning" type="button">Back</button></a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
        <?php }else{
            ?>
             <div class="row">
             <div class="col-xl-12">
                 <div class="card">
                     <div class="card-body">
                        <h3 align="center">Permission Denied</h3>
                     </div>
                 </div>
             </div>
             </div>
                        <?php
        }?>
        <!-- end row -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(function() {
            $('.mybtn').prop('disabled', true);
            $('#password').keyup(function(e) {
                var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
                var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
                var enoughRegex = new RegExp("(?=.{6,}).*", "g");
                if (false === enoughRegex.test($(this).val())) {
                    $('#passstrength').html('More Characters').css('color', 'red');
                } else if (strongRegex.test($(this).val())) {
                    $('#passstrength').className = 'ok';
                    $('#passstrength').html('Strong!').css('color', 'green');
                    $('#password, #confirm_password').on('keyup', function() {
                        if ($('#password').val() == $('#confirm_password').val()) {
                            $('#message').html('Matching').css('color', 'green');
                            $('.mybtn').prop('disabled', false);
                        } else {
                            $('#message').html('Not Matching').css('color', 'red');
                            $('.mybtn').prop('disabled', true);
                        }
                    });
                } else if (mediumRegex.test($(this).val())) {
                    $('#passstrength').className = 'alert';
                    $('#passstrength').html('Medium!').css('color', 'red');
                } else {
                    $('#passstrength').className = 'error';
                    $('#passstrength').html('Weak!').css('color', 'red');
                }
                return true;
            });
        });

        let pwd = document.getElementById('confirm_password'),
            eye = document.querySelector('.showPwd'),
            rez = document.querySelector('.rez'),
            btn = document.querySelector('button');

        eye.addEventListener('click', function() {
            toggleType();
        })

        pwd.addEventListener('change', function() {
            pwd.value = pwd.value.replace(/\s/g, '');
        })
        btn.addEventListener('click', function() {
            console.log('clk');
            rez.innerText = '_' + pwd.value + '_';
        })

        console.log(btn, rez, eye);

        function toggleType() {
            console.log('toggle');
            if (eye.classList.contains('closed')) {
                pwd.type = 'password';
            } else {
                pwd.type = 'text';
            }
            eye.classList.toggle('closed');
        }

        let pwd1 = document.getElementById('password'),
            eye1 = document.querySelector('.showPwd1'),
            rez1 = document.querySelector('.rez'),
            btn1 = document.querySelector('button');

        eye1.addEventListener('click', function() {
            toggleType1();
        })

        pwd1.addEventListener('change', function() {
            pwd1.value = pwd1.value.replace(/\s/g, '');
        })
        btn1.addEventListener('click', function() {
            console.log('clk');
            rez1.innerText = '_' + pwd1.value + '_';
        })
        console.log(btn1, rez1, eye1);

        function toggleType1() {
            console.log('toggle');
            if (eye1.classList.contains('closed')) {
                pwd1.type = 'password';
            } else {
                pwd1.type = 'text';
            }
            eye1.classList.toggle('closed');
        }

        function isNumberKey(evt) 
            {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                if ((charCode < 48 || charCode > 57))
                {
                    return false;
                }else{
                    return true;
                }
               
            }

        function validateEmail(emailField)
        {
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

            if (reg.test(emailField.value) == false) 
            {           
                //  alert('Invalid Email Address');
                return false;
            }else{
                return true;
            }

            
        }
    </script>
    
  