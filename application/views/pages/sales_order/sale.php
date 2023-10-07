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
                    <h4 class="mb-sm-0 font-size-18">Sale</h4>
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

                        <form action="<?php echo site_url('SalesOrder/getQuantity/'.$id); ?>" id="ynamic-form" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>

<div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                            <div class="row col-md-12">
                                <div class="col-md-4">                                 
                                    <div class="">
                                        <label for="plant_id">Plant Name</label>
                                        <select class="form-control" name="plant_id"  id="plant_id" required>
                                                <option value="">--Select Plant --</option>   
                                                <?php foreach ($plant as $key => $plant) { ?>                                              
                                                <option value="<?=$plant->pm_id?>"><?= $plant->plant_master_name ?></option>
                                                <?php }  ?>
                                        </select>                                          
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Plant Name is Required.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">                                 
                                    <div class="">
                                        <label for="plant_id">Truck Number</label>
                                        <input type="text" name="truck_no" value="" class="form-control" id="truck_no" placeholder="Truck Number" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Truck Number is Required.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">                                 
                                    <div class="">
                                        <label for="plant_id">Diver Name</label>
                                        <input type="text" name="driver_name" value="" class="form-control" id="driver_name" placeholder="Diver Name" required>                                        
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Diver Name is Required.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-4">                                 
                                    <div class="">
                                        <label for="plant_id">DC No</label>
                                        <input type="text" name="dc_no" value="" class="form-control" id="dc_no" placeholder="DC Number" required>                                        
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        DC Number is Required.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-4">                                 
                                    <div class="">
                                        <label for="plant_id">Batch No</label>
                                        <input type="text" name="batch_no" value="" class="form-control" id="batch_no" placeholder="Batch Number" required>                                        
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Batch Number is Required.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-4">                                 
                                    <div class="">
                                        <label for="plant_id">DC Date</label>
                                        <input type="date" name="dc_date" value="" class="form-control" id="dc_date" placeholder="dc_date" required>                                        
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        DC Date is Required.
                                        </div>
                                    </div>
                                </div>

                               
<!-- 
                                <div class="col-md-6">                                 
                                 <div class="">
                                     <label for="validationCustom01" class="form-label">Credit Bill</label>
   <select class="form-control" name="credit_bill"  id="credit_bill" required>
                                            <option value="">--Credit Bill --</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                    </select>                                      <div class="valid-feedback">
                                         Looks good!
                                     </div>
                                     <div class="invalid-feedback">
                                     Ship to party is Required.
                                     </div>
                                 </div>
                             </div> -->
                            </div>
                        </div>
                </div>
            </div>
</div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="max rtl-bc" >
                            <div id="addProduct" class="">
                            <div class="row field0">
<?php foreach($products as $key => $pro){
    if($pro->available_qty != 0) {?>
                                <div class="col-md-2 count1">
                                    <div class="mb-2">
                                        <label for="validationCustom01" class="form-label">Product</label>
                                        <input type="hidden" name="subId[]" id="subid" value="<?= $pro->subId ?>">
                                        <select disabled class="form-control" name="product1[]"  id="product1<?= $key ?>" >
                                            
                                            <?php foreach($products as $product) {?>
                                            <option value="<?php echo $product->product_id; ?>" <?= ($pro->product_id == $product->product_id) ? 'selected' : '' ?>><?php echo $product->product_name; ?>
                                            <?php }?>
                                        </select>   
                                        <input type="hidden" id="product<?= $key ?>" name="product[]" value="<?= $pro->product_id?>">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Product Name Required.
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="po_number" id="po_number" value="<?= $pro->po_number ?>">

                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">HSN</label>
                                        <input type="text" name="hsn[]" value="<?= $pro->hsn_code ?>" class="form-control" id="hsn<?= $key ?>" placeholder=" HSN Code" readonly required>
                                        <input type="text" name="hsn_id[]" value="<?= $pro->hsn_name ?>" hidden class="form-control" id="hsn_id<?= $key ?>" placeholder=" HSN Code"  required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        HSN Code Required.
                                        </div>
                                    </div>
                                </div>                                
                                <div class="col-md-2" style="width: 12%;">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">UOM</label>
                                        <input type="text" name="uom[]" value="<?= $pro->uom_id ?>" readonly class="form-control" id="uom<?= $key ?>" placeholder="UOM" value="" required>
                                        <input type="text" name="uom_id[]" value="<?= $pro->uom ?>" hidden class="form-control" id="uom_id<?= $key ?>" placeholder=" UOM" value="" required>
                                             <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        UOM Required.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2" style="width: 12%;"> 
                                    <div class="mb-3">
                                        <label for="" class="form-label">Qty</label>
                                        <input type="number" min="1"   max="<?= $pro->available_qty ?>" oninput="get_amount(this.value, <?= $key ?>)" name="qty[]" class="form-control" id="qty<?= $key?>" placeholder="Qty <?= $pro->available_qty ?>" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Qty is Maximum <?= $pro->available_qty ?> or Null.
                                        </div>
                                    </div>
                                </div>   

                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Price</label>
                                        <input type="text" name="price[]" value=" <?= $pro->price ?>" readonly class="form-control price"  id="price<?= $key ?>"  placeholder=" Price"  required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        price Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Amount</label>
                                        <input type="text" name="amount[]" value=" " class="form-control amount" readonly  id="amount<?= $key ?>" placeholder="Amount"  required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        price Required.
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            } ?>
                                <!-- <div class="col-md-1 mt-3" id="adremovebuttons"><br>
                                    <button type="button" id="button1" class="add-field btn btn-success btn-circle"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>                                                                
                                </div> -->
                            </div>
                            </div>
                        </div>



                        <!-- <div class="row row_spc">
                            <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">  Taxable Value of Supply of Goods :  </div>
                                <div class="col-md-3"  >
                                    <input type="text" readonly class="form-control sub_total mb-2" id="sub_total" name="sub_total">
                                </div>
                        </div>
                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;"> CGST 9%:   </div>
                                <div class="col-md-3">
                                    <input type="text" readonly class="form-control mb-2" id="cgst" name="cgst">
                                </div>
                        </div>
                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">SGST 9%:   </div>
                            <div class="col-md-3">
                                <input type="text" readonly class="form-control mb-2" id="sgst" name="sgst">
                            </div>
                        </div>

                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">IGST 18%:   </div>
                            <div class="col-md-3">
                                <input type="text" readonly class="form-control mb-2" id="igst" name="igst">
                            </div>
                        </div>
                        
                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;"> TAX TOTAL:  </div>
                            <div class="col-md-3"> 
                                <input type="text" readonly class="form-control mb-2" id="total_tax" name="total_tax">
                            </div>
                        </div>
                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">ROUND OFF :  </div>
                            <div class="col-md-3"> 
                                <input type="text" readonly class="form-control mb-2" id="round_off" name="round_off">
                            </div>
                        </div> -->
                        <!-- <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;"> TOTAL Invoice Value :   </div>
                                <div class="col-md-3">
                                    <input type="text" readonly class="form-control mb-2" id="g_total" name="g_total">
                                </div>
                        </div> -->
                            <div>
                                <button class="btn btn-primary" type="submit" value="submit" name="submit">Submit</button>
                                <a href="#"><button onclick="window.location.reload()" class="btn btn-warning" type="button">Cancel</button></a>
                            </div>
                        </div>                            
                        </form>                    
                <!-- end card -->
            </div> 
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    function get_product(product_id,no) {
        $.ajax({
            url: "<?php echo site_url() ?>SalesOrder/get_product",
            method: "POST",
            type: "ajax",
            data: {
                product_id: product_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                // alert(data.uom);
                console.log(data);    
                $('#hsn'+no).val(data.hsn_name);
                $('#uom'+no).val(data.uom);
                $('#hsn_id'+no).val(data.hsn_id);
                $('#uom_id'+no).val(data.uom_id);
                $('#price'+no).val(data.product_rate);
            },
            error: function(error) {
                console.log(error);
            }
        });     
           
    }


        $(document).ready(function () {                       
            // Add more fields
            $('.max').each(function() {                
                var $wrapper = $('#addProduct', this);
                $(".add-field", $(this)).click(function(e, no) {  
                    var no = $('.count1').length;
                    var row = $(
                        '<div class="row field'+no+'"> <div class="col-md-2 count1"> <div class="mb-2"> <label for="validationCustom01" class="form-label">Product</label> <select class="form-control selectDrop" name="product[]" onchange="get_product(this.value, '+no+')" id="product'+no+'" required> <option value="">--Select --</option> <option value="">--Select --</option> <?php foreach($products as $product) {?> <option value="<?php echo $product->product_id; ?>"><?php echo $product->product_name; ?> <?php }?> </select> <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Product Name Required. </div> </div> </div> <div class="col-md-2"> <div class="mb-3"> <label for="validationCustom01" class="form-label">HSN</label> <input type="text" name="hsn[]" class="form-control" id="hsn'+no+'" placeholder=" HSN Code" readonly required> <input type="text" name="hsn_id[]" hidden class="form-control" id="hsn_id'+no+'" placeholder=" HSN Code"  required> <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> HSN Code Required. </div> </div> </div> <div class="col-md-2" style="width: 12%;"> <div class="mb-3"> <label for="validationCustom01" class="form-label">UOM</label> <input type="text" name="uom[]" readonly class="form-control" id="uom'+no+'" placeholder="UOM" value="" required> <input type="text" name="uom_id[]" hidden class="form-control" id="uom_id'+no+'" placeholder=" UOM" value="" required> <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> UOM Required. </div> </div> </div> <div class="col-md-2" style="width: 12%;"> <div class="mb-3"> <label for="validationCustom01" class="form-label">Qty</label> <input type="number" step="0.01" name="qty[]" class="form-control qty" oninput="get_qty(this.value, '+no+')" id="qty'+no+'" placeholder=" Qty"  required> <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> price Required. </div> </div> </div> <div class="col-md-2"> <div class="mb-3"> <label for="validationCustom01" class="form-label">Price</label> <input type="text" name="price[]" class="form-control price"  id="price'+no+'" placeholder=" Price"  required> <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> price Required. </div> </div> </div> <div class="col-md-2"> <div class="mb-3"> <label for="validationCustom01" class="form-label">Amount</label> <input type="text" name="amount[]" class="form-control amount" readonly onchange="get_amount(this.value, '+no+')" id="amount'+no+'" placeholder="Amount"  required> <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> price Required. </div> </div> </div> ' +
                        '<div class="col-md-1" style="width:4.333333%"><i class="fa fa-trash mt-5" onclick="removediv('+no+')" id="remove'+no+'" style="font-size:22px;color:red"></i></div></div>');
                    row.appendTo($wrapper);   
                    $('.selectDrop').select2();
                });
            });
        });
        // Remove fields
        function removediv(no){
            $('.field'+no).remove();
            calculateAmount();
        }

 

    function old_calculateAmount() {
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

    function calculateAmount() {
        var sub_total = 0;
                $(".amount").each(function(j, ob) {
                    sub_total += parseFloat(ob.value);
                });
    // var qtyValue = parseFloat($('#qty').val()) || 0;
    // var priceValue = parseFloat($('#price').val()) || 0;
    // var amountValue = qtyValue * priceValue;
    // $('#amount').val(amountValue.toFixed(2));
    $('#sub_total').val(sub_total.toFixed(2));

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
    function get_qty(value, no){
        
        var qtyValue = parseFloat($('#qty'+no).val()) || 0;
    var priceValue = parseFloat($('#price'+no).val()) || 0;
    var amountValue = qtyValue * priceValue;
    
    $('#amount'+no).val(amountValue.toFixed(2));
        calculateAmount();
    }

    function get_amount(value, no){
        
    var qtyValue = parseFloat($('#qty'+no).val()) || 0;
    var priceValue = parseFloat($('#price'+no).val()) || 0;
   
    var amountValue = qtyValue * priceValue;
    $('#amount'+no).val(amountValue.toFixed(2));
        calculateAmount();
    }
    // Initially calculate and display the amount
    
    </script>
    