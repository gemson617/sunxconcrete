<link href="<?php echo base_url('assets/libs/select2/css/select2.min.css'); ?>" rel="stylesheet" type="text/css" />
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
        <!-- start page title -->
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
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Add Customer Management</h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <!--OLD FORM-->                        
                        <form action="<?php echo site_url('Customer/add'); ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="row">
                            <h4>Customer Particulars</h4>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom01" class="form-label">Name of The Company</label>
                                        <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Enter Company Name" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Name of The Company Required.
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom09" class="form-label">Business</label>
                                        <input type="text" name="customer_business" class="form-control" id="customer_business" placeholder="Enter Business" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Business Required.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom02" class="form-label">Address Line 1</label>
                                        <input type="text" name="customer_address_1" class="form-control" id="customer_address_1"  placeholder="Enter Address Line 1" maxlength="10" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Address Line 1 Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom09" class="form-label">Address Line 2</label>
                                        <input type="text" name="customer_address_2" class="form-control" id="customer_address_2" placeholder="Enter Address Line 2" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Address Line 2 Required.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom08" class="form-label">City</label>
                                        <input type="text" name="customer_city" class="form-control" id="customer_city" placeholder="Enter City" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            City Required.
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom07" class="form-label">State Name</label>
                                        <select name="customer_state" class="form-control Select2" id="customer_state" required>
                                            <option value="">Select State</option>
                                            <?php foreach ($state as $d) { ?>
                                                <option <?php if ($d->id == 4035) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $d->id; ?>"><?php echo $d->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            State Name Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom11" class="form-label">Pincode</label>
                                        <input type="text" name="customer_pincode" class="form-control" id="customer_pincode" onkeypress="return isNumberKey(event);" placeholder="Enter Pincode" maxlength="6" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Pincode Required.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <HR>
                            <div class="row">
                            <h4>Company Promoter / CFO / CEO Particulars</h4>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom04" class="form-label">Name Of Contact Person</label>
                                        <input type="text" name="cp_name" class="form-control" id="cp_name" placeholder="Name Of Contact Person" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Name Of Contact Person Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom04" class="form-label">Contact Number </label>
                                        <input type="text" name="cp_contact_no" class="form-control" id="cp_contact_no" placeholder="Enter Contact Number" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Contact Number Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom03" class="form-label">E-Mail Address</label>
                                        <input type="text" name="cp_email" class="form-control" id="cp_email" onchange="return validateEmail(event);" placeholder="Enter E-Mail Address">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        E-Mail Address Required.
                                        </div>
                                    </div>
                                </div>
                               
                                </div>
                            <br>
                          
                            <div class="row">
                            <h4>Accounts point of contact (POC) Particulars</h4>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom04" class="form-label">APOC - Name Of Contact Person</label>
                                        <input type="text" name="apoc_name" class="form-control" id="apoc_name" placeholder="Enter APOC - Name" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Name Of Contact Person Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom06" class="form-label">APOC - Contact Number</label>
                                        <input type="text" name="apoc_contact_no" class="form-control apoc_contact_no" onkeypress="return isNumberKey(event);" id="apoc_contact_no" placeholder="Enter APOC - Contact Number" maxlength="10" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            APOC - Contact Number Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom03" class="form-label">APOC - E-Mail</label>
                                        <input type="text" name="apoc_email" class="form-control" id="apoc_email" onchange="return validateEmail(event);" placeholder="Enter APOC - E-Mail">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        APOC - E-Mail  Required.
                                        </div>
                                    </div>
                                </div>
                                           
                                </div>
                            <br>
                           
                           
                            <div class="row">
                            <h4>Purchase point of contact (POC) Particulars</h4>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom04" class="form-label">PPOC - Name Of Contact Person</label>
                                        <input type="text" name="ppoc_name" class="form-control" id="ppoc_name" placeholder="Enter PPOC - Name" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        PPOC - Name Of Contact Person Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom06" class="form-label">PPOC - Contact Number</label>
                                        <input type="text" name="ppoc_contact_no" class="form-control ppoc_contact_no" onkeypress="return isNumberKey(event);" id="ppoc_contact_no" placeholder="Enter PPOC - Contact Number" maxlength="10" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            PPOC - Contact Number Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom03" class="form-label">PPOC - E-Mail</label>
                                        <input type="text" name="ppoc_email" class="form-control" id="ppoc_email" onchange="return validateEmail(event);" placeholder="Enter APOC - E-Mail">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        PPOC - E-Mail  Required.
                                        </div>
                                    </div>
                                </div>
                                           
                                </div>
                            <br>
                            <HR>
                            <div class="row">
                            <h4>Satutory Details</h4>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom09" class="form-label">PAN Number</label>
                                        <input type="text" name="customer_pan" class="form-control" id="customer_pan" placeholder="Enter PAN" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        PAN Number Required.
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom09" class="form-label">GST Registration Number</label>
                                        <input type="text" name="customer_gst_no" class="form-control" id="customer_gst_no" placeholder="Enter GST No" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        GST Registration Number Required.
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom09" class="form-label">CIN Number</label>
                                        <input type="text" name="customer_cin_no" class="form-control" id="customer_cin_no" placeholder="Enter CIN No" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        CIN Number Required.
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom09" class="form-label">Last F.Y Annual Turnover in Crore</label>
                                        <input type="text" name="last_annual_turnover_cr" class="form-control" id="last_annual_turnover_cr" placeholder="Enter Annual Turnover" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Last F.Y Annual Turnover in Crore.
                                        </div>
                                    </div>
                                </div> 
                                 <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom09" class="form-label">TAN Number</label>
                                        <input type="text" name="customer_tan_no" class="form-control" id="customer_tan_no" placeholder="Enter TAN No" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        TAN Number Required.
                                        </div>
                                    </div>
                                </div> 
                              <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom10" class="form-label">MSME / SSI</label>
                                        <input type="text" name="customer_msme_ssi" class="form-control" id="customer_msme_ssi" placeholder="Enter MSME/SSI" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        MSME / SSI Required.
                                        </div>
                                    </div>
                                </div> 
                               
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom10" class="form-label">Aadhaar No</label>
                                        <input type="text" name="customer_aadhaar" class="form-control" id="customer_aadhaar" placeholder="Enter Aadhaar No" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Aadhaar No Required.
                                        </div>
                                    </div>
                                </div> 
                           
                            </div>
                            <br>
                            <HR>
                            <div class="row">
                            <h4>Payment Terms</h4>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom04" class="form-label">Payment Terms in Days</label>
                                        <input type="text" name="payment_terms_days" class="form-control" id="payment_terms_days" placeholder="Payment Terms in Days" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Payment Terms in Days Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom06" class="form-label">Product Supply</label>
                                        <input type="text" name="product_supply" class="form-control product_supply" id="ppoc_contact_no" placeholder="Enter Product Supply" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            PPOC - Contact Number Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="validationCustom03" class="form-label">Customer Credit Limit</label>
                                        <input type="text" name="customer_credit_limit" class="form-control" id="customer_credit_limit"  placeholder="Enter Customer Credit Limit">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        PPOC - E-Mail  Required.
                                        </div>
                                    </div>
                                </div>
                                           
                                </div>
                            <br>
                            <div>
                                <button class="btn btn-primary mybtn" type="submit" value="submit" name="submit">Submit</button>
                                <a href="<?php echo site_url('Customer'); ?>"><button class="btn btn-warning" type="button">Back</button></a>
                            </div>
                        </form>
                        <!--OLD FORM-->
                        <!--NEW FORM-->

                        <!--NEW FORM-->
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/6.4.1/css/intlTelInput.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/6.4.1/js/intlTelInput.min.js"></script> -->
    <script type="text/javascript">
        // when page is ready
        $(document).ready(function() {

        })

        function validateEmail(emailField) {
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if (reg.test(emailField.value) == false) {
                //  alert('Invalid Email Address');
                return false;
            } else {
                return true;
            }
        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if ((charCode < 48 || charCode > 57)) {
                return false;
            } else {
                return true;
            }
        }
    </script>
    <script>
        function get_state(country_id) {
            $.ajax({
                url: "<?php echo site_url() ?>/client/get_state",
                method: "POST",
                type: "ajax",
                data: {
                    country_id: country_id
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    $('#state')
                        .find('option')
                        .remove();
                    $.each(data, function(key, value) {
                        var option = '<option value="' + value.id + '">' + value.name +
                            '</option>';
                        $('#state').append(option);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function get_city(state_id) {
            $.ajax({
                url: "<?php echo site_url() ?>/client/get_city",
                method: "POST",
                type: "ajax",
                data: {
                    state_id: state_id
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    // alert(data);
                    $('#city')
                        .find('option')
                        .remove();
                    $.each(data, function(key, value) {
                        var option = '<option value="' + value.id + '">' + value.name +
                            '</option>';
                        $('#city').append(option);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>

    <script src="<?php echo base_url('assets/libs/select2/js/select2.min.js'); ?>"></script>