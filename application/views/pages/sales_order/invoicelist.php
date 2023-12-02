
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
            .sub-rows {
            display: none;
            background: burlywood;
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
                        <!-- <a href="<?php echo site_url('SalesOrder/add'); ?>"><button style="float:right;" type="button" class="btn btn-sm btn-success waves-effect btn-label waves-light"><i class="bx bx-plus label-icon"></i> Add</button></a> -->
                        <br>                        
                        <h4 class="card-title mb-3">INVOICE</h4>
                        <table id="deliveryChallanDatatable" class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">S.no</th>
                                    <th scope="col">Sale.No</th>

                                    <th scope="col">Date</th>
                                    <!-- <th scope="col">PO.No</th> -->
                                    <!-- <th scope="col">Product</th> -->
                                    <th scope="col">Customer</th>
                                    <!-- <th scope="col">HSN </th> -->
                                    <th scope="col"> Qty</th>
                                    <th scope="col">Available Qty</th>
                                    <!-- <th scope="col">Invoiced Qty</th> -->
                                    <!-- <th scope="col"> Invoiced Amt</th> -->

                                    <th scope="col">Total Amt</th>
                                    <th scope="col">Invoice</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($sale as $key => $sales) { 
                                    $date =  $sales->created_on;
                                    $timestamp = strtotime($date);
                                    $formattedDate = date("d-m-Y", $timestamp);                                  
                                    // $date = date($date, 'd-m-y');  ?>
                                    <tr>
                                        <td>
                                            <?php  if (isset($sales->transaction_id) && is_array($sales->transaction_id) && !empty($sales->transaction_id)) { ?>
                                               
                                            <?php }?>
                                            <i class="bx bx-plus label-icon btn" onclick="showSubRows('sub-rows-<?php echo $key; ?>')"></i><?php echo $key + 1; ?>
                                        </td>
                                        <td><?php echo $sales->sale_no; ?></td>
                                        <td><?php echo $formattedDate; ?></td>                                        
                                        <td><?php echo $sales->company_name; ?></td>
                                        <td><?php echo $sales->totalQuantity; ?></td>
                                        <td><?php echo $sales->availableQuantity; ?></td>
                                        <!-- <td><?php echo ($sales->receivedQuantity != null) ? $sales->receivedQuantity : "0.00"; ?></td> -->
                                        <!-- <td><?php echo number_format($sales->received_amount,2); ?></td> -->

                                        <td><?php echo number_format($sales->grand_total,2); ?></td>
                    
                                        <td>
                                        <a target="_blank" href="<?php echo site_url('SalesOrder/itemsInvoice/'.$sales->id); ?>" ><button  type="button" class="btn btn-sm btn-primary waves-effect waves-light mt-1 "><i class="fa fa-print"></i></button></a>
                                        </td> 

                                        <td>
                                            -                                     
                                        </td>                                     
                                    </tr>
                                    <!-- Sub Rows -->

                                    <?php                                    
                                            $co = 0;
                                                if (isset($sales->transaction_id) && is_array($sales->transaction_id)) {
                                                foreach ($sales->saleOrderItems as $subRow => $saleOrderItems) {
                                                    $co ++;
                                    ?>

                                    <tr class="sub-rows sub-rows-<?php echo $key; ?>">
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $saleOrderItems->dc_no; ?></td>
                                        <td><?php echo $saleOrderItems->dc_date; ?></td>
                                      
                                        <td><?php echo $sales->company_name; ?></td>
                                        <td><?php echo $saleOrderItems->totalInvoiceQuantity; ?></td>                                       
                                        <td><?php echo '-'; ?></td>
                                        <td> <?php echo $saleOrderItems->tottalInvoiceAmt; ?> </td>
                                       
                                        <td>
                                            <a title="Delivery Challan" target="_blank" href="<?php echo site_url('SalesOrder/deliveryChallan/' . $saleOrderItems->transaction_id); ?>" type="button" class="btn btn-sm mt-1 btn-info waves-effect waves-light float-right delete-category"   value="<?= $sales->available_quantity ?>" data-id="<?= $sales->id ?>" data-target="#myModal"> <i class="fa fa-print"></i>  </a>
                                        </td>
                                        <td> <a title="Add Credit Note" href="#" data-target="#myModal" onclick="openModel('<?= $saleOrderItems->transaction_id?>', '<?=  $saleOrderItems->tottalInvoiceAmt  ?>', '<?= $sales->sold_to_party?>','<?= $sales->ship_to_party?>',)" type="button" class="btn btn-sm mt-1 btn-dark waves-effect waves-light float-right delete-category"   value="<?= $sales->available_quantity ?>" data-id="<?= $sales->id ?>" > <i class="bx bx-transfer"></i>  </a></td>
                                    </tr>


                                                
                                            <?php   if ($co % 2 === 0) {
                                                    echo '<br>';
                                                }   }}    ?>    
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">​
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Credit Note (%)</h4>
                            <button type="button" class="close btn btn-danger" onclick="closeModel()" data-dismiss="modal">&times;</button>
                        </div>​
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form id="myForm" method="POST" action="<?php echo site_url('DcController/creditNote/'); ?>">
                                <div class="row">
                                    <input type="hidden" name="tottalamount" id="tottalamount" value="<?php echo $saleOrderItems->tottalInvoiceAmt; ?> ">
                                    <input type="hidden" name="transactionid" id="transactionid" value="<?php echo $saleOrderItems->transaction_id; ?> ">
                                    <input type="hidden" name="sold_party" id="sold_party" value="<?php echo $sales->sold_to_party; ?> ">
                                    <input type="hidden" name="ship_party" id="ship_party" value="<?php echo $sales->ship_to_party; ?> ">
                            <div class="form-group col-md-12">
                                    <label for="qty">Credit Note (%)</label>
                                    <input type="number" class="form-control" min="1"  placeholder="Enter the Credit Note %" id="creditNote" name="creditNote">
                                </div>
                                </div>                    
                                <button type="submit" name='submit' id="submit" class="btn btn-primary mt-3">Accept</button>
                                <button type="button" class="btn btn-danger mt-3" onclick="closeModel()" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>​
                        <!-- Modal footer -->
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
        function openModel(transactionId, totalInvoiceAmt, soldParty, ShipParty){           
            $('#transactionid').val(transactionId);
            $('#tottalamount').val(totalInvoiceAmt);
            $('#sold_party').val(soldParty);
            $('#ship_party').val(ShipParty);
           
            $('#myModal').modal('show');            
        }
        function closeModel(){
            $('#myModal').modal('hide');
        }
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
                        url: "<?php echo base_url(); ?>SalesOrder/delete/" + id + "/",
                        success: function(result) {
                            if (result) {
                                window.location.reload('SalesOrder/view');
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

        function showSubRows(className) {
        $('.sub-rows.' + className).toggle();
    }

    $(document).ready(function () {
        $('#deliveryChallanDatatable').DataTable();

    });

</script>