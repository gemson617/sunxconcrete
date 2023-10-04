
<body>
    <div class="row" id="printdiv"><br><br>

    <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Credit bill</title>
	<!-- <link href="https://app.teamworksystem.com/agas/css/style.css" rel="stylesheet" />
	<link href="https://app.teamworksystem.com/agas/css/bootstrap.css" rel="stylesheet" /> -->

	<style>

    
        #snackbar {
          visibility: hidden;
          min-width: 250px;
          margin-left: -125px;
          background-color: #333;
          color: #fff;
          text-align: center;
          border-radius: 50px;
          padding: 10px;
          position: fixed;
          z-index: 1;
          left: 50%;
          bottom: 50px;
          font-size: 15px;
        }

        #snackbar.show {
          visibility: visible;
          -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
          animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
          from {bottom: 0; opacity: 0;}
          to {bottom: 50px; opacity: 1;}
        }

        @keyframes fadein {
          from {bottom: 0; opacity: 0;}
          to {bottom: 50px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
          from {bottom: 50px; opacity: 1;}
          to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
          from {bottom: 50px; opacity: 1;}
          to {bottom: 0; opacity: 0;}
        }
        </style>
</head>

<style>

/* Styles go here */

.page-header, .page-header-space {
  height: 230px;
}

.page-footer, .page-footer-space {
  height: 280px;

}

.page-footer {
  position: fixed;
  bottom: 0;
  width: 100%;
}

.page-header {
  position: fixed;
  top: 0px;
  width: 100%;
  padding: 10px;
}


.page {
  page-break-after: always;
}

p{
  line-height: 1.1;
  margin-bottom: 5px;
}

@page { margin: 40px; }
.page-border { position: fixed; left: 1px; top: 1px; bottom: 1px; right: 1px; border: 1px solid #000; }

@media print {
   thead {display: table-header-group;}
   tfoot {display: table-footer-group;}

   button {display: none;}

   body {margin: 0;}
}


</style>






<body style="margin:20px;padding: 1px;border: 1px solid black;background-color: #fff!important;" id="printdiv">
<h3 class=" text-center mt-3">Proforma<span> (Sales)</span></h3>
                        <div class="row page-header-space" style="padding: 30px;">
                            
                           
                            <div class="col-md-6" style="text-align: left;">
                            <img src="<?= base_url('assets/images/logo.jpg') ?>" width="180px;">
                          </div>
                         
                            <div class="col-md-6" style="text-align: right;">
                                 <h1>Credit Note</h1>
                          </div>
                       
                        </div>
                       



                    <hr class="mt-0 ">
                            <div class="row" style="padding: 30px;">
                                <div class="col-md-6">
                                    <!-- <p style="font-weight: bold;color: #000;font-size: 20px;">Supplier</p> -->

                                        <p style="font-weight: bold;font-size: 17px;">Bill To : </p>
                                        <p><?= $sold_to_party['company_name'] ?>,</p>
                                        <p style="font-size: 17px;">
                                        <p><?= $sold_to_party['customer_address_1'] ?>  </p>
                                        <p><?= $sold_to_party['customer_city']  ?>  </p>
                                        <p> <?= $sold_to_party['stateName'].'-'.$sold_to_party['customer_pincode']  ?>
                                      </p>
                                </div>


                                <div class="col-sm-6" style="text-align: right;">
                                    <!-- <div  class="row"> -->
                                      
                                        <p style="font-weight: bold;color: #000;font-size: 20px;"><?= date('d-m-y') ?></p>
                                        <p style="font-weight: bold;color: #000;font-size: 20px;">Total : ₹<?= $salesItems['sale_price'] ?></p>
                                        <br>
                                      
                                        <p style="font-size: 17px;">PH :7698799999,<br>
                                                Email : info@teamworksystem.com.<br>
                                            </p>
                                    <!-- </div> -->

                                    <!-- <div class="col-sm-6">
                                            <p style="font-size: 17px;"></p>
                                            <p style="font-size: 17px;"></p>
                                           
                                        <p style="font-size: 17px;"></p>
                                    </div> -->
                                </div>
                                </div>
                            </div>
                        </div><br>


                          <div class="row mt-10" style="padding:30px;">
							              <div class="col-125 " style="">
								             
									              
                                 
                                        <table id="datatable_purchase" class="table table" >
                                            <thead>
                                                <tr >
                                                    <th>Quantity</th>
                                                    <th>Item</th>
                                                    <th>Options</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                                                                       
                                                    <th>Tax Rate</th>
                                                    <th>Tax Amount</th>   
                                                    
                                                    <th>Gross Amount</th>
                                                </tr>
                                            </thead>
                                                                                                                                    <tbody>
                                                                                                <tr>
                                                    <td><?= $salesOrders['receivedQuantity'] ?></td>

                                                    <td><?= $salesOrders['receivedQuantity'] ?></td>
                                                    <td>68Gb Memory, 8Gb Ram</td>
                                                    <td align='right' style="padding-right: 3%;">2,000.00</td>
                                                    <td align='right' style="padding-right: 3%;">1</td>
                                                                                                        <td align='right' style="padding-right: 3%;">3</td>
                                                                                                                                                            <td align='right' style="padding-right: 5%;">60.00</td>
                                            
                                                                                                                                                            <td align='right' >2,000.00</td>
                                                                                                        
                                                </tr>
                                                                                                <tr>
                                                    <td>2</td>

                                                    <td>smartwatch-oppo-i series</td>
                                                    <td>i series 5</td>
                                                    <td align='right' style="padding-right: 3%;">300.00</td>
                                                    <td align='right' style="padding-right: 3%;">4</td>
                                                                                                        <td align='right' style="padding-right: 3%;">3</td>
                                                                                                                                                            <td align='right' style="padding-right: 5%;">36.00</td>
                                            
                                                                                                                                                            <td align='right' >1,200.00</td>
                                                                                                        
                                                </tr>
                                                                                                <!-- <tr>
                                                <th colspan="7" style="text-align:right;">Sub Total</th>
                                                  <td></td>
                                                </tr> -->
                                                                                                   
                                                                                                                                                <tr>
                                                  <th colspan="7" style="text-align:right;">Sub Total</th>
                                                  <td align='right'>3,200.00</td>
                                                </tr>
                                                                                                <tr>
                                                  <th colspan="7" style="text-align:right;">Tax</th>
                                                  <td align='right'>96.00</td>
                                                </tr>
                                                
                                                <tr>
                                                <th colspan="7" style="text-align:right;">Grand Total</th>
                                                  <td align='right'>3,296.00</td>
                                                </tr>

                                            </tbody>
                                        </table>

							              </div>
						              </div>


<footer class="page-footer-space">
          <div class="row " style="padding:30px; ">
            <div class="col-md-6">
                <p style="font-weight: bold;color: #000;font-size: 20px;">Bank Details</p>
                <p style="font-weight: bold;font-size: 17px;"> Account Holder Name :  TeamWork System</p>

                        <p style="font-weight: bold;font-size: 17px;">Bank Name :Indian bank,</p>
                        <p style="font-weight: bold;font-size: 17px;"> Account Number :  654875453654</p>
                        <p style="font-weight: bold;font-size: 17px;"> IFSC Code :  fg65547</p>
                        
                       <br>

                </p>
            </div>

            <div class="col-md-6">
              <!-- <h3>Terms &amp; Conditions</h3>

<p><strong>All Prices in Indian Rupees &amp; Subject to Additional GST @ 18%.</strong></p>

<ul>
	<li>Delivery charges applicable</li>
	<li>Deliver with in 7 days from the date of PO</li>
	<li>Payment Terms : 100% Against PO</li>
	<li>Payment in favour of TWS Teamwork System India Pvt Ltd</li>
	<li>Validity 2 days from the date of quotation</li>
</ul>

<p>&nbsp;</p> -->
              <div class="ml-10">
              <h3>Terms &amp; Conditions</h3>

<p><strong>All Prices in Indian Rupees &amp; Subject to Additional GST @ 18%.</strong></p>

<ul>
	<li>Delivery charges applicable</li>
	<li>Deliver with in 7 days from the date of PO</li>
	<li>Payment Terms : 100% Against PO</li>
	<li>Payment in favour of TWS Teamwork System India Pvt Ltd</li>
	<li>Validity 2 days from the date of quotation</li>
</ul>

<p>&nbsp;</p>
              </div>
            </div>
            <div class="col-md-12 text-center">
              <strong >Thanking you and assuring you the best of our services at all times.</strong>
            </div>
            <br><br>
</footer>

</body>





        <script type="text/javascript">

              printpage();

            function printpage() {
             var tableDiv = document.getElementById("printdiv").innerHTML;
             printContents = '';
             printContents += tableDiv;
             var originalContents = document.body.innerHTML;
             document.body.innerHTML = printContents;
             window.print();
             document.body.innerHTML = originalContents;
             }

        </script>

                <script>
					$(function(e) {
						$(".datePickerInput").datepicker({
							format: "yyyy-mm-dd",
							autoclose: true,
							orientation: "bottom",
							templates: {
								leftArrow: '<i class="icon dripicons-chevron-left"></i>',
								rightArrow: '<i class="icon dripicons-chevron-right"></i>'
							}
						});
					});
				</script>

	</body>
</html>

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
const number = ;
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
