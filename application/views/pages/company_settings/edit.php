<div class="page-content">
    <div class="container">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Company Settings</h4>

                    <div class="page-title-right">
                        <!-- <ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
    <li class="breadcrumb-item active">Form Validation</li>
    </ol> -->
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
                        <form action="<?php echo site_url('Company_settings/edit/' . $default['id']); ?>" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" id="validationCustom02" placeholder="Enter Client Name" value="<?php echo $default['company_name']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            State Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Company Phone Number</label>
                                        <input type="text" name="company_phone_number" class="form-control" id="validationCustom02" placeholder="Enter Company Phone Number" value="<?php echo $default['company_phone_number']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Company Phone Number Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Company Address</label>
                                        <input type="text" name="company_address" class="form-control" id="validationCustom02" placeholder="Enter Address" value="<?php echo $default['company_address']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Company Address Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">State</label>
                                        <input type="text" name="state" class="form-control" id="validationCustom02" placeholder="Enter State" value="<?php echo $default['state']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            State Required.
                                        </div>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="validationCustom01" class="form-label"> State</label>
                                        <select name="state" id="state" class="form-control select2" onchange="get_city(this.value)" required>
                                            <option value="">Select State</option>
                                            <?php foreach ($state as $s) { ?>
                                                <option <?php if ($default['state'] == $s->id) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $s->id; ?>"><?php echo $s->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            State Required.
                                        </div>
                                    </div> -->
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" id="validationCustom02" placeholder="Enter State" value="<?php echo $default['city']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            City Required.
                                        </div>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">City Name</label>
                                        <select name="city" id="city" class="form-control select2" required>
                                            <option value="">Select city</option>
                                            <?php foreach ($city as $ct) { ?>
                                                <option <?php if ($default['city'] == $ct->id) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $ct->id; ?>"><?php echo $ct->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            City Required.
                                        </div>
                                    </div> -->
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Pincode</label>
                                        <input type="text" name="pincode" class="form-control" id="validationCustom02" placeholder="Enter Pincode" value="<?php echo $default['pincode']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Pincode Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Land Line Name</label>
                                        <input type="text" name="help_line_number" class="form-control" id="validationCustom02" placeholder="Enter Contact Name" value="<?php echo $default['help_line_number']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Land Line Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Website Link</label>
                                        <input type="text" name="website_link" class="form-control" id="validationCustom02" placeholder="Enter website link" value="<?php echo $default['website_link']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            website link Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Company GST Number</label>
                                        <input type="text" name="company_gstin" class="form-control" id="validationCustom02" placeholder="Enter Company GSTIN Number" value="<?php echo $default['company_gstin']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Company GST Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Company TAN Number</label>
                                        <input type="text" name="company_tan_number" class="form-control" id="validationCustom02" placeholder="Enter Company TAN Number" value="<?php echo $default['company_tan_number']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Company TAN Required.
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label"> Country</label>
                                        <select name="country" class="form-control select2" onchange="get_state(this.value);" required>
                                            <option value="">Select Country</option>
                                            <?php foreach ($country as $c) { ?>
                                                <option <?php if ($default['country'] == $c->id) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Country Required.
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Invoice Starting Number</label>
                                        <input type="text" name="invoice_str_num" id="invoice_str_num" class="form-control" id="validationCustom02" placeholder="Enter Receipt Starting Number" value="<?php echo $default['invoice_str_num']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Invoice Starting Number Required.
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Company Pan</label>
                                        <input type="text" name="company_pan" id="company_pan" class="form-control" id="validationCustom02" value="<?php echo $default['company_pan']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Company Email Required.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Company Email</label>
                                        <input type="text" name="company_email" id="company_email" class="form-control" id="validationCustom02" value="<?php echo $default['company_email']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Company Email Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Company Logo</label>
                                        <input type="file" name="company_logo" id="company_logo" class="form-control" value="<?php echo $default['company_logo']; ?>">
                                         <img src="<?php echo $default['company_logo']; ?>" width="50px" height="40px">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Invoice Starting Number Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Credit Note Percentage</label>
                                        <input type="text" name="credit_note_percentage" class="form-control" placeholder="Enter Credit Note Percentage" value="<?php echo $default['credit_note_percentage']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Credit Note Starting Number</label>
                                        <input type="text" name="credit_note_starting" class="form-control" placeholder="Enter Credit Note Starting Number" value="<?php echo $default['credit_note_starting_number']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Sales Starting Number</label>
                                        <input type="text" name="sales_starting" class="form-control" placeholder="Enter Sales Starting Number" value="<?php echo $default['sales_starting_number']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Quotation Starting Number</label>
                                        <input type="text" name="quotation_starting_number" class="form-control" placeholder="Enter Quotation Starting Number" value="<?php echo $default['quotation_starting_number']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Bank Name</label>
                                        <input type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name" value="<?php echo $default['bank_name']; ?>">
                                    </div>
                                </div>
  
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Bank Account Number</label>
                                        <input type="text" name="bank_account_no" class="form-control" placeholder="Enter Account Number" value="<?php echo $default['bank_account_no']; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Bank Address</label>
                                        <textarea type="text" name="bank_address" class="form-control" placeholder="Enter Address" value="<?php echo $default['bank_address']; ?>"><?php echo $default['bank_address']; ?></textarea>
                                        <!-- <input type="text" name="bank_address" class="form-control" placeholder="Enter Address" value="<?php echo $default['bank_address']; ?>"> -->
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Bank IFSC</label>
                                        <input type="text" name="bank_ifsc" class="form-control" placeholder="Enter IFSC" value="<?php echo $default['bank_ifsc']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Terms</label>
                                        <textarea type="text" name="terms" class="form-control" placeholder="Enter Terms" value="<?php echo $default['terms']; ?>"><?php echo $default['terms']; ?></textarea>
                                        <!-- <input type="text" name="terms" class="form-control" placeholder="Enter Terms" value="<?php echo $default['terms']; ?>"> -->
                                    </div>
                                </div>

                            </div>

                            <div>
                                <button class="btn btn-primary" type="submit" value="submit" name="submit">Submit</button>
                                <a href="<?php echo site_url('Company_settings'); ?>"><button class="btn btn-warning" type="button">Back</button></a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <script>
        function get_state(country_id) {
            get_country_std(country_id);
            $.ajax({
                url: "<?php echo site_url() ?>/City/get_state",
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
                url: "<?php echo site_url() ?>/City/get_city",
                method: "POST",
                type: "ajax",
                data: {
                    state_id: state_id
                },
                success: function(result) {
                    var data = JSON.parse(result);
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

        function get_country_std(country_id) {
            $.ajax({
                url: "<?php echo site_url() ?>/client_group/get_invoice_str_num",
                method: "POST",
                type: "ajax",
                data: {
                    country_id: country_id
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    //console.log(data);
                    $('#invoice_str_num').val(data[0].phonecode);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>