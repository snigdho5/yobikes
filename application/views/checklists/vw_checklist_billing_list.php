<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $this->load->view('top_css'); ?>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'common/assets/extra-libs/multicheck/multicheck.css'; ?>">
    <link href="<?php echo base_url() . 'common/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css'; ?>" rel="stylesheet">
    <title><?php echo comp_name; ?> | <?php echo $page_title; ?></title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <?php //$this->load->view('header_main'); 
        ?>
        <!-- End Topbar header -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <?php //$this->load->view('sidebar_main'); 
        ?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="margin-left: 0px;">
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"><?php echo $page_title; ?> </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?> </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <?php
                            if (isset($update_success) && $update_success != '') {
                                echo "<p><i class=\"icofont-tick-boxed\" style=\"color:green\"></i> Status: " . $update_success . "</p>";
                            } elseif (isset($update_failure) && $update_failure != '') {
                                echo "<p><i class=\"fas fa-exclamation-triangle\" style=\"color:yellow\"></i> Error: " . $update_failure . "</p>";
                            } else {
                                //echo "<p style='color:#f5f2f0'><i class=\"fas fa-exclamation-triangle\" style=\"color:yellow\"></i> Something went wrong!</p>";
                            }
                            ?>

                            <div class="table-responsive">

                                <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>save-checklist" id="create_form" autocomplete="off">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="textcen">
                                                <th>Sl</th>
                                                <th>Company</th>
                                                <th>Segment</th>
                                                <th>Cycle Name</th>
                                                <th>Color</th>
                                                <th style="width:100px;">Quantity</th>
                                                <th style="width:100px;">Carton</th>
                                                <th style="width:100px;">Tyre</th>
                                                <th style="width:100px;">Rim</th>
                                                <th style="width:100px;">Busket</th>
                                                <th style="width:100px;">Frame</th>
                                                <th style="width:100px;">Mudguard</th>
                                                <th style="width:100px;">Sit</th>
                                                <th style="width:100px;">Handle</th>
                                                <th style="width:100px;">Carrier</th>
                                            </tr>
                                        </thead>
                                        <tbody class="textcen">
                                            <?php
                                            for ($sl = 1; $sl <= 20; $sl++) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $sl; ?></td>
                                                    <td>
                                                        <select class="select2 form-control custom-select comp_id" style="width: 100%; height:36px;" id="comp_id_<?php echo $sl; ?>" name="comp_id_<?php echo $sl; ?>" <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                            <option value="">Select</option>
                                                            <?php
                                                            if (!empty($comp_data)) {
                                                                foreach ($comp_data as $key => $value) {
                                                            ?>
                                                                    <option value="<?php echo $value['compid']; ?>"><?php echo $value['name']; ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <select class="select2 form-control custom-select seg_id" style="width: 100%; height:36px;" data-rowid="<?php echo $sl; ?>" id="seg_id_<?php echo $sl; ?>" name="seg_id_<?php echo $sl; ?>" <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                            <option value="">Select</option>
                                                            <?php
                                                            if (!empty($seg_data)) {
                                                                foreach ($seg_data as $key => $value) {
                                                            ?>
                                                                    <option value="<?php echo $value['segid']; ?>"><?php echo $value['name']; ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>

                                                        </select>
                                                    </td>

                                                    <td>
                                                        <select class="select2 form-control custom-select cycleid" style="width: 100%; height:36px;" id="cycleid_<?php echo $sl; ?>" name="cycleid_<?php echo $sl; ?>" data-rowid="<?php echo $sl; ?>" <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                            <option value="">Select</option>
                                                        </select>
                                                    </td>

                                                    <td style="min-width:100px;">
                                                        <select class="select2 form-control custom-select color" style="width: 100%; height:36px;" id="color_<?php echo $sl; ?>" name="color_<?php echo $sl; ?>" <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                            <option value="">Select</option>
                                                        </select>
                                                    </td>

                                                    <td style="min-width:100px;">
                                                        <input type="number" class="form-control quantity" id="quantity_<?php echo $sl; ?>" name="quantity_<?php echo $sl; ?>" data-qtyid="<?php echo $sl; ?>" placeholder="0" value="0" autocomplete="off" <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                    </td>

                                                    <td style="min-width:100px;">
                                                        <input type="number" class="form-control" id="carton_<?php echo $sl; ?>" name="carton_<?php echo $sl; ?>" placeholder="Carton.." value="0" autocomplete="off" readonly <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                    </td>

                                                    <td style="min-width:100px;">
                                                        <input type="number" class="form-control" id="tyre_<?php echo $sl; ?>" name="tyre_<?php echo $sl; ?>" placeholder="0" value="0" autocomplete="off" readonly <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                    </td>

                                                    <td style="min-width:100px;">
                                                        <input type="number" class="form-control" id="rim_<?php echo $sl; ?>" name="rim_<?php echo $sl; ?>" placeholder="0" value="0" autocomplete="off" readonly <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                    </td>

                                                    <td style="min-width:100px;">
                                                        <input type="number" class="form-control" id="busket_<?php echo $sl; ?>" name="busket_<?php echo $sl; ?>" placeholder="Busket.." value="0" autocomplete="off" readonly <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                    </td>

                                                    <td style="min-width:100px;">
                                                        <input type="number" class="form-control" id="frame_<?php echo $sl; ?>" name="frame_<?php echo $sl; ?>" placeholder="Frame.." value="0" autocomplete="off" readonly <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                    </td>

                                                    <td style="min-width:100px;">
                                                        <input type="number" class="form-control" id="mudguard_<?php echo $sl; ?>" name="mudguard_<?php echo $sl; ?>" placeholder="Mudguard (Pair).." autocomplete="off" readonly value="0" <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                    </td>

                                                    <td style="min-width:100px;">
                                                        <input type="number" class="form-control" id="sit_<?php echo $sl; ?>" name="sit_<?php echo $sl; ?>" placeholder="Sit.." value="0" autocomplete="off" readonly <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                    </td>

                                                    <td style="min-width:100px;">
                                                        <input type="number" class="form-control" id="handle_<?php echo $sl; ?>" name="handle_<?php echo $sl; ?>" value="0" placeholder="Handle.." autocomplete="off" readonly <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                    </td>

                                                    <td style="min-width:100px;">
                                                        <input type="number" class="form-control" id="carrier_<?php echo $sl; ?>" name="carrier_<?php echo $sl; ?>" value="0" placeholder="Carrier.." autocomplete="off" readonly <?php echo ($sl == 1) ? 'required' : ''; ?>>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                            <tr>
                                                <td colspan="3">
                                                    <h4>Total Quantity:</h4>
                                                </td>

                                                <td><button type="button" class="btn badge-success get-total">Total</button></td>

                                                <td>--</td>
                                                
                                                <td>
                                                    <input type="hidden" class="form-control" id="sl_count" name="sl_count" value="0" required>
                                                    <input type="number" class="form-control" id="total_quantity" name="total_quantity" value="0" placeholder="Total Qty" autocomplete="off" readonly required>
                                                </td>


                                                <td><input type="number" class="form-control" id="total_quantity_carton" name="total_quantity_carton" value="0" placeholder="Total Qty" autocomplete="off" readonly required></td>

                                                <td><input type="number" class="form-control" id="total_quantity_tyre" name="total_quantity_tyre" value="0" placeholder="Total Qty" autocomplete="off" readonly required></td>

                                                <td><input type="number" class="form-control" id="total_quantity_rim" name="total_quantity_rim" value="0" placeholder="Total Qty" autocomplete="off" readonly required></td>

                                                <td><input type="number" class="form-control" id="total_quantity_busket" name="total_quantity_busket" value="0" placeholder="Total Qty" autocomplete="off" readonly required></td>

                                                <td><input type="number" class="form-control" id="total_quantity_frame" name="total_quantity_frame" value="0" placeholder="Total Qty" autocomplete="off" readonly required></td>

                                                <td><input type="number" class="form-control" id="total_quantity_mudguard" name="total_quantity_mudguard" value="0" placeholder="Total Qty" autocomplete="off" readonly required></td>

                                                <td><input type="number" class="form-control" id="total_quantity_sit" name="total_quantity_sit" value="0" placeholder="Total Qty" autocomplete="off" readonly required></td>

                                                <td><input type="number" class="form-control" id="total_quantity_handle" name="total_quantity_handle" value="0" placeholder="Total Qty" autocomplete="off" readonly required></td>

                                                <td><input type="number" class="form-control" id="total_quantity_carrier" name="total_quantity_carrier" value="0" placeholder="Total Qty" autocomplete="off" readonly required></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="2"><input type="text" class="form-control" id="cust_name" name="cust_name" placeholder="Name" autocomplete="off" required></td>
                                                <td colspan="2"><input type="text" class="form-control" id="cust_address" name="cust_address" placeholder="Address" autocomplete="off" required></td>
                                                <td colspan="2"><input type="number" class="form-control" id="cust_phone" name="cust_phone" placeholder="Phone" autocomplete="off" required></td>
                                                <td colspan="8"><button type="submit" class="btn badge-primary formsubmit">Submit</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php //$this->load->view('footer'); 
            ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <?php $this->load->view('bottom_js'); ?>
    <!-- this page js -->
    <script src="<?php echo base_url() . 'common/assets/extra-libs/multicheck/datatable-checkbox-init.js'; ?>"></script>
    <script src="<?php echo base_url() . 'common/assets/extra-libs/multicheck/jquery.multicheck.js'; ?>"></script>
    <script src="<?php echo base_url() . 'common/assets/extra-libs/DataTables/datatables.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'common/dist/js/app/checklist_billing.js?v=' . random_strings(6); ?>"></script>

</body>

</html>