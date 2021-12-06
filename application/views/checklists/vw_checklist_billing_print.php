<!DOCTYPE html>
<html>

<head>
    <title>Soor | Receipt</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'common/assets/images/favicon.png'; ?>">
    <!--<style type="text/css" media="print">
  @page { 
        size: landscape;
    }
    body { 
        writing-mode: tb-rl;
    }
</style>-->
</head>

<body style="font-size: 15px; text-align:center; margin-left: auto; margin-right: auto;">
    <!-- <center> -->

        <div style="border: 2px solid gray; border-radius: 8px; width: auto;">
            <?php if (!empty($billing_data)) { ?>

                <a onClick="window.print();return false" style="border-style: groove;">Print</a><br><br>
                <span>Date: <?php echo $billing_data[0]['dtime']; ?> &middot; Bill No: <?php echo $billing_data[0]['bill_no']; ?></span><br>
                <h2 style="margin:0;">Soor ~ O ~ Sathi</h2>
                <b>Tetultala More, Barui Para</b> &middot; <b>Kalna</b> &middot; <b>Purba Bardhaman</b> <br>
                <!-- Licence No.- <?php //echo licence_no; ?> &middot; Dt.- <?php //echo licence_date; ?><br>
                Estd.: 2009 &middot; Mobile: <?php //echo bill_phone_no; ?><br> -->
                &middot; Pin - 713409 &middot;
            <?php } else {
            } ?>
            <br><br>

            <table cellspacing="0" cellpadding="3" border="1" style="text-align:center; width: auto; margin-left: auto; margin-right: auto;">

                <thead>
                    <?php if (!empty($billing_data)) { ?>

                        <tr class="textcen">
                            <th scope="col" colspan="15">Final Packaging List</th>
                        </tr>

                        <tr class="textcen">
                            <th scope="col" colspan="6">Name: <?php echo $billing_data[0]['cust_name']; ?></th>
                            <th scope="col" colspan="9">Address: <?php echo $billing_data[0]['cust_address']; ?></th>
                            <!-- <th scope="col" colspan="3">Phone: <?php echo $billing_data[0]['cust_phone']; ?></th> -->
                        </tr>

                    <?php } else { ?>
                        <th colspan="15"><button type="button" class="btn badge badge-pill badge-success" onclick="location.href='<?php echo base_url() . 'checklist-billing'; ?>'">Billing</button></th>
                    <?php } ?>
                    <tr class="textcen">
                        <th>Sl</th>
                        <th>Company</th>
                        <th>Segment</th>
                        <th>Cycle Name</th>
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Carton</th>
                        <th>Tyre</th>
                        <th>Rim (Pair)</th>
                        <th>Busket</th>
                        <th>Frame</th>
                        <th>Mudguard (Pair)</th>
                        <th>Sit</th>
                        <th>Handle</th>
                        <th>Carrier</th>

                    </tr>
                </thead>
                <tbody class="textcen">
                    <?php
                    if (!empty($billing_data)) {
                        //print_obj($inv_data);die;
                        $sl = 1;
                        foreach ($billing_data as $key => $val) {
                    ?>
                            <tr style="text-align:center;">
                                <td><?php echo $sl; ?></td>
                                <td><?php echo $val['compname']; ?></td>
                                <td><?php echo $val['segname']; ?></td>
                                <td><?php echo $val['cyclename']; ?></td>
                                <td><?php echo $val['color']; ?></td>
                                <td><?php echo $val['quantity']; ?></td>
                                <td><?php echo $val['carton']; ?></td>
                                <td><?php echo $val['tyre']; ?></td>
                                <td><?php echo $val['rim']; ?></td>
                                <td><?php echo $val['busket']; ?></td>
                                <td><?php echo $val['frame']; ?></td>
                                <td><?php echo $val['mudguard']; ?></td>
                                <td><?php echo $val['sit']; ?></td>
                                <td><?php echo $val['handle']; ?></td>
                                <td><?php echo $val['carrier']; ?></td>
                            </tr>
                        <?php
                            $sl++;
                        }
                        ?>

                        <tr>
                            <td colspan="4">
                                <h4>Total Quantity:</h4>
                            </td>


                            <td>--</td>
                            <td><?php echo $billing_data[0]['total_quantity']; ?></td>
                            <td><?php echo $billing_data[0]['total_quantity_carton']; ?></td>
                            <td><?php echo $billing_data[0]['total_quantity_tyre']; ?></td>
                            <td><?php echo $billing_data[0]['total_quantity_rim']; ?></td>
                            <td><?php echo $billing_data[0]['total_quantity_busket']; ?></td>
                            <td><?php echo $billing_data[0]['total_quantity_frame']; ?></td>
                            <td><?php echo $billing_data[0]['total_quantity_mudguard']; ?></td>
                            <td><?php echo $billing_data[0]['total_quantity_sit']; ?></td>
                            <td><?php echo $billing_data[0]['total_quantity_handle']; ?></td>
                            <td><?php echo $billing_data[0]['total_quantity_carrier']; ?></td>

                            
                        </tr>
                    <?php
                    } else {
                    ?>
                        <tr>
                            <td colspan="15">No data found</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>

            </table>
            <br /> <small style="text-align:center;">This is computer generated, signature is not required.</small>
        </div>
    <!-- </center> -->
</body>

</html>