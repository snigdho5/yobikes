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
						<h4 class="page-title"><?php echo $page_title; ?></h4>
						<div class="ml-auto text-right">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
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
							<form class="form-horizontal" method="post" action="<?php echo base_url() . 'changecycle'; ?>">

								<div class="card-body">
									<h4 class="card-title"><?php echo $page_title; ?> Info</h4>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Company</label>
										<div class="col-sm-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="comp_id" name="comp_id" required>
												<option value="">Select</option>
												<?php
												if (!empty($comp_data)) {
													foreach ($comp_data as $key => $value) {
												?>
														<option value="<?php echo $value['compid']; ?>" <?php echo (!empty($edit_data) && decode_url($edit_data['compid']) == decode_url($value['compid'])) ? 'selected' : ''; ?>><?php echo $value['name']; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>


									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Segment</label>
										<div class="col-sm-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="seg_id" name="seg_id" required>
												<option value="">Select</option>
												<?php
												if (!empty($seg_data)) {
													foreach ($seg_data as $key => $value) {
												?>
														<option value="<?php echo $value['segid']; ?>" <?php echo (!empty($edit_data) && decode_url($edit_data['segid']) == decode_url($value['segid'])) ? 'selected' : ''; ?>><?php echo $value['name']; ?></option>
												<?php
													}
												}
												?>

											</select>
										</div>
									</div>


									<div class="form-group row">
										<label for="name" class="col-sm-3 text-right control-label col-form-label"><?php echo $page_title; ?> Name</label>
										<div class="col-sm-9">
											<input type="hidden" name="cyc_id" value="<?php echo ($edit_data) ? $edit_data['cycleid'] : ''; ?>">
											<input type="text" class="form-control" name="name" id="name" placeholder="<?php echo $page_title; ?> Name.." value="<?php echo ($edit_data) ? $edit_data['name'] : ''; ?>" required="">
											<label id="chk_name" style="display: none;"></label>
										</div>
									</div>

								</div>
								<div class="border-top">
									<div class="card-body">
										<button type="submit" id="submit" class="btn btn-primary customer_btn_submit">Submit</button>
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
	<script src="<?php echo base_url() . 'common/dist/js/app/cycles.js?v=' . random_strings(6); ?>"></script>

	<script>
		$("#comp_id").select2({
			placeholder: "Select Company",
			allowClear: true
		});	
		
		$("#seg_id").select2({
			placeholder: "Select Segment",
			allowClear: true
		});
	</script>
</body>

</html>