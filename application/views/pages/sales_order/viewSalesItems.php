
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
    <div class="row">
                    <div class="col-lg-10"> </div>
                    <div class="col-lg-2">
               <!-- <a href="<?php echo site_url('SalesOrder/view/' . $sales->id); ?>" ><button  type="button"    class="btn btn-success waves-effect waves-light mt-1 mb-3">Back</button></a> -->
                   
                </div>
            </div>


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
                        <!-- <a href="<?php echo site_url('SalesOrder/itemsInvoice/'.$id); ?>"><button style="float:right;" type="button" class="btn btn-sm btn-success waves-effect btn-label waves-light">Convert To Invoice</button></a> -->
                        <br>
                        <?php foreach ($salesOrder as $key => $sales) { 
                         $po_number =   $sales->po_number;
                        //  echo $po_number;
                         } ?>
                        <div class="row">
                            <div class="col-md-6"><h4 class="card-title mb-3">Sales List</h4></div>
                            <!-- <div class="col-md-6" style="text-align: right;"><h6>PO.Number : <?= $po_number ?></h6></div> -->
                        </div>
                        
                        <table id="datatable" class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">S.no</th>
                                    <th scope="col">Sale Date</th>
                                    <th scope="col">Customer</th>
                                    <!-- <th scope="col">Total Quantity</th>
                                    <th scope="col">Quantity Before Sales</th> -->
                                    <th scope="col">Invoiced Quantity</th>
                                   
                                    <!-- <th scope="col">Remaining Quantity</th> -->
                                    <th scope="col">Invoiced Amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($salesOrder as $key => $sales) {
                                          $date = $sales->created_date;
                                          $dateObj = new DateTime($date);
                                          $date2 = $dateObj->format("y-m-d");
                                            ?>
                                    <tr>
                                        
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $date2; ?></td>
                                        <td><?php echo $sales->company_name; ?></td>
                                        <!-- <td><?php echo $sales->totalQuantity; ?></td>
                                        <td><?php echo $sales->receivedQuantity + $sales->availableQuantity; ?></td> -->
                                        <td><?php echo $sales->receivedQty; ?></td>
                                        <!-- <td><?php echo $sales->availableQuantity; ?></td> -->
                                        <td>₹ <?php echo number_format($sales->totalAmount,2); ?></td>
                                        <td>                                            
                                            <!-- <a href="#" class="delete-category"><button  type="button" data-id="<?= $sales->id ?>" data-target-modal="#exampleModal<?= $sales->id ?>" id="show-modal-btn" class="btn btn-sm btn-primary delete-category waves-effect waves-light ">Accept</button></a> -->
                                            <!-- <a href="<?php echo site_url('SalesOrder/invoice/' . $sales->id); ?>" ><button  type="button"    class="btn btn-sm btn-success waves-effect waves-light mt-1 ">Convert to Invoice</button></a> -->
                                           
                                            <a href="<?php echo site_url('SalesOrder/deliveryChallan/' . $sales->transaction_id); ?>" ><button  type="button"class="btn btn-sm btn-success waves-effect waves-light mt-1 ">Invoice CUM DC</button></a>
                                      
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



​
<!-- //new modal -->




<!-- Add Bootstrap CSS and JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">



    $(document).ready(function () {
    // Attach a click event handler to your button

    // $("#show-modal-btn").click(function () {
     
    //     form.setAttribute("action", newAction);

        // var targetModal = $(this).data("target-modal");
        // alert(targetModal);
      // Show the modal by selecting it by its ID
    //   $(targetModal).modal("show");


    // });

    $(".delete-category").click(function () {
        var id = $(this).data('id');
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