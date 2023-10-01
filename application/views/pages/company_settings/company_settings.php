<div class="page-content">
    <div class="container">
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <?php if ($add_option == 1) { ?>
                            <a href="<?php echo site_url('company_settings/add'); ?>"><button style="float:right;" type="button" class="btn btn-sm btn-success waves-effect btn-label waves-light"><i class="bx bx-plus label-icon"></i> Add</button></a>
                        <?php } ?>
                        <br> -->
                        <h4 class="card-title mb-3">Company Settings</h4>
                        <table id="datatable" class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">S.no</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">GST</th>
                                    <th scope="col">Web Link</th>                                    
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datatable as $key => $d) { ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $d->company_name; ?></td>
                                        <td><?php echo $d->company_phone_number; ?></td>
                                        <td><?php echo $d->company_gstin; ?></td>
                                        <td><?php echo $d->website_link; ?></td>
                                        <td><?php if ($d->status == 1) {
                                                echo "Active";
                                            } else {
                                                echo "InActive";
                                            } ?></td>
                                        <td>
                                            <?php if ($edit_option == 1) { ?>
                                                <a href="<?php echo site_url('company_settings/edit/' . $d->id); ?>"><button type="button" class="btn btn-sm btn-primary waves-effect waves-light"><i class="bx bx-pencil"></i></button></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function delete_item(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(isConfirmed => {
            if (isConfirmed.value) {
                $.ajax({
                    url: "<?php echo base_url(); ?>company/delete/" + id + "/",
                    success: function(result) {
                        if (result) {
                            window.location('company');
                        }
                    }
                });

                if (isConfirmed.value) {
                    Swal.fire(
                        'Deleted!',
                        'Company  master has been deleted.',
                        'success'
                    );
                    window.location.reload();
                }
            }
        });
    }

    function update_status(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You can always change the status to active or in-active!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Change it!'
        }).then(isConfirmed => {
            if (isConfirmed.value) {
                $.ajax({
                    url: "<?php echo base_url(); ?>company/change_status/" + id + "/",
                    success: function(result) {
                        if (result) {
                            console.log(result);
                            window.location.reload();
                        }
                    }
                });

                if (isConfirmed.value) {
                    Swal.fire(
                        'Changed!',
                        'Company  status has been changed successfully!',
                        'success'
                    );
                    window.location.reload();
                }
            }
        });
    }
</script>