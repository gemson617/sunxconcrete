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
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Add Quotation</h4>
                    <div class="page-title-right">
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
                        <form action="<?php echo site_url('Quotation/add'); ?>" id="ynamic-form" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                 
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Sold to party</label>
                                        <select class="form-control" name="sold_to" id="sold_to" required>
                                            <option value="">--Select Customer --</option>
                                            <?php foreach($customers as $customer)
                                         {?>
                                         <option value="<?php echo $customer->customer_id; ?>"><?php echo $customer->company_name; ?>
                                         <?php }?>
                                        </select>                                          
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Sold to party is Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                 
                                 <div class="mb-3">
                                     <label for="validationCustom01" class="form-label">Ship to party</label>
                                     <select class="form-control" name="ship_to" id="sold_to" required>
                                         <option value="">--Select Customer --</option>
                                         <?php foreach($customers as $customer)
                                         {?>
                                         <option value="<?php echo $customer->customer_id; ?>"><?php echo $customer->company_name; ?>
                                         <?php }?>
                                     </select>                                         
                                      <div class="valid-feedback">
                                         Looks good!
                                     </div>
                                     <div class="invalid-feedback">
                                     Ship to party is Required.
                                     </div>
                                 </div>
                             </div>
                            </div>
                        </div>
                </div>
            </div>
</div>

<div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                 
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Tax payable on reverse charge</label>
                                        <select class="form-control" name="tax_payable" id="tax_payable" required>
                                            <option value="">--Select Yes or No--</option>
                                            
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                           
                                        </select>                                          <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Tax payable on reverse charge is Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                 
                                 <div class="mb-3">
                                     <label for="validationCustom01" class="form-label">Place of supply</label>
                                     <input type="text" name="place_of_supply" class="form-control"  id="place_of_supply" placeholder="Enter the place of supply"  required>
                                    <div class="valid-feedback">
                                         Looks good!
                                     </div>
                                     <div class="invalid-feedback">
                                     Place of supply Required.
                                     </div>
                                 </div>
                             </div>
                                <div class="col-md-4">
                                 
                                 <!-- <div class="mb-3">
                                     <label for="validationCustom01" class="form-label">PO Number</label>
                                     <input type="text" name="po_no" class="form-control"  id="po_no" placeholder="Enter the PO Number"  required>
                                    <div class="valid-feedback">
                                         Looks good!
                                     </div>
                                     <div class="invalid-feedback">
                                     Place of supply Required.
                                     </div>
                                 </div> -->
                             </div>
                            </div>
                        </div>
                </div>
            </div>
</div>


        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                 
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Product</label>
                                        <select class="form-control" name="product" onchange="get_product(this.value)" id="product" required>
                                            <option value="">--Select Product --</option>
                                            <?php foreach($products as $product)
                                            {?>
                                            <option value="<?php echo $product->product_id; ?>"><?php echo $product->product_name; ?>
                                            <?php }?>
                                        </select>                                          <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Product Name Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">HSN Code</label>
                                        <input type="text" name="hsn" class="form-control" id="hsn" placeholder="Enter Hsn Code" readonly required>
                                        <input type="text" name="hsn_id" hidden class="form-control" id="hsn_id" placeholder="Enter Hsn Code"  required>
                                <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        HSN Code Required.
                                        </div>
                                    </div>
                                </div>                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">UOM</label>
                                        <input type="text" name="uom" readonly class="form-control" id="uom" placeholder="Enter UOM" value="" required>
                                        <input type="text" name="uom_id" hidden class="form-control" id="uom_id" placeholder="Enter UOM" value="" required>
                                             <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        UOM Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Quantity</label>
                                        <input type="number" step="0.01" name="qty" class="form-control qty"  id="qty" placeholder="Enter Quantity"  required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        price Required.
                                        </div>
                                    </div>
                                </div>                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Price</label>
                                        <input type="text" name="price" class="form-control price" readonly id="price" placeholder="Enter Price"  required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        price Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Amount</label>
                                        <input type="text" name="amount" class="form-control amount" readonly id="amount" placeholder="Enter the amount"  required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        price Required.
                                        </div>
                                    </div>
                                </div>



                                <div class="row row_spc">
                            <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;"> SUB TOTAL :  </div>
                                <div class="col-md-3"  >
                                    <input type="text" readonly class="form-control sub_total mb-2" id="sub_total" name="sub_total">
                                </div>
                        </div>
                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;"> CGST :   </div>
                                <div class="col-md-3">
                                    <input type="text" readonly class="form-control mb-2" id="cgst" name="cgst">
                                </div>
                        </div>
                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">SGST :   </div>
                            <div class="col-md-3">
                                <input type="text" readonly class="form-control mb-2" id="sgst" name="sgst">
                            </div>
                        </div>
                        
                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">TOTAL TAX :  </div>
                            <div class="col-md-3"> 
                                <input type="text" readonly class="form-control mb-2" id="total_tax" name="total_tax">
                            </div>
                        </div>
                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">ROUND OFF :  </div>
                            <div class="col-md-3"> 
                                <input type="text" readonly class="form-control mb-2" id="round_off" name="round_off">
                            </div>
                        </div>
                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">GRAND TOTAL :   </div>
                                <div class="col-md-3">
                                    <input type="text" readonly class="form-control mb-2" id="g_total" name="g_total">
                                </div>
                        </div>



                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit" value="submit" name="submit">Submit</button>
                                <a href="#"><button onclick="window.location.reload()" class="btn btn-warning" type="button">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

function get_product(product_id) {
        $.ajax({
            url: "<?php echo site_url() ?>Quotation/get_product",
            method: "POST",
            type: "ajax",
            data: {
                product_id: product_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                // alert(data.uom);
                console.log(data);    
                $('#hsn').val(data.hsn_name);
                $('#uom').val(data.uom);
                $('#hsn_id').val(data.hsn_id);
                $('#uom_id').val(data.uom_id);
                $('#price').val(data.product_rate);

            },
            error: function(error) {
                console.log(error);
            }
        });
        
    }

 

    function calculateAmount() {
    var qtyValue = parseFloat($('#qty').val()) || 0;
    var priceValue = parseFloat($('#price').val()) || 0;
    var amountValue = qtyValue * priceValue;
    $('#amount').val(amountValue.toFixed(2));
    $('#sub_total').val(amountValue.toFixed(2));

    // document.getElementById('sub_total').value = totalSubtotal.toFixed(2);
        var subTotal = Number(document.getElementById('sub_total').value);
        cgst = subTotal * 9 / 100;
        sgst = subTotal * 9 / 100;
        $('#cgst').val(cgst.toFixed(2));
        $('#sgst').val(sgst.toFixed(2));

    //     document.getElementById('cgst').value = cgst;
    //     document.getElementById('sgst').value = sgst;
        var gst = cgst + sgst;

        grandTotal = subTotal + gst;
        $('#total_tax').val(gst.toFixed(2));

        var roundedNumber = Math.round(grandTotal);
        var roundOff = grandTotal - roundedNumber;
       
        $('#g_total').val(roundedNumber.toFixed(2));
        $('#round_off').val(roundOff.toFixed(2));

    }

    // Add event listeners to 'qty' and 'price' fields
    $('#qty').on('input', calculateAmount);



    // Initially calculate and display the amount
    calculateAmount();


 
    </script>