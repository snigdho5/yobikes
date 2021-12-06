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
					<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'add-user' || $page == 'add-company' || $page == 'edit-company' || $page == 'changecompany' || $page == 'add-segment' || $page == 'edit-segment' || $page == 'changesegment' || $page == 'add-cycle' || $page == 'edit-cycle' || $page == 'changecycle' || $page == 'add-checklist' || $page == 'edit-checklist' || $page == 'changechecklist' || $page == 'add-checklist2' || $page == 'edit-checklist2' || $page == 'changechecklist2') ? 'in' : ''; ?>">

						<li class="sidebar-item <?php echo ($page == 'add-user') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>users" class="sidebar-link <?php echo ($page == 'add-user') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> User Management</span></a></li>

						<li class="sidebar-item <?php echo ($page == 'add-company' || $page == 'edit-company' || $page == 'changecompany') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>companies" class="sidebar-link <?php echo ($page == 'add-company' || $page == 'edit-customer' || $page == 'changecompany') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Company Management</span></a></li>

						<li class="sidebar-item <?php echo ($page == 'add-segment' || $page == 'edit-segment' || $page == 'changesegment') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>segments" class="sidebar-link <?php echo ($page == 'add-it-segment' || $page == 'edit-segment' || $page == 'changesegment') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Segments Management</span></a></li>

						<li class="sidebar-item <?php echo ($page == 'add-cycle' || $page == 'edit-cycle' || $page == 'changecycle') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>cycles" class="sidebar-link <?php echo ($page == 'add-cycle' || $page == 'edit-cycle' || $page == 'changecycle') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Cycle Management</span></a></li>

						<li class="sidebar-item <?php echo ($page == 'add-checklist' || $page == 'edit-checklist' || $page == 'changechecklist') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>checklists" class="sidebar-link <?php echo ($page == 'add-checklist' || $page == 'edit-checklist' || $page == 'changechecklist') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Checklist Management</span></a></li>

						<li class="sidebar-item <?php echo ($page == 'add-checklist2' || $page == 'edit-checklist2' || $page == 'changechecklist2') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>checklists2" class="sidebar-link <?php echo ($page == 'add-checklist2' || $page == 'edit-checklist2' || $page == 'changechecklist2') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Checklist2 Management</span></a></li>

					</ul>
				</li>

				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Billing </span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'checklist2-bills') ? 'in' : ''; ?>">

						<li class="sidebar-item"><a href="<?php echo base_url(); ?>checklist-bills" class="sidebar-link"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Checklist Bills</span></a></li>

						<li class="sidebar-item"><a href="<?php echo base_url(); ?>checklist-billing" class="sidebar-link" target="_blank"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Checklist Billing</span></a></li>

						<li class="sidebar-item <?php echo ($page == 'checklist2-bills') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>checklist2-bills" class="sidebar-link <?php echo ($page == 'checklist2-bills') ? 'active' : ''; ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Checklist2 Bills</span></a></li>

						<li class="sidebar-item"><a href="<?php echo base_url(); ?>checklist2-billing" class="sidebar-link" target="_blank"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu"> Checklist2 Billing</span></a></li>

					</ul>
				</li>

			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>