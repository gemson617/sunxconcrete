<style>

.badge{
        background-color: #cc0000;
        color:white;
        padding: 10px;
        font-size: 11px;
        border-radius: 5px;
    }
    .badge-waiting{
        background-color:#0acf97;
        color:white;
        padding: 10px;
        font-size: 11px;
        border-radius: 5px;
    }
</style>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
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
                <strong>Error!</strong> <?php echo $this->session->flashdata('alert_danger'); ?>
            </div>
        <?php
        }

        if ($this->session->flashdata('alert_warning')) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('alert_warning'); ?>
            </div>
        <?php
        }
        ?>
                    <div class="card-body">
                        <?php if ($add_option == 1) { ?>
                            <a href="<?php echo site_url('customer/add'); ?>"><button style="float:right;" type="button" class="btn btn-sm btn-success waves-effect btn-label waves-light"><i class="bx bx-plus label-icon"></i> Add</button></a>
                        <?php } ?>
                        <br>
                        <h4 class="card-title mb-3">Customer Management</h4>
                        <table id="datatable" class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>                                   
                                    <th scope="col">S.no</th>                                    
                                    <th scope="col">Name</th>
                                    <th scope="col">Business</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>                                         
                                    <th scope="col">GST No</th>                                   
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datatable as $key => $d) { ?>
                                    <tr>  
                                                            
                                        <td> <?php echo $key + 1; ?></td>  
                                        <td><?php echo $d->company_name; ?></td>                                       
                                        <td><?php echo $d->customer_business; ?></td>                                       
                                        <td><?php echo $d->cp_email; ?></td>
                                        <td><?php echo $d->cp_contact_no; ?></td>                                                                       
                                        <td><?php echo $d->customer_gst_no; ?></td>                                                                       
                                        <td><?php if ($d->customer_staus == "1") {
                                                echo "Active";
                                            } else {
                                                echo "InActive";
                                            } ?></td>
                                        <td>
                                            
                                                
                                                <a href="<?php echo site_url('customer/edit/' . $d->customer_id); ?>"><button type="button" class="btn btn-sm btn-primary waves-effect waves-light"><i class="bx bx-pencil"></i></button></a>
                                          
                                            <button type="button" class="btn btn-sm btn-warning waves-effect waves-light" onclick="update_status(<?php echo $d->customer_id; ?>);"><i class="bx bx-check"></i> </button>
                                           
                                                                                            
                                                <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" id="sa-success" onclick="delete_item(<?php echo $d->customer_id; ?>);"><i class="bx bx-trash"></i></button>
                                            
                                            <!-- <button type="button" class="btn btn-sm btn-success waves-effect btn-label waves-light" data-bs-toggle="modal" data-bs-target="#emailModal<?php echo $d->customer_id; ?>"><i class="bx bx-mail-send label-icon"></i> Mail</button> -->
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
                    url: "<?php echo base_url(); ?>customer/delete/" + id + "/",
                    success: function(result) {
                        if (result) {
                            window.location.reload('customer');
                        }
                    }
                });

                if (isConfirmed.value) {
                    Swal.fire(
                        'Deleted!',
                        'customer has been deleted.',
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
                    url: "<?php echo base_url(); ?>customer/change_status/" + id + "/",
                    success: function(result) {
                        if (result) {
                            console.log(result);
                            Swal.fire(
                                'Changed!',
                                'customer status has been changed successfully!',
                                'success'
                            );
                            window.location.reload();
                        }
                    }
                });

                // if (isConfirmed.value) {
                //     Swal.fire(
                //         'Changed!',
                //         'customer status has been changed successfully!',
                //         'success'
                //     );
                //      window.location.reload();
                // }
            }
        });
    }

    function edit_status(id) {
       
        Swal.fire({
            title: 'Are you sure?',
            text: "You can always change the status to active or in-active!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText:'Reject',
            confirmButtonText: 'Yes, Change it!'
        }).then(isConfirmed => {
            if (isConfirmed.value) {
                $.ajax({
                    url: "<?php echo base_url(); ?>customer/edit_status/" + id + "/",
                    success: function(result) {
                        if (result) {
                            console.log(result);
                            Swal.fire(
                                'Changed!',
                                'customer status has been changed successfully!',
                                'success'
                            );
                            window.location.reload();
                        }
                    }
                });

                // if (isConfirmed.value) {
                //     Swal.fire(
                //         'Changed!',
                //         'customer status has been changed successfully!',
                //         'success'
                //     );
                //      window.location.reload();
                // }
            }else{
                $.ajax({
                    url: "<?php echo base_url(); ?>customer/reject_status/" + id + "/",
                    success: function(result) {
                        if (result) {
                            console.log(result);
                            Swal.fire(
                                'Changed!',
                                'customer status has been Rejected successfully!',
                                'success'
                            );
                            window.location.reload();
                        }
                    }
                });
            }
            });
    }


    function show_reason(id) {
        $.ajax({
                   url: "<?php echo base_url(); ?>customer/edit_reason/" + id + "/",
                   success: function(result) {
                       if (result) {
                           console.log(result);
                           Swal.fire(
                               result,
                               'customer request for above changes!',
                               'success'
                           );
                          
                       }
                   }
               });

      
   }
</script>