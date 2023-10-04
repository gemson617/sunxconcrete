
<body><br><br>
    <div class="row" id="printdiv">
        <div class="col-12" style="border-collapse: collapse; border: 0px solid #ccc;">
            <div class="card">
                <div class="card-body">
                    <div class="invoice" style="width: 800px; margin: 0 auto; border: 1px solid #ccc;">
                        <div class="logo" align="right" style="padding-right:5px;">
                            <p style="padding-bottom: 0px;">Exclusive channel partner of</p>
                            <img src="<?= base_url('assets/images/logo.jpg') ?>" align="right" alt="Logo" style="max-width: 100px;align-content-right;">
                            <span>
                            <h3 style="text-align: center; margin-top: 0;">Delivery Challan</h3>
                            </span>
                        </div>
                        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; border: 1px solid #ccc;">
                        <!-- <tr style="width: 100%; height: 170px;">
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
                                    <td  style="border-bottom: 1px solid #ccc;padding-left:7px;"><p style="text-align: left;">Quotation No.:</p></td>
                                    <td  style="border-bottom: 1px solid #ccc;"><p style="text-align: left;"><?= $company['quotation_starting_number'].$quotation['qId'] ?></p></td>
                                </tr>
                                <tr>
                                    <td  style="border-bottom: 1px solid #ccc;padding-left:7px;"><p style="text-align: left;">Qutotation Date:</p></td>
                                    <td  style="border-bottom: 1px solid #ccc;"><p style="text-align: left;"><?= date('d-m-y') ?></p></td>
                                </tr>
                                <tr>
                                    <td  style="border-bottom: 1px solid #ccc;padding-left:7px;"><p style="text-align: left;margin-right:10px;">Whether the tax is payable on reverse charge basis:</p></td>
                                    <td  style="border-bottom: 1px solid #ccc;"><p style="text-align: left;"><?= ($quotation['tax_payable']==1) ? 'yes' : 'No' ?></p></td>
                                </tr>
                                <tr>
                                    <td style="margin-left:10px;padding-left:7px;"><p style="text-align: left;">Place of Supply:</p></td>
                                    <td style="margin-left:10px;"><p style="text-align: left;margin-right:10px;"><?= $quotation['place_of_supply'] ?></p></td>
                                </tr>
                            </table>
                        </td>
                    </tr> -->
                    <tr style="border-top: 1px solid #ccc; height: 30px; width:100%;border-left: 1px solid #ccc;">
                        <td style=" width:50%;"><p style="text-align:left;font-weight: bold;";>Cosignee :</p></td>
                        <td style="width:50%;border-left: 1px solid #ccc;"><p style="text-align:left;font-weight: bold;";>Delivery Address :</p></td>
                    </tr>
                    <tr style="border-top: 1px solid #ccc; width:100%;margin-left:10px;">
                    <td style="width: 50%;">
                            <table style="width: 100%; height:170px;">
                        <tr style="border-bottom: 1px solid #ccc;padding:1px;">
                            <!-- <td style="padding-left:7px;border-bottom:1px solid #ccc;">Name:</td> -->
                            <td style=""><?= $sold_to_party['company_name'] ?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #ccc;padding:1px;">
                            <!-- <td style="padding-left:7px;">Address:</td> -->
                            <td><?= $ship_to_party['customer_address_1']?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #ccc;padding:1px;">
                        <td style="padding-right:3px;"><?= $ship_to_party['customer_city'] ?></td>
                        <td style="border-left: 1px solid #ccc;padding:1px;border-right: 1px solid #ccc;padding:1px;justify-content:center;">pincode</td>
                        <td style="border-left: 1px solid #ccc;padding:1px;border-right: 1px solid #ccc;padding:1px;"><?= $ship_to_party['customer_pincode'] ?></td>
                    </tr>
                        <tr style="border-bottom: 1px solid #ccc;padding:1px;">
                            <td><?= $ship_to_party['stateName'] ?></td>
                        </tr>
                        <tr style="">
                            <!-- <td style="padding-left:7px;">GSTIN/UID:</td> -->
                            <td style="border-left: 1px solid #ccc;padding:1px;border-right: 1px solid #ccc;padding:1px;justify-content:center;">State Code</td>
                        <td style="border-left: 1px solid #ccc;padding:1px;padding:1px;">33</td>
                                    </tr>
                        </table>
                    </td>
                    <td style="width: 50%;">
                            <table style="width: 100%; height:170px; border-left: 1px solid #ccc;">
                            <tr style="border-bottom: 1px solid #ccc;padding:1px;">
                            <!-- <td style="padding-left:7px;border-bottom:1px solid #ccc;">Name:</td> -->
                            <td style=""><?= $ship_to_party['company_name'] ?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #ccc;padding:1px;">
                            <!-- <td style="padding-left:7px;">Address:</td> -->
                            <td><?= $ship_to_party['customer_address_1'].', '.$ship_to_party['customer_city'].', '.$sold_to_party['stateName'].'-'.$sold_to_party['customer_pincode'].', India.' ?></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #ccc;padding:1px;">
                        <td><?= $sold_to_party['customer_city'] ?></td>
                        <td style="border-left: 1px solid #ccc;padding:1px;border-right: 1px solid #ccc;padding:1px;">pincode</td>
                        <td style="border-left: 1px solid #ccc;padding:1px;border-right: 1px solid #ccc;padding:1px;"><?= $sold_to_party['customer_pincode'] ?></td>
                    </tr>
                        <tr style="border-bottom: 1px solid #ccc;padding:1px;">
                            <td><?= $sold_to_party['stateName'] ?></td>
                        </tr>
                        <tr style="">
                            <!-- <td style="padding-left:7px;">GSTIN/UID:</td> -->
                            <td style="border-left: 1px solid #ccc;padding:1px;border-right: 1px solid #ccc;padding:1px;justify-content:center;">State Code</td>
                        <td style="border-left: 1px solid #ccc;padding:1px;padding:1px;">33</td>                        </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                     
                    <table style="width: 100%; border-collapse: collapse; margin-top:-18px; ">
                    
                    <thead style="width:100%;">
                        <tr style="border: 1px solid #ccc; width:100%;padding:4px;">
                            <th style="border: 1px solid #ccc;padding:4px;"><center>Truck Number</center></th>
                            <td style="border: 1px solid #ccc;padding:4px;"><center>Description of Goods</center></td>
                            <td style="border: 1px solid #ccc;"><center>PO Number</center></td>
                            <td style="border: 1px solid #ccc;"><center>Description of Goods</center></td>
                            <td style="border: 1px solid #ccc;"><center>DC No</center></td>
                            <th style="border: 1px solid #ccc;"><center></center></th>
                        </tr>
                        <tr style="border: 1px solid #ccc; width:100%;padding:4px;">
                            <th style="border: 1px solid #ccc;padding:4px;"><center>Driver Name</center></th>
                            <td style="border: 1px solid #ccc;padding:4px;"><center></center></td>
                            <td style="border: 1px solid #ccc;"><center></center></td>
                            <td style="border: 1px solid #ccc;"><center></center></td>
                            <td style="border: 1px solid #ccc;"><center>Batch No</center></td>
                            <th style="border: 1px solid #ccc;"><center></center></th>
                        </tr>
                        <tr style="border: 1px solid #ccc; width:100%;padding:4px;">
                            <th style="border: 1px solid #ccc;padding:4px;"><center>Plant Name</center></th>
                            <td style="border: 1px solid #ccc;padding:4px;"><center>Description of Goods</center></td>
                            <td style="border: 1px solid #ccc;"><center>Mode of Unloading</center></td>
                            <td style="border: 1px solid #ccc;"><center></center></td>
                            <td style="border: 1px solid #ccc;"><center>DC Date</center></td>
                            <th style="border: 1px solid #ccc;"><center></center><?= date('d-m-y')?></th>
                        </tr>
                    </thead>
                    <tbody style="border: 1px solid #ccc;">
                    </tbody>
                    <tfoot style="border: 1px solid #ccc;">
                    <br>
                   

                    <br>
                
                    </tfoot>
                    


                    </table>
                    </tr>

                    <tr><table style="border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-bottom: 1px solid #ccc; margin-top:-22px; width:100%;">
                  <br><br>
                    <tr style="border: 1px solid #ccc; width:100%;padding:4px;">
                            <th style="border: 1px solid #ccc;padding:4px;"><center>Product</center></th>
                            <th style="border: 1px solid #ccc;padding:4px;"><center>HSN / SAC CODE</center></th>
                            <th style="border: 1px solid #ccc;"><center>Grade</center></th>
                            <th style="border: 1px solid #ccc;"><center>Quantity</center></th>
                            <th style="border: 1px solid #ccc;"><center>Rate/Unit</center></th>
                            <th style="border: 1px solid #ccc;"><center>Amount</center></th>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;padding:4px;"><center>1</center></td>
                        <td style="border: 1px solid #ccc;padding:4px;"><center>1</center></td>
                        <td style="border: 1px solid #ccc;padding:4px;"><center>1</center></td>
                        <td style="border: 1px solid #ccc;padding:4px;"><center>1</center></td>
                        <td style="border: 1px solid #ccc;padding:4px;"><center>1</center></td>
                        <td style="border: 1px solid #ccc;padding:4px;"><center>1</center></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;padding:4px;"><center><p>CGST 9%</p></center></td>
                        <td style=><center></center></td>
                        <td style=><center></center></td>
                        <td style=><center></center></td>
                        <td style=><center></center></td>
                        <td style="border: 1px solid #ccc;padding:4px;"><center><p></p></center></td>
                    </tr>
                    <tr>
                       <td style="border: 1px solid #ccc;padding:4px;"><center><p>SGST 9%</p></center></td>
                       <td style=><center></center></td>
                        <td style=><center></center></td>
                        <td style=><center></center></td>
                        <td style=><center></center></td>
                        <td style="border: 1px solid #ccc;padding:4px;"><center><p></p></center></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #ccc;padding:4px;"><center>Round Off</center></td>
                        <td style=><center></center></td>
                        <td style=><center></center></td>
                        <td style=><center></center></td>
                        <td style=><center></center></td>
                        <td style="border: 1px solid #ccc;padding:4px;"><center><p></p></center></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ccc;padding:4px;">
                        <td style="border-right: 1px solid #ccc;padding:4px;"><center>Total</center></td>
                        <td style=''><center></center></td>
                        <td style=><center></center></td>
                        <td style=><center></center></td>
                        <td style=><center></center></td>
                        <td style="border: 1px solid #ccc;padding:4px;"><center><p></p></center></td>
                    </tr>
                    <tr>
                        <td style="border-bottom:1px solid #ccc; font-weight: bold;" id="">Qutotation Value in Words: </td>
                        <td style="border-bottom:1px solid #ccc;border-top:1px solid #ccc; border-left:1px solid #ccc;font-weight: bold;" id="inWords"></td>
                        </tr>
                    </table></tr>


                    <tr >
                    <table style="border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-bottom: 1px solid #ccc; margin-top:-22px; width:100%;">
                      <br>
                
                       <br><br><br>
                        <tr><table style="border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-bottom: 1px solid #ccc; margin-top:-22px; width:100%;">
                        <tr style="border-top:1px solid #ccc;">
                            <th style="border-bottom:1px solid #ccc;">HSN/SAC</th>
                            <th style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">Taxable Value :</th>
                            <th style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;" colspan="2">Central Tax</th>
                            <th style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;"colspan="2">State Tax</th>
                            <th style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">Total Tax Payable</th>
                        </tr>
                        <tr>
                        <td style="border-bottom:1px solid #ccc"rowspan="2">Mode of Unloading:</td>
                        <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;" rowspan="2">LR/RR Date:</td>
                        <th style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">Rate 9%</th>
                        <th style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">Amount</th>
                        <th style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">Rate 9%</th>
                        <th style="border-bottom:1px solid #ccc; border-left:1px solid #ccc; border-right:1px solid #ccc;">Amount</th>
                        </tr>
                        <tr>
                        <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">Pump Seriel No.:</td>
                        <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">Freight:</td>
                        <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">Incoterm: 35 days</td>
                        <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">Pump Seriel No.:</td>
                        <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">Freight:</td>
                        </tr>
                        <tr>
                        <td style="border-bottom:1px solid #ccc">Total :</td>
                        <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">KM:</td>
                        <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;"></td>
                        <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">Total :</td>
                        <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">KM:</td>
                        <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">1</td>
                        <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;">2</td>
                        </tr>
                        <tr >
                        <td style="border-bottom:1px solid #ccc; font-weight: bold;" id="">Qutotation Value in Words: </td>
                        <td style="border-bottom:1px solid #ccc;border-top:1px solid #ccc; border-left:1px solid #ccc;font-weight: bold;" id="inWords"></td>
                                 </tr>
                                 

                        <tr>

                        </tr>
              
                        </table></tr>
<br><br>
                        <tr>
                            <table  style="border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-bottom: 1px solid #ccc; margin-top:-22px; width:100%;">
                                <tr >
                                    <td style="border-bottom:1px solid #ccc; font-weight: bold;border-top:1px solid #ccc;border-right:1px solid #ccc;width:50%;text-align:center;" id="">Terms and Conditions</td>
                                    <td style="border-bottom:1px solid #ccc; border-top:1px solid #ccc;width:50%;border-right:1px solid #ccc;" id="">Our Bank Name : </td>
                                </tr>
                                <tr >
                                    <td style="border-bottom:1px solid #ccc; border-top:1px solid #ccc;width:50%;border-right:1px solid #ccc;" id="">1. Goods once sold cannot be taken back </td>
                                    <td style="border-bottom:1px solid #ccc; border-top:1px solid #ccc;width:50%;" id="">Branch : </td>
                                </tr>
                                <tr >
                                    <td style="border-bottom:1px solid #ccc; border-top:1px solid #ccc;width:50%;border-right:1px solid #ccc;" id="">2. Your payment for our supply is accepted only by way of DD/ RTGS/ NEFT</td>
                                    <td style="border-bottom:1px solid #ccc; border-top:1px solid #ccc;width:50%;" id="">Account No : </td>
                                </tr>
                                <tr >
                                    <td style="border-bottom:1px solid #ccc; border-top:1px solid #ccc;width:50%;border-right:1px solid #ccc;" id="">Cheque favouring </td>
                                    <td style="border-bottom:1px solid #ccc; border-top:1px solid #ccc;width:50%;" id="">IFSC Code </td>
                                </tr>
                                <tr >
                                    <td style=" border-top:1px solid #ccc;width:50%;border-right:1px solid #ccc;" id="">3. Interest @ 18% will be charged if payment is not made within assured time</td>
                                    <!-- <td style="border-bottom:1px solid #ccc; border-top:1px solid #ccc;width:50%;" id=""></td> -->
                                </tr>
                                <tr >
                                    <td style=" border-top:1px solid #ccc;width:50%;border-right:1px solid #ccc;" id="">4. Dispute, if any, arising from the deal are subject to chennai jurisdiction only</td>
                                    <!-- <td style="border-bottom:1px solid #ccc; border-top:1px solid #ccc;width:50%;" id=""></td> -->
                                </tr>
                            </table>
                        </tr>
                    </table>
                    </tr>
                    <br><br>
                    <tr>

                        <table style="border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-bottom: 1px solid #ccc; margin-top:-22px; width:100%;">
                            <tr style="margin:10px;">
                                <td style="border: 1px solid #ccc;width:50%;text-align:top;"><p style="text-align: center">Received material as mentioned above in good condition.</p><p style="margin-top: 85px;text-align: center">Buyer signature with rubber</p></td>
                                <td style="border: 1px solid #ccc;width:50%;text-align:top;"><p style="text-align: center"></p><p style="margin-top: 85px;text-align: center">Authorized signature</p></td>
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

document.getElementById("inWords").textContent = word;



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
