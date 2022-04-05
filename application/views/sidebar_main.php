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

				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Manage </span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'add-user' || $page == 'cnf' || $page == 'add-segment' || $page == 'edit-segment' ) ? 'in' : ''; ?>">

						<li class="sidebar-item <?php echo ($page == 'add-user') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>users" class="sidebar-link <?php echo ($page == 'add-user') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> User Management</span></a></li>

						<li class="sidebar-item <?php echo ($page == 'cnf') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cnf/list" class="sidebar-link <?php echo ($page == 'cnf') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> CNF Management</span></a></li>
						
					</ul>
				</li>

				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Billing </span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'checklist2-bills') ? 'in' : ''; ?>">

						<li class="sidebar-item"><a href="<?php echo base_url(); ?>checklist-bills" class="sidebar-link"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Checklist Bills</span></a></li>

					
					</ul>
				</li>

			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>