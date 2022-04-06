<?php
$page =  $this->uri->segment(1);
?>
<aside class="left-sidebar" data-sidebarbg="skin5">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>dashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

				<?php
				if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
					if ($this->session->userdata('usergroup') == 1) {
				?>
						<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Manage </span></a>
							<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'add-user' || $page == 'profile' || $page == 'cnf' || $page == 'cnfbilling' || $page == 'edit-segment') ? 'in' : ''; ?>">

								<li class="sidebar-item <?php echo ($page == 'add-user' || $page == 'profile') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>users" class="sidebar-link <?php echo ($page == 'add-user' || $page == 'profile') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> User Management</span></a></li>

								<li class="sidebar-item <?php echo ($page == 'cnf') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cnf/list" class="sidebar-link <?php echo ($page == 'cnf') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> CNF Management</span></a></li>

							</ul>
						</li>

						<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Billing </span></a>
							<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'cnfbilling') ? 'in' : ''; ?>">

								<li class="sidebar-item <?php echo ($page == 'cnfbilling') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cnfbilling/list" class="sidebar-link <?php echo ($page == 'cnfbilling') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> CNF Billing Management</span></a></li>


							</ul>
						</li>
					<?php
					}
					?>

					<?php
					if ($this->session->userdata('usergroup') == 2) {
						//cnf
					?>
						<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Manage </span></a>
							<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'add-user' || $page == 'cnf' || $page == 'cnfbilling' || $page == 'edit-segment') ? 'in' : ''; ?>">

								<li class="sidebar-item <?php echo ($page == 'cnf') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cnf/list" class="sidebar-link <?php echo ($page == 'cnf') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> CNF Management</span></a></li>

							</ul>
						</li>

						<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Billing </span></a>
							<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'cnfbilling') ? 'in' : ''; ?>">

								<li class="sidebar-item <?php echo ($page == 'cnfbilling') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cnfbilling/list" class="sidebar-link <?php echo ($page == 'cnfbilling') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> CNF Billing Management</span></a></li>

							</ul>
						</li>
					<?php
					}
					?>

					<?php
					if ($this->session->userdata('usergroup') == 3) {
						//dealer
					?>

						<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Billing </span></a>
							<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'cnfbilling') ? 'in' : ''; ?>">

								<li class="sidebar-item <?php echo ($page == 'cnfbilling') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cnfbilling/list" class="sidebar-link <?php echo ($page == 'cnfbilling') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> CNF Billing Management</span></a></li>

							</ul>
						</li>
				<?php
					}
				}
				?>


			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>