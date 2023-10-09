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
                        <!-- <a href="<?php echo site_url('Quotation/add'); ?>"><button style="float:right;" type="button" class="btn btn-sm btn-success waves-effect btn-label waves-light"><i class="bx bx-plus label-icon"></i> Add</button></a> -->
                        <br>
                        <h4 class="card-title mb-3">Credit Note</h4>
                        <table id="datatable" class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr >
                                <th scope="col">S.no</th>
                                <th scope="col">Credit.No</th>
                                <th scope="col">PO Number</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Credit Percentage</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Credit Amount</th>
                                    <th scope="col">Invoice</th>
                                </tr>
                            </thead>
                         

                            <tbody style="text-align:center;">
                                <?php foreach ($credit_note as $key => $cn) { 
                                    $date = $cn->created;
                                    $dateObj = new DateTime($date);
                                    $date2 = $dateObj->format("d-m-y");
                                    // $date2 =  date_format($q->created,"d-m-y");
                                    // echo $date2;
?>
                                    
                                    <tr>
                                    <td><?php echo $key + 1; ?></td>  
                                        <td><?php echo $cn->credit_no; ?></td>  
                                        <td><?php echo $cn->po_number; ?></td>

                                        <td><?php echo $date2; ?></td>
                                        <td><?php echo $cn->cp_name; ?></td>
                                        <td><?php echo $cn->credit_percentage; ?></td>
                                        <td><?php echo $cn->grand_total; ?></td>
                                        <td><?php echo $cn->credit_amount; ?></td>
                                
                                        <td>
                                            <table>
                                                <tr>
                                                    <td><a href="<?php echo site_url('Quotation/creditInvoice/' . $cn->id); ?>"><button type="button" class="btn btn-sm btn-primary waves-effect waves-light"><i class="file-pdf"></i>PDF</button></a></td>
                                                    <!-- <td> <?php if ($q->qStatus != 3)
                                                            { ?>
                                                            <a href="<?php echo site_url('Quotation/edit/' . $q->id); ?>"><button type="button" class="btn btn-sm btn-info waves-effect waves-light"><i class="bx bx-pencil"></i></button></a>
                                                            <a href="#"><button type="button" class="btn btn-sm btn-danger waves-effect waves-light" onclick="delete_item(<?php echo $q->id; ?>);"><i class="bx bx-trash"></i></button></a>
                                                            <?php } ?>
                                                    </td> -->
                                                </tr>
                                            </table>
                                           
                                            
                                            <!-- <button type="button" class="btn btn-sm btn-warning waves-effect waves-light" onclick="update_status(<?php echo $d->product_id; ?>);"><i class="bx bx-check"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" id="sa-success" onclick="delete_item(<?php echo $d->product_id; ?>);"><i class="bx bx-trash"></i></button> -->

                                        </td>
                                    </tr>


                                    <div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
​
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Convert To Sale Order</h4>
                <button type="button" class="close btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
​
            <!-- Modal body -->
            <div class="modal-body">
                <form id="myForm" method="POST" action="<?php echo site_url('Quotation/Accept/'.$q->id); ?>">
                    <div class="form-group">
                        <label for="qty">PO Number</label>
                        <input type="text" class="form-control" min="1"  placeholder="Enter the PO Number" id="poNumber" name="poNumber">
                    </div>
                    <div class="form-group mt-3">
                    <label for="credit_bill">Credit Note</label>
                    <select class="form-control" name="creditNote"  id="creditNote" required>
                                            <option value="">--Credit Note --</option>
                                            
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                    </select>                     
                    </div>
                    
                    <button type="submit" name='submit' id="submit" class="btn btn-primary mt-3">Accept</button>
                    <button type="button" class="btn btn-danger mt-3" data-dismiss="modal">Cancel</button>
                
                </form>
            </div>
​
            <!-- Modal footer -->
           
​
        </div>
    </div>
</div>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">


$(document).ready(function () {
  
  $(".delete-category").click(function () {
      var id = $(this).data('id');
      var qty = $(this).val();
      var valid = parseFloat(qty);

      $("#qty").attr("max", valid);
      var form = document.getElementById("myForm");

      var prefix = "<?php echo site_url('Quotation/accept/'); ?>"; 
      var sufix = id;
      var newAction = prefix + sufix;
      // alert(newAction);
      form.setAttribute("action", newAction);
  //   var quantity = $("#qty").val();
  //    alert(quantity);
  
});
  });



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