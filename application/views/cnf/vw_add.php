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
									<h4 class="card-title">Create New <?php echo $page_title; ?> <button type="button" class="btn badge badge-pill badge-success" onclick="location.href='<?php echo base_url() . 'cnf/list'; ?>'"><?php echo $page_title; ?>s List</button></h4>

									<div class="form-group row">
										<label for="name" class="col-sm-2 text-right control-label col-form-label">Name</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="name" name="name" placeholder="Name.." autocomplete="off">
										</div>

										<label for="et_invoice_no" class="col-sm-2 text-right control-label col-form-label">ET Invoice No</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="et_invoice_no" name="et_invoice_no" placeholder="ET Invoice No.." autocomplete="off">
										</div>
									</div>

									<div class="form-group row">
										<label for="et_invoice_date" class="col-sm-2 text-right control-label col-form-label">ET Invoice Date</label>
										<div class="col-sm-4">
											<input type="date" class="form-control" id="et_invoice_date" name="et_invoice_date" placeholder="ET Invoice Date.." autocomplete="off">
										</div>

										<label for="model" class="col-sm-2 text-right control-label col-form-label">Model Type</label>
										<div class="col-sm-4">
											<select class="form-control" style="width: 100%; height:36px;" id="model" name="model">
												<option value="">Select</option>
												<option value="vrla">VRLA</option>
												<option value="li">LI</option>
												<option value="dli">D-Li</option>
											</select>
										</div>
									</div>

									<div class="form-group row">
										<label for="color" class="col-sm-2 text-right control-label col-form-label">Color</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="color" name="color" placeholder="Color.." autocomplete="off">
										</div>

										<label for="vin_no" class="col-sm-2 text-right control-label col-form-label">VIN No</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="vin_no" name="vin_no" placeholder="VIN No.." autocomplete="off">
											<label id="chk_name" style="display: none;"></label>
										</div>
									</div>

									<div class="form-group row">
										<label for="motor_no" class="col-sm-2 text-right control-label col-form-label">Motor No</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="motor_no" name="motor_no" placeholder="Motor No.." autocomplete="off">
										</div>

										<label for="converter_no" class="col-sm-2 text-right control-label col-form-label">Converter No</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="converter_no" name="converter_no" placeholder="Converter No.." autocomplete="off">
										</div>
									</div>

									<div class="form-group row">
										<label for="controller_no" class="col-sm-2 text-right control-label col-form-label">Controller No</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="controller_no" name="controller_no" placeholder="Controller No.." autocomplete="off">
										</div>

										<label for="charger_no" class="col-sm-2 text-right control-label col-form-label">Charger No</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="charger_no" name="charger_no" placeholder="Charger No.." autocomplete="off">
										</div>
									</div>

									<div class="form-group row">
										<label for="battery_sl1" class="col-sm-2 text-right control-label col-form-label">Battery Sl 1</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="battery_sl1" name="battery_sl1" placeholder="Battery Sl 1.." autocomplete="off">
										</div>

										<label for="battery_sl2" class="col-sm-2 text-right control-label col-form-label">Battery Sl 2</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="battery_sl2" name="battery_sl2" placeholder="Battery Sl 2.." autocomplete="off">
										</div>
									</div>


									<div class="form-group row">
										<label for="battery_sl3" class="col-sm-2 text-right control-label col-form-label">Battery Sl 3</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="battery_sl3" name="battery_sl3" placeholder="Battery Sl 3.." autocomplete="off">
										</div>

										<label for="battery_sl4" class="col-sm-2 text-right control-label col-form-label">Battery Sl 4</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="battery_sl4" name="battery_sl4" placeholder="Battery Sl 4.." autocomplete="off">
										</div>
									</div>

									<div class="form-group row">
										<label for="battery_sl5" class="col-sm-2 text-right control-label col-form-label">Battery Sl 5</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="battery_sl5" name="battery_sl5" placeholder="Battery Sl 5.." autocomplete="off">
										</div>

										<label for="battery_sl6" class="col-sm-2 text-right control-label col-form-label">Battery Sl 6</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="battery_sl6" name="battery_sl6" placeholder="Battery Sl 6.." autocomplete="off">
										</div>
									</div>

									<?php
									if ($this->session->userdata('usergroup') == 1) {
									?>
										<div class="form-group row">
											<label for="created_user" class="col-sm-2 text-right control-label col-form-label">Select CNF</label>
											<div class="col-sm-4">
												<select class="form-control" style="width: 100%; height:36px;" id="created_user" name="created_user">
													<option value="">Select</option>
													<?php
													if (!empty($user_data)) {
														$sl = 1;
														foreach ($user_data as $key => $val) {
													?>
															<option value="<?php echo $val['userid']; ?>"><?php echo $val['fullname']; ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>

											<label for="manual_no" class="col-sm-2 text-right control-label col-form-label">Manual No</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="manual_no" name="manual_no" placeholder="Manual No.." autocomplete="off">
											</div>
										</div>
									<?php
									}
									?>
								</div>
								<div class="border-top">
									<div class="card-body">
										<button type="submit" id="company_btn_submit" class="btn btn-primary btn_submit">Submit</button>
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
	<script src="<?php echo base_url() . 'common/dist/js/app/cnf.js?v=' . random_strings(6); ?>"></script>

</body>

</html>