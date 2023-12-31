
<body>
    <div class="row" id="printdiv">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice" style="width: 800px; margin: 0 auto; padding: 20px; border: 0px solid #ccc;">
                        <div class="logo">
                            <img src="<?= base_url('assets/images/logo.jpg') ?>" alt="Logo" style="max-width: 100px;">
                            <span>
                            <h3 style="text-align: center; margin-top: 0;">QUOTATION</h3>
                            </span>
                        </div>
                        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; border: 1px solid #ccc;">
                        <tr style="width: 100%; height: 170px;">
                        <td style="width: 50%;border-right: 1px solid #ccc;">
                            <table style="width: 100%; height:170px;">
                                <tr>
                                    <td><p style="text-align: left;padding-left:7px;">COMPANY DETAILS :</p></td>
                                    <td><p style="text-align: left;margin-left:7px;"><?= $company['company_name'].', '.$company['company_address'].', '.$company['city'].', '.$company['state'].'-'.$company['pincode'].', India.' ?></p></td>
                                </tr>
                                <tr>
                                    <td><p style="text-align: left;padding-left:7px;">GSTIN/UIN : </p></td>
                                    <td><p style="text-align: left; margin-left:7px;"><?= $company['company_gstin']?></p></td>
                                </tr>
                                <tr>
                                    <td><p style="text-align: left;padding-left:7px;">PHONE NO.:</p></td>
                                    <td><p style="text-align: left;margin-left:7px;"><?= $company['company_phone_number']?></p></td>
                                </tr>
                                <tr>
                                    <td><p style="text-align: left;padding-left:7px;">TAN NO.:</p></td>
                                    <td><p style="text-align: left;margin-left:7px;"><?= $company['company_tan_number']?></p></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 50%;">
                            <table style="width: 100%; ">
                                <tr>
                                    <td  style="border-bottom: 1px solid #ccc;padding-left:7px;"><p style="text-align: left;">Quotation No.:&nbsp;&nbsp;<?= $company['quotation_starting_number'].$quotation['qId'] ?></p></td>
                                    <td  style="border-bottom: 1px solid #ccc;"><p style="text-align: left;"></p></td>
                                </tr>
                                <tr>
                                    <td  style="border-bottom: 1px solid #ccc;padding-left:7px;"><p style="text-align: left;">Qutotation Date : &nbsp;&nbsp;<?= date('d-m-y') ?></p></td>
                                    <td  style="border-bottom: 1px solid #ccc;text-align: left;"><p style=""></p></td>
                                </tr>
                                <tr>
                                    <td  style="border-bottom: 1px solid #ccc;padding-left:7px;"><p style="text-align: left;margin-right:10px;">Whether the tax is payable <br> on reverse charge basis: &nbsp;&nbsp; Y/N</p></td>
                                    <td  style="border-bottom: 1px solid #ccc;padding-left:7px;"></td>
                                  
                                </tr>
                                <tr>
                                    <td style="margin-left:10px;padding-left:7px;"><p style="text-align: left;">Place of Supply:&nbsp;&nbsp;<?= $sold_to_party['stateName'] ?></p></td>
                                    <td style="margin-left:10px;"><p style="text-align: left;margin-right:10px;"></p></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="border-top: 1px solid #ccc; width:100%;border-left: 1px solid #ccc;padding-left:5px;padding:5px;">
                        <td style=" width:50%;"><p style="text-align:left;font-weight: bold;padding-left:5px;padding:5px;";>Sold to Party</p></td>
                        <td style="width:50%;border-left: 1px solid #ccc;padding-left:5px;"><p style="text-align:left;font-weight: bold;padding:5px;";>Ship to Party</p></td>
                    </tr>
                    <tr style="border-top: 1px solid #ccc; width:100%;padding-left:10px;">
                    <td style="width: 50%;padding-left:10px;">
                            <table style="width: 100%; height:20px;">
                        <tr>
                            
                            <td style="padding:5px;"><?= $sold_to_party['company_name'] ?></td>
                        </tr>
                        <tr>
                            <td style="padding:5px;"><?= $sold_to_party['customer_address_1'].', '.$sold_to_party['customer_city'].', '.$sold_to_party['stateName'].'-'.$sold_to_party['customer_pincode'].', India.' ?></td>
                        </tr>
                        <tr>
                            <td style="padding:5px;">GSTIN/UID :&nbsp;&nbsp;<?= $sold_to_party['customer_gst_no'] ?></td>
                            
                        </tr>
                        </table>
                    </td>
                    <td style="width: 50%;">
                            <table style="width: 100%; height:20px; border-left: 1px solid #ccc;">
                        <tr>
                            <td style="padding:5px;"><?= $ship_to_party['company_name'] ?></td>
                        </tr>
                        <tr>
                            <td style="padding:5px;"><?= $ship_to_party['customer_address_1'].', '.$ship_to_party['customer_city'].', '.$ship_to_party['stateName'].'-'.$ship_to_party['customer_pincode'].', India.' ?></td>
                        </tr>
                        <tr>
                            <td style="padding:5px;">GSTIN/UID :&nbsp;&nbsp;<?= $ship_to_party['customer_gst_no'] ?></td>
                        </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                    <table style="width: 100%; border-collapse: collapse; margin-top:-18px; ">
 
                    <thead style="width:100%;"><br>
                        <tr style="border: 1px solid #ccc; width:100%;">
                            <th style="border: 1px solid #ccc;padding:5px;"><center>S.No.</center></th>
                            <th style="border: 1px solid #ccc;padding:5px;"><center>Description of Goods</center></th>
                            <th style="border: 1px solid #ccc;"><center>HSN Code</center></th>
                            <th style="border: 1px solid #ccc;"><center>UOM</center></th>
                            <th style="border: 1px solid #ccc;"><center>Quantity</center></th>
                            <th style="border: 1px solid #ccc;"><center>Price</center></th>
                            <th style="border: 1px solid #ccc;"><center>Amount</center></th>
                        </tr>
                    </thead>
                    <tbody style="border: 1px solid #ccc;">
                       <?php
                         $i= 1; 
                         foreach($quotation_sub as $q){ 
                       ?>
                            <tr style="border: 1px solid #ccc;" >
                                <td style="border: 1px solid #ccc;text-align:center;"><?= $i ?></td>
                                <td style="border: 1px solid #ccc;padding:5px;margin-center:10px;text-align:center;"><?= $q->product_name ?></td>
                                <td style="border: 1px solid #ccc;padding:5px;text-align:center;"><?= $q->hsn_name ?></td>
                                <td style="border: 1px solid #ccc;padding:5px;text-align:center;"><?= $q->uom ?></td>
                                <td style="border: 1px solid #ccc;padding:5px;text-align:center;"><?= $q->subQty ?></td>
                                <td style="border: 1px solid #ccc;padding:5px;text-align:right;">₹ <?= $q->subPrice ?></td>
                                <td style="border: 1px solid #ccc;padding:5px;text-align:right;">₹ <?= $q->subAmount ?></td>
                            </tr>
                        <?php 
                            $i++;
                         } ?>
                    </tbody>
                    <tfoot style="border: 1px solid #ccc;">
                    <td rowspan="5" colspan="2">
                        <p style="margin-left:10px;font-weight: bold; text-align:center;" class="mt-2">Bank Details:</p>
                        <p style="margin-left:10px;" class="mt-1">Bank Name : <?= $company['bank_name'] ?>
                        </br>Account Number : <?= $company['bank_account_no'] ?>
                        </br>IFSC Code : <?= $company['bank_ifsc'] ?>
                        </br>Bank Address : <?= $company['bank_address'] ?></p>
                    </td>
                    <tr style="border: 1px solid #ccc;">
                            <td style="border: 1px solid #ccc; padding-right:30px;" colspan="4" align="right">Sub Total</td>
                            <td style="border: 1px solid #ccc;padding-left:50px; text-align:right;">₹ <?= $quotation['sub_total'] ?></td>
                        </tr>
                        <?php if ($sold_to_party['stateName']=="Tamil Nadu"){ ?>
                        <tr style="border: 1px solid #ccc; ">
                            <td  style="border: 1px solid #ccc;padding-right:30px; " colspan="4" align="right">SGST (9%)</td>
                            <td style="border: 1px solid #ccc;padding-left:50px;text-align:right;">₹ <?= $quotation['sgst'] ?></td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="border: 1px solid #ccc; padding-right:30px;" colspan="4" align="right">CGST (9%)</td>
                            <td style="border: 1px solid #ccc;padding-left:50px;text-align:right;">₹ <?= $quotation['cgst'] ?></td>
                        </tr>
                            <?php }else{ ?>
                        <tr style="border: 1px solid #ccc;">
                            <td style="border: 1px solid #ccc; padding-right:30px;" colspan="4" align="right">IGST (18%)</td>
                            <td style="border: 1px solid #ccc;padding-left:50px;text-align:right;">₹ <?= number_format($quotation['cgst'] + $quotation['sgst'],2) ?></td>
                        </tr>
                        <?php } ?>

                      
                        <tr style="border: 1px solid #ccc;">
                            <td style="border: 1px solid #ccc; padding-right:30px;" colspan="4" align="right">TOTAL TAX</td>
                            <td style="padding-left:50px;text-align:right;">₹ <?= number_format($quotation['cgst'] + $quotation['sgst'],2) ?></td>
                        </tr>
                    </tfoot>
                    </table>
                    </tr>
                    
                    <tr>
                    <table style="border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-bottom: 1px solid #ccc; margin-top:-22px; width:100%;">
                      <tr style="padding:5px;"> <br> 
                        <td style="padding:5px;width:60%;border-bottom:1px solid #ccc; font-weight: bold;padding-left:5px;" id="inWords">Qutotation Value in Words: </td>
                        <!-- <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;font-weight: bold;" id=""></td> -->
                        <td style="padding:5px;width:40%;border-bottom:1px solid #ccc; border-left:1px solid #ccc; text-style:bold; font-weight: bold;">TOTAL QUOTATION VALUE : <span style="text-align:right;">₹ <?= number_format($quotation['grand_total'], 2, '.' , ',') ?></span></td>
                      </tr>
                     
                    <tr >
                           <td style="border-bottom:1px solid #ccc;" colspan="3">&nbsp;Remarks :   &nbsp;<?= $quotation['remarks'] ?></td>
                        <td style="padding-left:10px;"></td>
                        <td></td>
                    </tr>
                        
                    <tr >
                        <td style="border-bottom:1px solid #ccc;padding-left:8px;" colspan="3">
                            <span style="font-weight: bold;">Terms and Conditions: </span><br><br>
                            1. Price as applicable on the date of dispatch shall be charged.<br>
                            2. Payment should be made by 'A/C Payee only' - bank draft/cheque or bank remmitance by NEFT/RTGS in favour of Sun-x Concrete India Private Limited.<br>
                            3. Payments recieved beyond agreed credit period will attract an interest @ 24% per annum.<br>
                            4. In case of EX,delivery of goods shall be completed as soon as the goods are delivered to the carrier and title & all the risk of goods stands transfer to buyer immediately.<br>
                            5. All disputes are subject to Chennai jurisdiction only.<br>
                            6. In case TCS is not charged in the invoice customer has to provide FORM 27c TCS will be charged.<br>
                            7. Loading Weight Bridge weight is final.<br>
                            8. Our Responsibility ceases immediately after the truck leaves our premises.<br>
                            9. We are not responsible for any damage occurs during the transit.<br>
                            10. Goods once sold will not be taken back or replaced.<br>
                            11. All Disputes arising out of or in connection with this invoice or touching upon the invoice shall be reffered to sole Arbitration and the Sole Arbitrator shall be appointed by Sun-x Concete India Private Limited and the award 
                            passes there on would be binding on both the parties. The Arbitration shall be conducted in accordance with the provisions of the Arbitration and Reconcilation Act 1996 or any amendment there of.  The seat of Arbitration shall be at 
                            Chennai only.<br>
                            12. Payment Shall be made within 30 days from the date of invoice.<br><br> 
                        </td>
                    </tr>
                        <tr >
                            <td style="padding-left:5px;padding-bottom:50px;width:50%;padding-left:7px;">Material Recieved in Good Condition & Quality</td>
                            <!-- <td></td> -->
                            <td style="padding-bottom:50px;width:50%;text-align:right;">For Sun X Concrete India Private Limited</td>
                        </tr>
                        <tr>
                            <td style="padding-left:7px;">(Reciever's Signature with seal)</td>
                            <!-- <td></td> -->
                            <td style="text-align:right;padding-right:5px;">(Authorized Signatory)</td>
                        </tr>
                    </table>
                    </tr>
                    </table><br>
                    </div>
                    <div class="download-button" style="text-align: center; margin-top: 20px;">
                        <button id="print-btn" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Print</button>
                    </div><br><br>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    document.getElementById("print-btn").addEventListener("click", function() {
        const printContents = document.getElementById("printdiv").innerHTML;
        const originalContents = document.body.innerHTML;
        
        // Remove the print button from the content
        const contentWithoutButton = printContents.replace('<div class="download-button"', '<div class="download-button" style="display:none"');
        
        document.body.innerHTML = contentWithoutButton;
        window.print();
       // document.body.innerHTML = originalContents;
        location.reload();
    });

    function numberToWords(number) {
    // Define arrays for words
    const units = ["", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];
    const teens = ["", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"];
    const tens = ["", "ten", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"];
    const thousands = ["", "thousand", "million", "billion", "trillion"];

    // Helper function to convert a group of 3 digits to words
    function convertGroup(number) {
        let result = "";

        const hundred = Math.floor(number / 100);
        const remainder = number % 100;

        if (hundred > 0) {
            result += units[hundred] + " hundred";
            if (remainder > 0) {
                result += " and ";
            }
        }

        if (remainder > 0) {
            if (remainder < 10) {
                result += units[remainder];
            } else if (remainder < 20) {
                result += teens[remainder - 10];
            } else {
                const ten = Math.floor(remainder / 10);
                const one = remainder % 10;
                result += tens[ten];
                if (one > 0) {
                    result += "-" + units[one];
                }
            }
        }

        return result;
    }

    if (number === 0) {
        return "zero";
    }

    let words = "";
    let groupIndex = 0;

    while (number > 0) {
        const group = number % 1000;
        if (group > 0) {
            words = convertGroup(group) + " " + thousands[groupIndex] + " " + words;
        }
        number = Math.floor(number / 1000);
        groupIndex++;
    }

    return words.trim();
}

// Example usage:
const number = <?=  $quotation['grand_total']  ?>;
const inputString = numberToWords(number);

const capitalizedWord = capitalizeWords(inputString);

word =  capitalizedWord;

document.getElementById("inWords").textContent ='Qutotation Value in Words: ' + word;



function capitalizeWords(inputString) {
    // Split the string into words
    const words = inputString.split(' ');

    // Capitalize the first letter of each word
    const capitalizedWords = words.map(word => {
        if (word.length > 0) {
            return word[0].toUpperCase() + word.slice(1);
        } else {
            return '';
        }
    });

    // Join the capitalized words back into a string
    return capitalizedWords.join(' ');

}

</script>

</body>
