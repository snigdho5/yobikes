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
							<form class="form-horizontal" method="post" action="<?php echo base_url() . 'changechecklist'; ?>">

								<div class="card-body">
									<h4 class="card-title"><?php echo $page_title; ?> Info</h4>
									<div class="form-group row">
										<label for="comp_id" class="col-sm-1 text-right control-label col-form-label">Company</label>
										<div class="col-sm-5">
											<input type="hidden" name="checklistid" value="<?php echo (!empty($edit_data)) ? $edit_data['checklistid'] : ''; ?>">
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

										<label for="seg_id" class="col-sm-1 text-right control-label col-form-label">Segment</label>
										<div class="col-sm-5">
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
										<label for="cycleid" class="col-sm-1 text-right control-label col-form-label">Cycle Name</label>
										<div class="col-sm-5">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cycleid" name="cycleid" required>
												<option value="<?php echo (!empty($edit_data)) ? $edit_data['cycleid'] : '0'; ?>"><?php echo (!empty($edit_data)) ? $edit_data['cycle_name'] : ''; ?></option>
											</select>
										</div>

										<label for="name" class="col-sm-1 text-right control-label col-form-label">Color</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="name" name="name" placeholder="Checklist Color.." autocomplete="off" value="<?php echo (!empty($edit_data)) ? $edit_data['name'] : ''; ?>" required>
											<label id="chk_name" style="display: none;"></label>
										</div>
									</div>

									<div class="form-group row">
										<label for="name" class="col-sm-1 text-right control-label col-form-label">Quantity (Multiple of)</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity (Multiple of).." autocomplete="off" value="<?php echo (!empty($edit_data)) ? $edit_data['quantity'] : ''; ?>" required>
										</div>

										<label for="carton" class="col-sm-1 text-right control-label col-form-label">Carton</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" id="carton" name="carton" placeholder="Carton.." autocomplete="off" value="<?php echo (!empty($edit_data)) ? $edit_data['carton'] : ''; ?>" required>
										</div>
									</div>

									<div class="form-group row">
										<label for="tyre" class="col-sm-1 text-right control-label col-form-label">Tyre</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" id="tyre" name="tyre" placeholder="Tyre.." autocomplete="off" value="<?php echo (!empty($edit_data)) ? $edit_data['tyre'] : ''; ?>" required>
										</div>

										<label for="rim" class="col-sm-1 text-right control-label col-form-label">Rim (Pair)</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" id="rim" name="rim" placeholder="Rim (Pair).." autocomplete="off" value="<?php echo (!empty($edit_data)) ? $edit_data['rim'] : ''; ?>" required>
										</div>
									</div>

									<div class="form-group row">
										<label for="busket" class="col-sm-1 text-right control-label col-form-label">Busket</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" id="busket" name="busket" placeholder="Busket.." autocomplete="off" value="<?php echo (!empty($edit_data)) ? $edit_data['busket'] : ''; ?>" required>
										</div>

										<label for="frame" class="col-sm-1 text-right control-label col-form-label">Frame</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" id="frame" name="frame" placeholder="Frame.." autocomplete="off" value="<?php echo (!empty($edit_data)) ? $edit_data['frame'] : ''; ?>" required>
										</div>
									</div>


									<div class="form-group row">
										<label for="mudguard" class="col-sm-1 text-right control-label col-form-label">Mudguard (Pair)</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" id="mudguard" name="mudguard" placeholder="Mudguard (Pair).." autocomplete="off" value="<?php echo (!empty($edit_data)) ? $edit_data['mudguard'] : ''; ?>" required>
										</div>

										<label for="sit" class="col-sm-1 text-right control-label col-form-label">Sit</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" id="sit" name="sit" placeholder="Sit.." autocomplete="off" value="<?php echo (!empty($edit_data)) ? $edit_data['sit'] : ''; ?>" required>
										</div>
									</div>

									<div class="form-group row">
										<label for="handle" class="col-sm-1 text-right control-label col-form-label">Handle</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" id="handle" name="handle" placeholder="Handle.." autocomplete="off" value="<?php echo (!empty($edit_data)) ? $edit_data['handle'] : ''; ?>" required>
										</div>

										<label for="carrier" class="col-sm-1 text-right control-label col-form-label">Carrier</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" id="carrier" name="carrier" placeholder="Carrier.." autocomplete="off" value="<?php echo (!empty($edit_data)) ? $edit_data['carrier'] : ''; ?>" required>
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
	<script src="<?php echo base_url() . 'common/dist/js/app/checklist.js?v=' . random_strings(6); ?>"></script>
</body>

</html>