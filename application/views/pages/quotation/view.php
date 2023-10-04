<style>
    .badge {
  font-family: "Rubik", sans-serif;
  box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.06), 0 1px 0 0 rgba(0, 0, 0, 0.02);
  padding: .35em .5em;
  font-weight: 500;
}
        .badge-success {
                             background-color: #0ACF97;
                        }
        /* .badge-not {
                                background-color: #9B2B2B;
                        } */
        .approved-btn {
            background-color: #DB9323;
            border-color: #DB9323;
        }
        .new {
                    background-color: #CC0000;
            }
        .processing {
                background-color: #9B2B2B;
        }
        .completed {
                    background-color: #006633;
            }
            .approved {
                    background-color: #0ACF97;
            }
            .update {
                    background-color: #004080;
            }
    </style>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
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
                        <a href="<?php echo site_url('Product/add'); ?>"><button style="float:right;" type="button" class="btn btn-sm btn-success waves-effect btn-label waves-light"><i class="bx bx-plus label-icon"></i> Add</button></a>
                        <br>
                        <h4 class="card-title mb-3">Product</h4>
                        <table id="datatable" class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">S.no</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">HSN code</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">UOM</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($quotations as $key => $q) { ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $q->product_name; ?></td>
                                        <td><?php echo $q->hsn_name; ?></td>
                                        <td><?php echo $q->quantity; ?></td>
                                        <td><?php echo $q->uom; ?></td>
                                        <td><?php echo $q->grand_total; ?></td>
                                        <!-- <td><a href="#" class="badge badge-<?= ($q->qStatus == 1) ? 'secondary':'success' ?>"><?= ($q->qStatus == 0) ? 'Not-Accepted':'Accepted' ?></a>
                                </td> -->
                                <td>
                                        <?php if ($q->qStatus == 1)
                                            {?>
                                                <a  href="<?php echo site_url('Quotation/accept/' . $q->id); ?>"><button type="button" style="width: 75%;" class=" btn-sm btn-info">Accept</button></a>
                                        <?php } else if ($q->qStatus == 2){?>
                                                <a href="#"><button type="button" style="width: 75%;" class=" btn-sm btn-danger">Rejected</button></a>
                                        <?php  }  else if ($q->qStatus == 3){?>
                                                <a href="#"><button type="button" style="width: 75%;" class=" btn-sm btn-success">Accepted</button></a>
                                        <?php }  ?>
                                            
                                </td>
                                        
                                        <td>
                                            <a href="<?php echo site_url('Quotation/quotationInvoice/' . $q->id); ?>"><button type="button" class="btn btn-sm btn-primary waves-effect waves-light"><i class="file-pdf"></i>PDF</button></a>
                                            <a href="<?php echo site_url('Quotation/edit/' . $q->id); ?>"><button type="button" class="btn btn-sm btn-info waves-effect waves-light"><i class="bx bx-pencil"></i></button></a>
                                        <a href="#"><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delete_item(<?php echo $q->id; ?>);"><i class="bx bx-trash"></i></button></a>
                                            <!-- <button type="button" class="btn btn-sm btn-warning waves-effect waves-light" onclick="update_status(<?php echo $d->product_id; ?>);"><i class="bx bx-check"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" id="sa-success" onclick="delete_item(<?php echo $d->product_id; ?>);"><i class="bx bx-trash"></i></button> -->

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
                    url: "<?php echo base_url(); ?>Quotation/delete/" + id + "/",
                    success: function(result) {
                        if (result) {
                            window.location.reload('Quotation/view');
                        }
                    }
                });

                if (isConfirmed.value) {
                    Swal.fire(
                        'Deleted!',
                        'Quotation has been deleted.',
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
                    url: "<?php echo base_url(); ?>Product/change_status/" + id + "/",
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
                        'HSN Code status has been changed successfully!',
                        'success'
                    );
                    window.location.reload();
                }
            }
        });
    }
</script>