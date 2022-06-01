<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo comp_name; ?> | <?php echo $page_title; ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="https://etbilling.in/common/assets/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@200;300;400;500;700&display=swap" rel="stylesheet">
    <style type="text/css">
        .print {
            width: 140px;
            height: 35px;
            line-height: 32px;
            text-align: center;
            border: none;
            border-radius: 20px;
            background: #f60;
            margin-bottom: 20px;
            cursor: pointer;
            color: #fff;
            font-family: 'Muli', sans-serif;
        }
    </style>


    <script>
        function printDiv() {
            var divContents = document.getElementById("panel").innerHTML;
            var a = window.open('', '', 'height=800, width=800');
            a.document.write('<html>');
            a.document.write('<body > <br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>



</head>

<body>

    <div onclick="printDiv()" class="print">Print Invoice</div>


    <div id="panel">
        <table style="border:1px solid #999999;" width="100%" border="0" cellpadding="0" cellspacing="0" class="tb">
            <tbody>
                <tr>
                    <td height="35" colspan="4" align="center" class="txt" style="border-bottom:1px solid #ddd; color:#d04e00; font-weight:800; font-family: 'Muli', sans-serif;">Retail / Tax Invoice Cum ChalIan</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody style="text-align:center;">
                                <!-- <tr>
                                    <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">ORIGINAL FOR BUYER/ DUPLICATE FOR TRANSPORTER/ OFF. RECORD</td>
                                </tr> -->
                                <tr>
                                    <td height="49" valign="bottom" style=" font-size:20px; color:#d04e00; font-weight:800; font-family: 'Muli', sans-serif;"><?php echo (isset($billingdata) && !empty($billingdata)) ? strtoupper($billingdata[0]['dealer_full_name']) : 'NA'; ?></td>
                                </tr>
                                <tr>
                                    <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">AUTHORISED YO BYKE SALES & SERVICE</td>
                                </tr>
                                <tr>
                                    <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Address: <?php echo (isset($billingdata) && !empty($billingdata)) ? $billingdata[0]['dealer_address'] : 'NA'; ?></td>
                                </tr>
                                <tr>
                                    <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Phone: <?php echo (isset($billingdata) && !empty($billingdata)) ? $billingdata[0]['dealer_phone'] : 'NA'; ?>. GSTIN: <?php echo (isset($billingdata) && !empty($billingdata)) ? $billingdata[0]['dealer_gst'] : 'NA'; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td height="36" colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td width="3%">&nbsp;</td>
                    <td colspan="2">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb1">
                            <tbody>
                                <tr>
                                    <td>
                                        <table style="border:1px solid #999999;" width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td width="16%" height="25"><strong><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Name</span>:</strong></td>
                                                    <td width="49%"><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;"><?php echo (isset($billingdata) && !empty($billingdata)) ? $billingdata[0]['billed_to_name'] : 'NA'; ?></span></td>
                                                    <td width="20%"><strong><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Invoice Date</span>:</strong></td>
                                                    <td width="15%"><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;"><?php echo (isset($billingdata) && !empty($billingdata)) ? $billingdata[0]['dtime'] : 'NA'; ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td height="25"><strong><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Address</span>:</strong></td>
                                                    <td><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;"><?php echo (isset($billingdata) && !empty($billingdata)) ? $billingdata[0]['billed_to_address'] : 'NA'; ?></span></td>
                                                    <td><strong><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Invoice Number</span>:</strong></td>
                                                    <td><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;"><?php echo (isset($billingdata) && !empty($billingdata)) ? $billingdata[0]['manual_billing_sl'] : 'NA'; ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td height="25"><strong><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Mobile</span>:</strong></td>
                                                    <td><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;"><?php echo (isset($billingdata) && !empty($billingdata)) ? $billingdata[0]['billed_to_phone'] : 'NA'; ?></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="31" style="border-top:1px solid #999999;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table style="border:1px solid #999999;" width="100%" border="1" cellpadding="0" cellspacing="0" class="tb2">
                                            <tbody>
                                                <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                                                    <td width="7%" height="30" align="center"><strong>S.N</strong></td>
                                                    <td width="25%" align="center"><strong>Product </strong></td>
                                                    <td width="25%" align="center"><strong>Description </strong></td>
                                                    <td width="25%" align="center"><strong>Specification </strong></td>
                                                    <td width="18%" align="center"><strong>Amount</strong></td>
                                                </tr>

                                                <?php
                                                $subtotal = 0.00;
                                                if (!empty($billingdata)) {
                                                    foreach ($billingdata as $key => $value) {
                                                ?>

                                                        <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                                                            <td height="30" align="center"><?php echo $key + 1; ?>.</td>
                                                            <td align="center">
                                                                <table style="border:1px solid #999999;" width="100%" border="1" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                        <td style="font-weight:bold;"><?php echo $value['name']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>MOT: <?php echo $value['motor_no']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>MANUAL: <?php echo $value['manual_no']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>BTN1: <?php echo $value['battery_sl1']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>BTN3: <?php echo $value['battery_sl3']; ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td align="center">
                                                                <table style="border:1px solid #999999;" width="100%" border="1" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                        <td style="font-weight:bold;">VIN: <?php echo $value['vin_no']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>CHG: <?php echo $value['name']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>CONV: <?php echo $value['converter_no']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>BTN2: <?php echo $value['battery_sl2']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>BTN4: <?php echo $value['battery_sl4']; ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td align="center">
                                                                <table style="border:1px solid #999999;" width="100%" border="1" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                        <td>&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>COLOR: <?php echo $value['color']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>CONT: <?php echo $value['controller_no']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ET Invoice: <?php echo $value['et_invoice_no']; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ET Invoice Date: <?php echo $value['et_invoice_date']; ?></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td align="center"><?php echo $value['subtotal']; ?></td>
                                                        </tr>

                                                <?php
                                                        $subtotal += $value['subtotal'];
                                                        $gst = $value['gst'];
                                                        $discount = $value['discount'];
                                                        $dtime = $value['dtime'];
                                                        $notes = $value['notes'];
                                                    }
                                                }
                                                ?>

                                                <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                                                    <td height="30" align="center">&nbsp;</td>
                                                    <td align="center">&nbsp;</td>
                                                    <td align="center">&nbsp;</td>
                                                    <td align="center"><strong>Basic Amount</strong></td>
                                                    <td align="center"><?php echo number_format((float)$subtotal, 2, '.', ''); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" border="1" cellpadding="0" cellspacing="0" class="tb2">
                                            <tbody>
                                                <?php
                                                $gst_amt = ($subtotal * $gst) / 100;
                                                $gst_per_d = ($gst / 2);
                                                $gst_amt_d = ($gst_amt / 2);

                                                if ($discount > 0) {
                                                    $grand_total = ($subtotal + $gst_amt) - $discount;
                                                } else {
                                                    $grand_total = ($subtotal + $gst_amt);
                                                }
                                                $grand_total = number_format((float)$grand_total, 2, '.', '');;
                                                ?>
                                                <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                                                    <td width="67%" height="48" colspan="2"><span style="font-weight:bolder;">Remarks:</span><br> <?php echo $notes; ?></td>
                                                    <td align="center">CGST <?php echo $gst_per_d; ?>%: <br>SGST <?php echo $gst_per_d; ?>%:</td>
                                                    <td width="13%" align="center"><?php echo number_format((float)$gst_amt_d, 2, '.', ''); ?> <br><?php echo number_format((float)$gst_amt_d, 2, '.', ''); ?></td>
                                                </tr>
                                                <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                                                    <td height="31" align="center" colspan="2" style="font-weight:bolder;">Rupees <?php echo convert_number($grand_total); ?></td>
                                                    <td align="center"><strong>Net Amount</strong></td>
                                                    <td align="center" style="font-weight:bolder;"><?php echo $grand_total; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="3%">&nbsp;</td>
                </tr>
                <!-- <tr>
                    <td colspan="4">&nbsp;</td>
                </tr> -->
                <tr>
                    <td height="6">&nbsp;</td>
                    <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;" width="47%" height="32"><strong>Date : <?php echo date('F j, Y', strtotime($dtime)); ?></strong></td>
                    <td>&nbsp;</td>
                    <!-- <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;" width="47%" align="right"><strong>For :</strong></td> -->
                    <td height="6">&nbsp;</td>
                </tr>
                <!-- <tr>
                    <td colspan="4">&nbsp;</td>
                </tr> -->
                <?php /*<tr>
                    <td height="5">&nbsp;</td>
                    <td style=" font-size:11px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                        <strong>Note:</strong><br><br>
                        1. TRANSIT DAMAGE MUST BE NOTED ON THE BILL AT THE TIME DELIVERY, DUlly SIGNED BY THE LORRY DRIVER.<br><br>
                        2. CERTIFIED THAT THE PARTICULARS GIVEN ABOVE ARE TRUE AND CORRECT AND PRICE INDICATED IS ACTUAL PRICE CHARGED AND THERE IS NO ADDITIONAL CONSIDERATION FROM THE CUSTOMER.
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>*/ ?>
                <tr>
                    <td height="40">&nbsp;</td>
                    <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;" height="32"><strong>Signature of Buyer</strong></td>
                    <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;" align="right" valign="bottom"><strong>Signature of Seller</strong></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>


</body>

</html>