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
							<div class="card-body">
								<h5 class="card-title"><?php echo $page_title; ?> <button type="button" class="btn badge badge-pill badge-success" onclick="location.href='<?php echo base_url() . 'cnf/add'; ?>'">Add <?php echo $page_title; ?></button></h5>
								<hr />
								<p>Download sample excel format: <button type="button" class="btn badge badge-pill badge-info" onclick="location.href='<?php echo base_url() . 'common/files/sample-format-blank2.xlsx'; ?>'">Download</button></p>

								<?php if (!isset($upload_status) && !isset($file_error)) { ?>
									<form action="<?php echo base_url(); ?>cnf/fileupload" method="post" enctype="multipart/form-data">
										<b>Upload File</b> (Allowed: xlsx/xls/csv) :

										<input type="file" name="uploadFile" value="" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required />

										<input type="submit" name="submit" value="Upload" />
										<!-- <button type="submit" name="submit" class="btn btn-md badge-primary" >Upload</button> -->
									</form>
								<?php } ?>


								<?php
								if (isset($upload_status) && $upload_status == 'success') {
									echo '<br><i class="icofont-tick-mark" style="color:green;"></i> Successfully Uploaded.';
									//echo ' <a href="' . base_url() . 'uploads/' . $module_name . '/' . $module_id . '">View</a>';
								} else if (isset($file_error)) {
									echo '<br><i class="icofont-close-circled" style="color:red;"></i> ' . $file_error . ' ';
								} else if (isset($upload_status) && $upload_status == 'failure') {
									echo '<br><i class="icofont-close-circled" style="color:red;"></i> Something went wrong!';
								} ?>


								<div class="table-responsive">
									<table id="zero_config" class="table table-striped table-bordered">
										<thead>
											<tr class="textcen">
												<th>Sl</th>
												<th>EntryOn</th>
												<th>Name</th>
												<th>VIN</th>
												<th>EntryBy</th>
												<th>EditedOn</th>
												<th>CNF Billing</th>
												<th>Dealer Billing</th>
												<th>Action</th>

											</tr>
										</thead>
										<tbody class="textcen">
											<?php
											if (!empty($comp_data)) {
												// print_obj($comp_data);
												$sl = 1;
												foreach ($comp_data as $key => $val) {
											?>
													<tr>
														<td><?php echo $sl; ?></td>
														<td><?php echo $val['dtime']; ?></td>
														<td><?php echo $val['name']; ?></td>
														<td><?php echo $val['vin_no']; ?></td>
														<td><?php echo $val['full_name']; ?></td>
														<td><?php echo $val['edited_dtime']; ?></td>
														<td><?php echo ($val['is_billed'] == 1) ?
																'<i class="icofont-tick-boxed" style="color:green; font-size:25px;"></i> <br/>Billed to : ' . $val['cnf_full_name'] :
																'<i class="icofont-close-squared-alt" style="color:orange; font-size:25px;"></i> <br/>Not Billed!'; ?></td>
														<td><?php echo ($val['is_dealer_billed'] == 1) ?
																'<i class="icofont-tick-boxed" style="color:green; font-size:25px;"></i> <br/>Billed to : ' . $val['dealer_billed_text'] :
																'<i class="icofont-close-squared-alt" style="color:orange; font-size:25px;"></i> <br/>Not Billed!'; ?></td>
														<td>
															<?php if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
																if ($val['is_billed'] == 0) {
															?>
																	<button type="button" onclick="location.href='<?php echo base_url() . 'cnf/edit/' . $val['rwid']; ?>'" title="Edit"><i class="icofont-pencil-alt-2"></i></button>

																<?php } else {
																?>
																	<button type="button" onclick="location.href='<?php echo base_url() . 'cnf/edit/' . $val['rwid']; ?>'" title="View only"><i class="icofont-eye-alt"></i></button>
																<?php
																}
																if ($val['is_billed'] == 0) { ?>
																	<button type="button" class="del_row" data-delid="<?php echo $val['rwid']; ?>" data-rowname="<?php echo $val['name']; ?>" title="Delete"><i class="fas fa-trash-alt"></i></button>
															<?php } else {
																	// echo 'N/A';
																}
															} ?>
														</td>
													</tr>
												<?php
													$sl++;
												}
											} else {
												?>
												<tr>
													<td colspan="9">No data found</td>
												</tr>
											<?php
											}
											?>
										</tbody>
									</table>
								</div>

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
	<script>
		$('#zero_config').DataTable();
	</script>

</body>

</html>