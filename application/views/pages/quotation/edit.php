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
            <div class="col-6">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Quotation</h4>                    
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <div class="page-title-box d-flex ">
                    <div class="page-title-right ml-auto">  
                        <a href="<?php echo site_url('Quotation/view'); ?>">
                        <button class="btn btn-secondary">Back</button>
                        </a>
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

<form action="<?php echo site_url('Quotation/edit/'.$quotation['id']); ?>" id="dynamic-form" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>

<div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">                                 
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Quotation number</label>
                                        <input type="text" readonly class="form-control" required name="qno" id="qno" value="<?= $quotation['quotation_no'] ?>" >                                        
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Quotation No is Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">                                 
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Sold to party</label>
                                        <select class="form-control" name="sold_to" id="sold_to" >
                                            <option value="">--Select Customer --</option>
                                            <?php foreach($customers as $customer) {?>
                                         <option value="<?php echo $customer->customer_id; ?>" data-info="<?= $customer->customer_state ?>" <?= ($quotation['sold_to_party'] == $customer->customer_id) ? 'selected' : '' ?>><?php echo $customer->company_name; ?>
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
                                <div class="col-md-3">                                 
                                 <div class="mb-3">
                                     <label for="validationCustom01" class="form-label">Ship to party</label>
                                     <select class="form-control" name="ship_to" id="sold_to" required>
                                         <option value="">--Select Customer --</option>
                                         <?php foreach($customers as $customer) {?>
                                         <option value="<?php echo $customer->customer_id; ?>" <?= ($quotation['ship_to_party'] == $customer->customer_id) ? 'selected' : '' ?>><?php echo $customer->company_name; ?>
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
                                <div class="col-md-2">                                 
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Date</label>
                                        <input type="date" class="form-control" required name="date" value="<?php echo $quotation['date']; ?>" id="date" >                                                                                 
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Remarks is Required.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">                                 
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Remarks</label>
                                        <input type="text" class="form-control" name="remarks" id="remarks" value="<?php echo $quotation['remarks']; ?>"> 
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Remark is Required.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
</div>

<!-- <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                 
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Tax payable on reverse charge</label>
                                        <select class="form-control" name="tax_payable" id="tax_payable" required>
                                            <option value="">--Select Yes or No--</option>
                                            
                                            <option value="1" <?= ($quotation['tax_payable'] == $quotation['tax_payable']) ? 'selected' : '' ?>>Yes</option>
                                            <option value="0" <?= ($quotation['tax_payable'] == $quotation['tax_payable']) ? 'selected' : '' ?>>No</option>
                                           
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
                                     <input type="text" name="place_of_supply" value="<?= $quotation['place_of_supply']?>" class="form-control"  id="place_of_supply" placeholder="Enter the place of supply"  required>
                                    <div class="valid-feedback">
                                         Looks good!
                                     </div>
                                     <div class="invalid-feedback">
                                     Place of supply Required.
                                     </div>
                                 </div>
                             </div>
                                <div class="col-md-4">
                                 
                                 <div class="mb-3">
                                     <label for="validationCustom01" class="form-label">PO Number</label>
                                     <input type="text" name="po_no" class="form-control" value="<?= $quotation['po_number']?>" id="po_no" placeholder="Enter the PO Number"  required>
                                    <div class="valid-feedback">
                                         Looks good!
                                     </div>
                                     <div class="invalid-feedback">
                                     Place of supply Required.
                                     </div>
                                 </div>
                             </div>
                            </div>
                        </div>
                </div>
            </div>
</div> -->


        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="max rtl-bc" >
                            <div id="addProduct" class="addProduct">
                                <?php foreach($quotations as $key => $q) {?>
                            <div class="row" id="fieldcount<?= $key?>">
                            <input type="hidden" name="primary_id[]"  class="form-control" id="primary_id<?=  $key ?>" data="<?= $q->id?>" value="<?= $q->id?>"> 
                                <div class="col-md-2 count1">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Product</label>
                                        <select class="form-control" name="product[]" onchange="get_product(this.value, <?= $key?>)" id="product<?= $key?>" required>
                                            <option value="">--Select --</option>
                                            <?php foreach($products as $product) {?>
                                            <option value="<?php echo $product->product_id; ?>" <?= ($q->product_id == $product->product_id) ? 'selected' : '' ?>><?php echo $product->product_name; ?>
                                            <?php }?>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Product Name Required.
                                        </div>
                                    </div>
                                </div>
                                           
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">HSN Code</label>
                                        
                                        <input type="text" name="hsn[]" class="form-control" value="<?= $q->hsn_name ?>" id="hsn<?= $key?>" placeholder=" Hsn " readonly required>
                                        
                                        <input type="text" name="hsn_id[]" hidden class="form-control" id="hsn_id<?= $key?>" value=" <?=$q->hsn_id?>" placeholder=" Hsn "  required>
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
                                        <select class="form-control" name="uom_id[]" id="uom<?= $key?>" required>
                                            <option value="">--Select UOM --</option>
                                            <?php foreach($uom as $u)
                                            {?>
                                            <option value="<?php echo $u->uom_id; ?>" <?php echo ($q->uom_id == $u->uom_id) ?  'selected' : '';  ?> ><?php echo $u->uom; ?>
                                            <?php }?>
                                        </select>                                              
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        UOM Required.
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-md-2" style="width: 12%;">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">UOM</label>
                                        <input type="text" name="uom[]" readonly class="form-control" id="uom<?= $key?>" placeholder="UOM" value="<?= $q->uom ?>" required>
                                        <input type="text" name="uom_id[]" hidden class="form-control" id="uom_id<?= $key?>" placeholder="UOM" value="<?= $q->uom_id ?>" required>
                                             <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        UOM Required.
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-md-2" style="width: 13%;">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Quantity</label>
                                        <input type="number" name="qty[]" step="0.01" value="<?= $q->subQty ?>" class="form-control qty"  id="qty<?= $key?>" oninput="get_qty(this.value, <?= $key?>)" placeholder=" Qty"  required>
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
                                        <label for="validationCustom01" class="form-label">Price</label>
                                        <input type="number" name="price[]" value="<?= $q->subPrice ?>" class="form-control price"  id="price<?= $key?>" placeholder=" Price" oninput="get_amount(this.value, <?= $key?>)" required>
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
                                        <input type="text" name="amount[]" value="<?= $q->subAmount ?>" class="form-control amount" readonly id="amount<?= $key?>"  placeholder="amount"  required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        price Required.
                                        </div>
                                    </div>
                                </div>                                
                                    <div class="col-md-1" style="width:4.333333%"><i class="fa fa-trash mt-5" onclick="removediv('<?= $key?>')" id="remove<?= $key?>" style="font-size:22px;color:red"></i></div>
                            </div>
                            <?php }?>
                        </div>
                        <div class="col-md-1 mt-3" id="adremovebuttons"><br>
                            <button type="button" id="button1" class="add-field btn btn-success btn-circle"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>                                                                
                        </div>
                    </div>
                    <div id="removefield">
                    </div>
                                <div class="row row_spc">
                            <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;"> Taxable Value of Supply of Goods :  </div>
                                <div class="col-md-3"  >
                                    <input type="text" readonly class="form-control sub_total mb-2" name="sub_total" id="sub_total" >
                                </div>
                        </div>
                        <div class="row row_spc cgstaddremove<?= $customer_state == 4035 ?'d-none':'';?>">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;"> CGST :   </div>
                                <div class="col-md-3">
                                    <input type="text" readonly class="form-control mb-2" id="cgst" name="cgst" >
                                </div>
                        </div>
                        <div class="row row_spc sgstaddremove<?= $customer_state == 4035 ?'d-none':'';?>">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">SGST :   </div>
                            <div class="col-md-3">
                                <input type="text" readonly class="form-control mb-2" id="sgst" name="sgst" >
                            </div>
                        </div>

                        <div class="row row_spc igstaddremove <?= $customer_state != 4035 ?'d-none':'';?>" >
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">IGST :   </div>
                            <div class="col-md-3">
                                <input type="text" readonly class="form-control mb-2" id="igst" name="igst" >
                            </div>
                        </div>                        
                        
                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">TOTAL TAX :  </div>
                            <div class="col-md-3"> 
                                <input type="text" readonly class="form-control mb-2" id="total_tax" name="total_tax" >
                            </div>
                        </div>
                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">ROUND OFF :  </div>
                            <div class="col-md-3"> 
                                <input type="text" readonly class="form-control mb-2" id="round_off" name="round_off" >
                            </div>
                        </div>
                        <div class="row row_spc">
                        <div class="col-md-9 h6 mb-1 mt-3" style="text-align: right;">GRAND TOTAL :   </div>
                                <div class="col-md-3">
                                    <input type="text" readonly class="form-control mb-2" id="g_total" name="g_total" >
                                </div>
                        </div>


                            <div>
                            <button class="btn btn-primary"  type="submit" value="submit" name="submit">Submit</button>
                                <a href="#"><button onclick="window.location.reload()" class="btn btn-warning" type="button">Cancel</button></a>
                            </div>
                        </div>
                           
                        </form>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

   
        function get_state(val) {
        alert(val);
        };
    function get_product(product_id,no) {
        
        $.ajax({
            url: "<?php echo site_url() ?>Quotation/get_product",
            method: "POST",
            type: "ajax",
            data: {
                product_id: product_id
            },
            success: function(result) {                
                var data = JSON.parse(result);
               
                console.log(data);    
                $('#hsn'+no).val(data.hsn_name);
                $('#uom'+no).val(data.uom);
                $('#hsn_id'+no).val(data.hsn_id);
                $('#uom_id'+no).val(data.uom_id);
                $('#price'+no).val(data.product_rate);
                $('#amount'+no).val('0.00');
                $('#qty'+no).val('');
                calculateAmount();                
            },
            error: function(error) {
                console.log(error);
            }
        });        
    }


    

    $('.max').each(function() {
                var $wrapper = $('#addProduct', this);
                $(".add-field", $(this)).click(function(e, no) {  
                    var no = $('.count1').length;
                    $('.addProduct').append(
                        '<div class="row fieldcount'+no+'"> <div class="col-md-2 count1"> <div class="mb-2"> <label for="validationCustom01" class="form-label">Product</label> <select class="form-control selectDrop" name="product[]" onchange="get_product(this.value, '+no+')" id="product'+no+'" required> <option value="">--Select --</option> <?php foreach($products as $product) {?> <option value="<?php echo $product->product_id; ?>"><?php echo $product->product_name; ?> <?php }?> </select> <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Product Name Required. </div> </div> </div><input type="text" name="primary_id[]" hidden class="form-control" id="primary_id0'+no+'"> <div class="col-md-2"> <div class="mb-3"> <label for="validationCustom01" class="form-label">HSN</label> <input type="text" name="hsn[]" class="form-control" id="hsn'+no+'" placeholder=" HSN Code" readonly required> <input type="text" name="hsn_id[]" hidden class="form-control" id="hsn_id'+no+'" placeholder=" HSN Code"  required> <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> HSN Code Required. </div> </div> </div> <div class="col-md-2" style="width: 12%;"> <div class="mb-3"> <label for="validationCustom01" class="form-label">UOM</label> <select class="form-control selectDrop" name="uom_id[]" id="uom'+no+'" required> <option value="">--Select --</option> <?php foreach($uom as $u) {?> <option value="<?php echo $u->uom_id; ?>"  ><?php echo $u->uom; ?> <?php }?> </select> <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> UOM Required. </div> </div> </div> <div class="col-md-2" style="width: 13%;"> <div class="mb-3"> <label for="validationCustom01" class="form-label">Qty</label> <input type="number" step="0.01" name="qty[]" class="form-control qty" oninput="get_qty(this.value, '+no+')" id="qty'+no+'" placeholder=" Qty"  required> <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> price Required. </div> </div> </div> <div class="col-md-2"> <div class="mb-3"> <label for="validationCustom01" class="form-label">Price</label> <input type="text" name="price[]" class="form-control price"  id="price'+no+'" placeholder=" Price" oninput="get_amount(this.value, '+no+')" required> <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> price Required. </div> </div> </div> <div class="col-md-2"> <div class="mb-3"> <label for="validationCustom01" class="form-label">Amount</label> <input type="text" name="amount[]" value="0.00" class="form-control amount" readonly  id="amount'+no+'" placeholder="Amount"  required> <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> price Required. </div> </div> </div> ' +
                        '<div class="col-md-1" style="width:4.333333%"><i class="fa fa-trash mt-5" onclick="removediv('+no+')" id="remove'+no+'" style="font-size:22px;color:red"></i></div></div>');
                    // row.appendTo($wrapper);   
                    $('.selectDrop').select2();
                });
            });

    $(document).ready(function () {    
        
        $('#sold_to').change(function() {
    // Get the selected option
    var selectedOption = $(this).find(':selected');

    // Get the data attribute value using the .data() method
    var info = selectedOption.data('info');

    if(info == 4035){
        $('.igstaddremove').addClass('d-none');
        $('.sgstaddremove').removeClass('d-none');
        $('.cgstaddremove').removeClass('d-none');
        $('#igst').val('');       
        calculateAmount();  
    }else{
        $('.igstaddremove').removeClass('d-none');
        $('.sgstaddremove').addClass('d-none');
        $('.cgstaddremove').addClass('d-none');
        $('#sgst').val('');
        $('#cgst').val('');
        calculateAmount();  
    }

    });


        calculateAmount();                  
            // Add more fields
          
        });
        // Remove fields
        function removediv(no){                        
            var id = $('#primary_id'+no).attr('data');           
            var $wrapper = $('#removefield');
            var row = $('<input type="hidden" id="removeid" name="removeid[]" value="'+id+'">');
            row.appendTo($wrapper);
            $('#fieldcount'+no).remove();
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
                    if($.isNumeric(ob.value)){
                        sub_total += parseFloat(ob.value);
                    }
                });

    $('#sub_total').val(sub_total.toFixed(2));

     // document.getElementById('sub_total').value = totalSubtotal.toFixed(2);
        var subTotal = Number(document.getElementById('sub_total').value);
        cgst = subTotal * 9 / 100;
        sgst = subTotal * 9 / 100;
        $('#cgst').val(cgst.toFixed(2));
        $('#sgst').val(sgst.toFixed(2));
        $('#igst').val((parseFloat(sgst)+parseFloat(cgst)).toFixed(2));

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