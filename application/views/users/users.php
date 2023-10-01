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
                        <?php if ($this->auth_level >= 8 || $this->auth_level == 4) { ?>
                            <a href="<?php echo site_url('users/add'); ?>"><button style="float:right;" type="button" class="btn btn-sm btn-success waves-effect btn-label waves-light"><i class="bx bx-plus label-icon"></i> Add</button></a>
                        <?php } ?>
                        <br>
                        <h4 class="card-title mb-3">Employee Management</h4>
                        <table id="datatable" class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                <th scope="col">S.no</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>                                   
                                    <th scope="col">Role</th>      
                                    <th scope="col">Code</th>                             
                                    <th scope="col">DOB</th>                             
                                    <th scope="col">DOJ</th>                             
                                    <!-- <th scope="col">Status</th> -->
                                    <?php
                                        if ($this->auth_level >= 8 || $this->auth_level == 4) { 
                                            ?>
                                    <th scope="col">Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datatable as $key => $d) { ?>
                                    <tr>
                                    <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $d->first_name . " " .$d->last_name; ?></td>
                                        <td><?php echo $d->email; ?></td>
                                        <td><?php echo $d->mobile; ?></td>                                        
                                        <td><?php echo $d->role_name; ?></td>                                        
                                        <td><?php echo $d->user_code; ?></td>                                        
                                        <td><?php echo date('d-m-Y',strtotime($d->dob)); ?></td>                                        
                                        <td><?php echo date('d-m-Y',strtotime($d->doj)); ?></td>                                        
                                        <!-- <td>
                                            <?php 
                                            // if ($d->status == 1) {
                                            //     echo "Active";
                                            // } else {
                                            //     echo "InActive";
                                            // } ?>
                                            </td> -->
                                        <?php
                                        if ($this->auth_level >= 8 || $this->auth_level == 4) { 
                                            ?>
                                            <td>
                                                <?php if ($edit_option == 1) { ?>
                                                    <a href="<?php echo site_url('users/edit/' . $d->user_id); ?>"><button type="button" class="btn btn-sm btn-primary waves-effect btn-label waves-light"><i class="bx bx-pencil label-icon"></i> Edit</button></a>
                                                <?php } if ($this->auth_level >= 8 && $d->is_approve == 0) { ?>
                                                <button type="button" class="btn btn-sm btn-warning waves-effect btn-label waves-light" onclick="update_status(<?php echo $d->user_id; ?>);"><i class="bx bx-check label-icon"></i> Approve</button>
                                                <?php } if ($this->auth_level == 9) { ?>
                                                    <button type="button" class="btn btn-sm btn-danger waves-effect btn-label waves-light" id="sa-success" onclick="delete_item(<?php echo $d->user_id; ?>);"><i class="bx bx-trash label-icon"></i> Delete</button>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
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
                    url: "<?php echo base_url(); ?>users/delete/" + id + "/",
                    success: function(result) {
                        if (result) {
                            window.location('users');
                        }
                    }
                });

                if (isConfirmed.value) {
                    Swal.fire(
                        'Deleted!',
                        'users has been deleted.',
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
                    url: "<?php echo base_url(); ?>users/change_status/" + id + "/",
                    success: function(result) {
                        if (result) {
                            console.log(result);
                            Swal.fire(
                                        'Changed!',
                                        'users status has been changed successfully!',
                                        'success'
                                    );
                             window.location.reload();
                        }
                    }
                });

                // if (isConfirmed.value) {
                //     Swal.fire(
                //         'Changed!',
                //         'users status has been changed successfully!',
                //         'success'
                //     );
                //     window.location.reload();
                // }
            }
        });
    }
</script>