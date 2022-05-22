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
									<h4 class="card-title">Create New <?php echo $page_title; ?> <button type="button" class="btn badge badge-pill badge-success" onclick="location.href='<?php echo base_url() . 'dealerbilling/list'; ?>'"><?php echo $page_title; ?>s List</button></h4>

									<?php
									for ($sl = 1; $sl <= 3; $sl++) {
									?>
										<div class="form-group row">
											<label for="cnf_entry_id_<?php echo $sl; ?>" class="col-sm-2 text-right control-label col-form-label"><?php echo $sl; ?>. Choose VIN</label>
											<div class="col-sm-4">
												<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cnf_entry_id_<?php echo $sl; ?>" name="cnf_entry_id_<?php echo $sl; ?>">
													<option value="">Select</option>
													<?php
													if (!empty($bike_data)) {
														foreach ($bike_data as $key => $value) {
													?>
															<option value="<?php echo $value['rwid']; ?>"><?php echo $value['name']; ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>

											<label for="amount_<?php echo $sl; ?>" class="col-sm-2 text-right control-label col-form-label">Amount</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="amount_<?php echo $sl; ?>" name="amount_<?php echo $sl; ?>" placeholder="Amount.." autocomplete="off">
											</div>

										</div>

										<div class="form-group row">
											<div class="col-sm-12">
												<hr>
											</div>
										</div>
									<?php
									}
									?>
									<div class="form-group row">
										<label for="bill_type" class="col-sm-2 text-right control-label col-form-label">Bill Type</label>
										<div class="col-sm-4">
											<select class="form-control" style="width: 100%; height:36px;" id="bill_type" name="bill_type">
												<option value="customer">Customer</option>
												<option value="subdealer">Sub Dealer</option>
											</select>
										</div>

										<label for="billed_to_phone" class="col-sm-2 text-right control-label col-form-label text-phone">Customer Phone</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="billed_to_phone" name="billed_to_phone" placeholder="Phone.." autocomplete="off">
										</div>
									</div>

									<div class="form-group row">
										<label for="billed_to_name" class="col-sm-2 text-right control-label col-form-label text-name">Customer Name</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" id="billed_to_name" name="billed_to_name" placeholder="Name.." autocomplete="off">
										</div>

										<label for="billed_to_address" class="col-sm-2 text-right control-label col-form-label text-address">Customer Address</label>
										<div class="col-sm-4">
											<textarea class="form-control" id="billed_to_address" name="billed_to_address" placeholder="Address.." autocomplete="off"></textarea>
										</div>
									</div>

									<div class="form-group row">
										<label for="gst_per" class="col-sm-2 text-right control-label col-form-label">GST %</label>
										<div class="col-sm-4">
											<select class="form-control" style="width: 100%; height:36px;" id="gst_per" name="gst_per">
												<option value="">Select</option>
												<option value="5" selected>5</option>
												<option value="10">10</option>
											</select>
										</div>

										<label for="discount" class="col-sm-2 text-right control-label col-form-label">Discount</label>
										<div class="col-sm-4">
											<input type="number" class="form-control" id="discount" name="discount" placeholder="Discount.." value="0" autocomplete="off">
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
	<script src="<?php echo base_url() . 'common/dist/js/app/dealerbilling.js?v=' . random_strings(6); ?>"></script>

</body>

</html>