<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<?php $this->load->view('top_css'); ?>
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'common/assets/extra-libs/multicheck/multicheck.css'; ?>">
	<link href="<?php echo base_url() . 'common/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css'; ?>" rel="stylesheet">
	<title><?php echo comp_name; ?> | Add <?php echo $page_title; ?></title>
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
		<?php $this->load->view('header_main'); ?>
		<!-- End Topbar header -->
		<!-- Left Sidebar - style you can find in sidebar.scss  -->
		<?php $this->load->view('sidebar_main'); ?>
		<!-- End Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<div class="page-wrapper">
			<!-- ============================================================== -->
			<div class="page-breadcrumb">
				<div class="row">
					<div class="col-12 d-flex no-block align-items-center">
						<h4 class="page-title">Add <?php echo $page_title; ?> </h4>
						<div class="ml-auto text-right">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add <?php echo $page_title; ?> </li>
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
							<form class="form-horizontal" id="create_form" autocomplete="off">
								<div class="card-body">
									<h4 class="card-title">Create New <?php echo $page_title; ?> <button type="button" class="btn badge badge-pill badge-success" onclick="location.href='<?php echo base_url() . 'checklists2'; ?>'"><?php echo $page_title; ?>s List</button></h4>


									<div class="form-group row">
										<label for="comp_id" class="col-sm-4 text-right control-label col-form-label">Company</label>
										<div class="col-sm-2">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="comp_id" name="comp_id" required>
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
										</div>

										<label for="seg_id" class="col-sm-4 text-right control-label col-form-label">Segment</label>
										<div class="col-sm-2">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="seg_id" name="seg_id" required>
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
										</div>
									</div>


									<div class="form-group row">
										<label for="cycleid" class="col-sm-4 text-right control-label col-form-label">Cycle Name</label>
										<div class="col-sm-2">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cycleid" name="cycleid" required>
												<option value="">Select</option>
											</select>
										</div>

										<label for="name" class="col-sm-4 text-right control-label col-form-label"><?php echo $page_title; ?> Color</label>
										<div class="col-sm-2">
											<input type="text" class="form-control" id="name" name="name" placeholder="<?php echo $page_title; ?> Color.." autocomplete="off" required>
											<label id="chk_name" style="display: none;"></label>
										</div>
									</div>

									<div class="form-group row">
										<label for="name" class="col-sm-4 text-right control-label col-form-label">Quantity (Multiple of)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity (Multiple of).." autocomplete="off" required>
										</div>

										<label for="frame_etc" class="col-sm-4 text-right control-label col-form-label">Frame, Fork, Handle (1 Pcs.)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="frame_etc" name="frame_etc" placeholder="Enter.." autocomplete="off" required>
										</div>
									</div>

									<div class="form-group row">
										<label for="mudguard_etc" class="col-sm-4 text-right control-label col-form-label">Mudguard, Mud Stay (Pair)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="mudguard_etc" name="mudguard_etc" placeholder="Enter.." autocomplete="off" required>
										</div>

										<label for="rim_etc" class="col-sm-4 text-right control-label col-form-label">Rim Tape, Tyre, Tube (Pair)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="rim_etc" name="rim_etc" placeholder="Enter.." autocomplete="off" required>
										</div>
									</div>

									<div class="form-group row">
										<label for="sit_etc" class="col-sm-4 text-right control-label col-form-label">Sit, Sit Piller, S.P. Bolt (1 Pcs.)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="sit_etc" name="sit_etc" placeholder="Enter.." autocomplete="off" required>
										</div>

										<label for="chaincover_etc" class="col-sm-4 text-right control-label col-form-label">Chaincover, C. Clip (1 Pcs.)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="chaincover_etc" name="chaincover_etc" placeholder="Enter..." autocomplete="off" required>
										</div>
									</div>


									<div class="form-group row">
										<label for="ball_racer_etc" class="col-sm-4 text-right control-label col-form-label">Ball Racer, Scrow Racer, Jum Nut (1 Set)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="ball_racer_etc" name="ball_racer_etc" placeholder="Enter.." autocomplete="off" required>
										</div>

										<label for="ch_wheel_etc" class="col-sm-4 text-right control-label col-form-label">Ch. Wheel, Crank (1 Set)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="ch_wheel_etc" name="ch_wheel_etc" placeholder="Enter.." autocomplete="off" required>
										</div>
									</div>

									<div class="form-group row">
										<label for="pedal_etc" class="col-sm-4 text-right control-label col-form-label">Rim, Pedal, Hubs (1 Pair)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="pedal_etc" name="pedal_etc" placeholder="Enter.." autocomplete="off" required>
										</div>

										<label for="chain_etc" class="col-sm-4 text-right control-label col-form-label">Chain, Free Wheel (1 Pcs.)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="chain_etc" name="chain_etc" placeholder="Enter.." autocomplete="off" required>
										</div>
									</div>

									<div class="form-group row">
										<label for="bb_axle_etc" class="col-sm-4 text-right control-label col-form-label">BB Axle, Backlight (1 Pcs.)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="bb_axle_etc" name="bb_axle_etc" placeholder="Enter.." autocomplete="off" required>
										</div>

										<label for="colter_join_etc" class="col-sm-4 text-right control-label col-form-label">Quater Pin, Chain Chabi (1 Set)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="colter_join_etc" name="colter_join_etc" placeholder="Enter.." autocomplete="off" required>
										</div>
									</div>

									
									<div class="form-group row">
										<label for="break_set_etc" class="col-sm-4 text-right control-label col-form-label">Break Set, Br. Wire Long (1 Pcs.)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="break_set_etc" name="break_set_etc" placeholder="Enter.." autocomplete="off" required>
										</div>

										<label for="busket_etc" class="col-sm-4 text-right control-label col-form-label">Dress Guard, Busket, Lambraket, B. rod (1 Set)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="total_quantity_ball_racer_etc" name="total_quantity_ball_racer_etc" placeholder="Enter.." autocomplete="off" required>
										</div>
									</div>

									<div class="form-group row">
										<label for="stand_etc" class="col-sm-4 text-right control-label col-form-label">Stand </label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="stand_etc" name="stand_etc" placeholder="Enter.." autocomplete="off" required>
										</div>

										<label for="mud_screw_etc" class="col-sm-4 text-right control-label col-form-label">Mud. Scrow (1 Set)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="mud_screw_etc" name="mud_screw_etc" placeholder="Enter.." autocomplete="off" required>
										</div>
									</div>

									<div class="form-group row">
										<label for="dress_guard_etc" class="col-sm-4 text-right control-label col-form-label">Carrier</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="dress_guard_etc" name="dress_guard_etc" placeholder="Enter.." autocomplete="off" required>
										</div>

										<label for="spock_etc" class="col-sm-4 text-right control-label col-form-label">Ball, Spoock, Nipple, Washer (1 Cycle)</label>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="spock_etc" name="spock_etc" placeholder="Enter.." autocomplete="off" required>
										</div>
									</div>
								</div>
								<div class="border-top">
									<div class="card-body">
										<button type="submit" id="btn_submit" class="btn btn-primary btn_submit">Submit</button>
									</div>
								</div>
							</form>
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
			<?php $this->load->view('footer'); ?>
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
	<script src="<?php echo base_url() . 'common/dist/js/app/checklist2.js?v=' . random_strings(6); ?>"></script>

</body>

</html>