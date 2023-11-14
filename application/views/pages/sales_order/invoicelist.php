
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
                        <!-- <a href="<?php echo site_url('Product/add'); ?>"><button style="float:right;" type="button" class="btn btn-sm btn-success waves-effect btn-label waves-light"><i class="bx bx-plus label-icon"></i> Add</button></a> -->
                        <br>
                        <h4 class="card-title mb-3">Sales Invoice List</h4>
                        <table id="datatable" class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">S.no</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Total Qty</th>
                                    <th scope="col">Total Amount</th>
                                    <!-- <th scope="col">Action</th> -->
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($salesOrder as $key => $sales) { 
                                    if($sales->totalQuantity != $sales->receivedQuantity){
                                    ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $sales->company_name; ?></td>
                                        <td><?php echo $sales->totalQuantity; ?></td>                                        
                                        <td><?php echo $sales->grand_total; ?></td>
                                        
                                        <td>                                            
                                            <a target="_blank" href="<?php echo site_url('SalesOrder/itemsInvoice/'.$sales->sales_order_id); ?>" ><button  type="button"    class="btn btn-sm btn-primary waves-effect waves-light mt-1 "><i class="fa fa-print"></i></button></a>
                                        </td>
                                     
                                    </tr>



                                    <div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
​
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Sales Order Quantity</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
​
            <!-- Modal body -->
            <div class="modal-body">
                <form id="myForm" method="POST" action="<?php echo site_url('SalesOrder/getQuantity/'.$sales->id); ?>">
                    <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" min="1"  class="form-control" placeholder="Enter the Sales Order Quantity" id="qty" name="qty">
                    </div>
                    <div class="form-group mt-3">
                    <label for="credit_bill">Credit Bill</label>
                    <select class="form-control" name="credit_bill"  id="credit_bill" required>
                                            <option value="">--Credit Bill --</option>
                                            
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                    </select>                     
                    </div>
                    
                    <button type="submit" name='submit' id="submit" class="btn btn-primary mt-3">Submit</button>
                    <button type="button" class="btn btn-danger mt-3" data-dismiss="modal">Close</button>
                
                </form>
            </div>
​
            <!-- Modal footer -->
           
​
        </div>
    </div>
</div>


                                <?php    
                            }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



​
<!-- //new modal -->




<!-- Add Bootstrap CSS and JS -->
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

        var prefix = "<?php echo site_url('SalesOrder/getQuantity/'); ?>"; 
        var sufix = id;
        var newAction = prefix + sufix;
        // alert(newAction);
        form.setAttribute("action", newAction);
    //   var quantity = $("#qty").val();
    //    alert(quantity);
    
  });
    });

</script>