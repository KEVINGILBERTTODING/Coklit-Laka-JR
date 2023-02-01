<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
	<div class="ms-md-auto pe-md-3 d-flex align-items-center">
	</div>
	<ul class="navbar-nav  justify-content-end">
		<li class="nav-item d-flex align-items-center">
			<a href="<?= base_url('super_admin/profile'); ?>" class="nav-link text-white font-weight-bold px-0">
				<i class="fa fa-user me-sm-1"></i>
				<span class="d-none d-sm-inline">Welcome, <?php echo $this->session->userdata('name'); ?></span>
				<img alt="avatar1" class="rounded-circle img-fluid border border-2 border-white" src="
				<?php
				$this->db->where('user_id', $this->session->userdata('id'));
				$user = $this->db->get('user')->row_array();
				echo base_url('uploads/photo_profile/') . $user['photo_profile']; ?>" width="30" height="30" />
			</a>
		</li>
		<li class="nav-item d-xl-none ps-3 d-flex align-items-center">
			<a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
				<div class="sidenav-toggler-inner">
					<i class="sidenav-toggler-line bg-white"></i>
					<i class="sidenav-toggler-line bg-white"></i>
					<i class="sidenav-toggler-line bg-white"></i>
				</div>
			</a>
		</li>
		<li class="nav-item px-3 d-flex align-items-center">
			<a href="javascript:;" class="nav-link text-white p-0">
				<i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
			</a>
		</li>

	</ul>
</div>
