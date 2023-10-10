<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body style="border: 1px solid #ccc;">
    <div class="row" id="printdiv" style="border: 1px solid #ccc;">
        <div class="col-12" >
            <div class="card">
                <div class="card-body" style="border: 1px solid #ccc;>
                    <div class="invoice" style="width: 800px; margin: 0 auto; padding: 20px; border: 0px solid #ccc;">
                        <div class="logo">
                            <img src="<?= base_url('assets/images/logo.jpg') ?>" alt="Logo" style="width: 170px;height:130px;">
                            <span>
                            <h1 style="text-align: right; margin-top: 0;">Credit Note</h1>
                            </span>
                        </div>
                        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; border-left: 1px solid #ccc;border-right: 1px solid #ccc;border-top: 1px solid #ccc;">
                        <tr style="width: 100%; height: 170px;">
                        <td style="width: 50%;border-right: 1px solid #ccc;">
                            <table style="width: 100%; height:170px;">
                             
                                <tr>
                                    <td><h4 style="text-align: left;padding-left:7px;">Bill To : </h4>
                                  <p style="text-align: left;padding-left:11px;"><?= $result['company_name'] ?><br>
                                  <?=$result['customer_address_1'] ?><br>
                                  <?=$result['customer_city'] ?><br>
                                  <?= $result['name'].'-'.$result['customer_pincode']?><br> India.</p>
                                </td>
                                    <td>
                                      <!-- <p style="text-align: left;margin-left:7px;"><?= $company['company_name'].', '.$company['company_address'].', '.$company['city'].', '.$company['state'].'-'.$company['pincode'].', India.' ?></p> -->
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 50%;">
                            <table style="width: 100%; ">
                                <tr>
                                    <!-- <td  style="border-bottom: 1px solid #ccc;padding-left:7px;"><p style="text-align: left;"><?= date('d-m-y') ?></p></td> -->
                                    <!-- <td  style="border-bottom: 1px solid #ccc;"><p style="text-align: left;"><?= $company['quotation_starting_number'].$quotation['qId'] ?></p></td> -->
                                </tr>
                                <tr>
                                    <td  style="padding-left:7px;"><p style="text-align: left;"><?= date('d-m-y') ?></p></td>
                                    <!-- <td  style="border-bottom: 1px solid #ccc;"><p style="text-align: left;"><?= date('d-m-y') ?></p></td> -->
                                </tr>
                                <tr>
                                    <!-- <td  style="border-bottom: 1px solid #ccc;padding-left:7px;"><p style="text-align: left;margin-right:10px;">Whether the tax is payable on reverse charge basis:</p></td> -->
                                    <td  style=""><h5 style="text-align: right;">Total ₹<?= $result['credit_amount'] ?></h5></td>
                                </tr>
                           
                            </table>
                        </td>
                    </tr>
                    <tr style="border-top: 1px solid #ccc; height: 30px; width:100%;border-left: 1px solid #ccc;">
                        <td style=" width:50%;"><p style="text-align:left;font-weight: bold;padding-left:7px;padding:5px;";>PO # : &nbsp;&nbsp; <?= $result['po_number'] ?></p>
                        <!-- <p style="text-align:left;padding-left:12px;";><?= $result['po_number'] ?></p> -->
                      </td>
                        <td style="width:50%;border-left: 1px solid #ccc;"><p style="text-align:left;font-weight: bold;padding:5px;";>Shipping Method</p></td>
                    </tr>
                  
                    <tr>
                    <table style="width: 100%; border-collapse: collapse; margin-top:-18px; ">
 
                    <thead style="width:100%;">
                        <tr style="border-top:1px solid #ccc;border-left:1px solid #ccc;  width:100%;">
                            <th style=""><center>Quantity</center></th>
                            <th style="border: 1px solid #ccc;"><center>Item</center></th>
                            <th style="border: 1px solid #ccc;"><center>Options</center></th>
                            <th style="border: 1px solid #ccc;"><center>Rate</center></th>
                            <th style="border: 1px solid #ccc;"><center>Amount</center></th>
                            <th style="border: 1px solid #ccc;"><center>Tax Rate</center></th>
                            <th style="border: 1px solid #ccc;"><center>Tax Amount</center></th>
                            <th style="border: 1px solid #ccc;"><center>Gross Amount</center></th>
                        </tr>
                    </thead>
                    <tbody style="">
                       <?php $amount=0;
                              
                        $taxAmount=$amount * 18/100; 
                         $grossAmount=$amount + $taxAmount; ?>
                       <?php foreach ($products as $pro){ 
                             $amount += $pro->sale_price; 
                             $grandTotal += $pro->tottalamt;
                        ?>
                            <tr style="border: 1px solid #ccc;" >
                                <td style="padding:5px;margin-left:10px;text-align:center;"><?= number_format($pro->received_qty,2) ?></td>
                                <td style="border: 1px solid #ccc;padding:5px;text-align:center;"><?= $pro->product_name ?></td>
                                <td style="border: 1px solid #ccc;padding:5px;text-align:center;"></td>
                                <td style="border: 1px solid #ccc;padding:5px;text-align:right;">₹ <?= number_format($pro->price,2) ?></td>
                                <td style="border: 1px solid #ccc;padding:5px;text-align:right;"><?= number_format($pro->sale_price,2) ?></td>
                                <td style="border: 1px solid #ccc;padding:5px;text-align:center;">18%</td>
                                <td style="border: 1px solid #ccc;padding:5px;text-align:right;">₹ <?= number_format($pro->tax,2) ?></td>
                                <td style="border: 1px solid #ccc;padding:5px;text-align:right;">₹ <?= number_format($pro->tottalamt,2) ?></td>
                            </tr>
                            <?php } ?>

                    </tbody>
                    <tfoot style="">
                    <td rowspan="7" colspan="7">
                        <!-- <p style="margin-left:10px;font-weight: bold;">Bank Details:</p>
                        <p style="margin-left:10px;">Bank Name : <?= $company['bank_name'] ?></p>
                        <p style="margin-left:10px;">Account Number : <?= $company['bank_account_no'] ?></p>
                        <p style="margin-left:10px;">IFSC Code : <?= $company['bank_ifsc'] ?></p>
                        <p style="margin-left:10px;">Bank Address : <?= $company['bank_address'] ?></p> -->

                    </td>
                    <!-- <tr style="border: 1px solid #ccc;">
                            <td style="border: 1px solid #ccc; padding-right:30px;" colspan="4" align="right">Sub Total</td>
                            <td style="border: 1px solid #ccc;padding-left:50px; ">₹ <?= $quotation['sub_total'] ?></td>
                        </tr>
                        <tr style="border: 1px solid #ccc; ">
                            <td  style="border: 1px solid #ccc;padding-right:30px; " colspan="4" align="right">SGST (9%)</td>
                            <td style="border: 1px solid #ccc;padding-left:50px;">₹ <?= $quotation['sgst'] ?></td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="border: 1px solid #ccc; padding-right:30px;" colspan="4" align="right">CGST (9%)</td>
                            <td style="border: 1px solid #ccc;padding-left:50px;">₹ <?= $quotation['cgst'] ?></td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="border: 1px solid #ccc; padding-right:30px;" colspan="4" align="right">IGST (18%)</td>
                            <td style="border: 1px solid #ccc;padding-left:50px;">₹ <?= number_format($quotation['cgst'] + $quotation['sgst'],2) ?></td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="border: 1px solid #ccc; padding-right:30px;" colspan="4" align="right">TCS (0.1%)</td>
                            <td style="border: 1px solid #ccc;padding-left:50px;">₹ </td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="border: 1px solid #ccc; padding-right:30px;" colspan="4" align="right">TOTAL TAX</td>
                            <td style="border: 1px solid #ccc;padding-left:50px;">₹ <?= number_format($quotation['cgst'] + $quotation['sgst'],2) ?></td>
                        </tr> -->
                    </tfoot>
                    </table>
                    </tr>
                    <tr >

                    <br> <br>
          <table style="width: 75%; border-collapse: collapse; margin-top:5px; ">
          <thead style="width:100%;">
              <tr style="border: 1px solid #ccc; width:100%;">
                  <th style="border: 1px solid #ccc;"><center>Tax Type</center></th>
                  <th style="border: 1px solid #ccc;"><center>Tax code</center></th>
                  <th style="border: 1px solid #ccc;"><center>Tax Basis</center></th>
                  <th style="border: 1px solid #ccc;"><center>Tax Rate</center></th>
                  <th style="border: 1px solid #ccc;"><center>Tax Amount</center></th>
              </tr>
          </thead>
          
          <tbody style="border: 1px solid #ccc;">
          <?php
          $amount = 0;
           foreach ($products as $pro){ 
                
                $amount += $pro->sale_price;
                             
           } 
            $tax = $amount * 18/100;
            ?>
                  <tr style="border: 1px solid #ccc;" >
                      <td style="border: 1px solid #ccc;padding:5px;margin-left:10px;text-align:center;">CGST</td>
                      <td style="border: 1px solid #ccc;padding:5px;text-align:center;">CGST</td>
                      <td style="border: 1px solid #ccc;padding:5px;text-align:right;">₹ <?= number_format($amount,2) ?></td>
                      <td style="border: 1px solid #ccc;padding:5px;text-align:center;">9%</td>
                      <td style="border: 1px solid #ccc;padding:5px;text-align:right;">₹ <?= number_format($amount * 9/100 ,2)?></td>
                  </tr>
                
                  <tr style="border: 1px solid #ccc;" >
                      <td style="border: 1px solid #ccc;padding:5px;margin-left:10px;text-align:center;">SGST</td>
                      <td style="border: 1px solid #ccc;padding:5px;text-align:center;">SGST</td>
                      <td style="border: 1px solid #ccc;padding:5px;text-align:right;">₹ <?= number_format($amount,2) ?></td>
                      <td style="border: 1px solid #ccc;padding:5px;text-align:center;">9%</td>
                      <td style="border: 1px solid #ccc;padding:5px;text-align:right;">₹ <?= number_format($amount * 9/100,2) ?></td>
                  </tr>
                  <tr >
                  <td colspan="4"></td>
                  <th>Total : ₹<?= number_format($tax,2) ?></th>
                  </tr>

          </tbody>
          </table>


          <br><br>
                    <table  style="  margin-top:-22px; width:100%;padding:3px;">
                        <tr>    
                            <td style="width: 75%;"></td >
                            <td style="border-bottom:1px solid #ccc;border-top:1px solid #ccc;border-right:1px solid  #ccc; border-left:1px solid #ccc;text-align: right; text-style:bold;"><H6>TAX : <span style="font-weight: bold;">₹ <?= number_format($tax,2) ?></span> </H6></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="border-bottom:1px solid #ccc; border-left:1px solid #ccc;border-right:1px solid  #ccc; text-align: right; text-style:bold;"><H6>TOTAL : <span style="font-weight: bold;">₹ <?= number_format($grandTotal,2) ?></span> </H6></td>
                        </tr>
                        <!--  -->
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
      alert('jhvd')
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
</html>