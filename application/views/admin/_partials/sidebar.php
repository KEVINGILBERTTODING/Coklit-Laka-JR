<aside class="sidenav sidenavbar bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
	<div class="sidenav-header">
		<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
		<a class="navbar-brand m-0" href="<?php echo base_url('admin') ?>">
			<img src="<?php echo base_url(); ?>assets/assets/img/logo_jr.png" class="navbar-brand-img h-100" alt="main_logo">
			<span class="ms-1 font-weight-bold">COKLIT-JR</span>
		</a>
	</div>
	<hr class="horizontal dark mt-0">
	<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
		<ul class="navbar-nav">
			<h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder">Halaman Utama</h6>
			</li>
			<li class="nav-item ">
				<a class="nav-link  <?php echo $this->uri->segment(2) == 'dashboard' ? 'active' : '' ?>" href="<?php echo site_url('admin/dashboard') ?>">
					<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
						<i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Dashboard</span>
				</a>
			</li>
			<li class="nav-item  ">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'realisasi' ? 'active' : '' ?> " href="<?php echo site_url('admin/realisasi') ?>">
					<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fa fa-handshake text-primary text-sm opacity-10"></i>
						<!-- <i class="fa-solid fa-handshake-angle"></i> -->
					</div>
					<span class="nav-link-text ms-1">Realisasi Bantuan</span>
				</a>
			</li>

			<li class="nav-item  ">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'lpj' ? 'active' : '' ?> " href="<?php echo site_url('admin/lpj') ?>">
					<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fa fa-book text-warning text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">LPJ Kegiatan</span>
				</a>
			</li>

			<li class="nav-item  ">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'laporan' ? 'active' : '' ?> " href="<?php echo site_url('admin/laporan') ?>">
					<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fa fa-file text-success text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Laporan</span>
				</a>
			</li>

			<li class="nav-item  ">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'surat' ? 'active' : '' ?> " href="<?php echo site_url('admin/surat') ?>">
					<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fa fa-envelope text-info text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Template Surat</span>
				</a>
			</li>

			<li class="nav-item  ">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'loket' ? 'active' : '' ?> " href="<?php echo site_url('admin/loket') ?>">
					<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fas fa-location-arrow text-warning text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Loket</span>
				</a>
			</li>

			<li class="nav-item  ">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'email' ? 'active' : '' ?> " href="<?php echo site_url('admin/email') ?>">
					<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fas fa-envelope text-success text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Template Email</span>
				</a>
			</li>


			<li class="nav-item mt-3">
				<h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder">Halaman Akun</h6>
			</li>
			<li class="nav-item  ">
				<a class="nav-link <?php echo $this->uri->segment(2) == 'profile' ? 'active' : '' ?> " href="<?php echo site_url('admin/profile') ?>">
					<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fa fa-user text-dark text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Profile</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link " href="<?php echo site_url('login/logout'); ?>">
					<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
						<i class="ni ni-button-power text-warning text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Keluar</span>
				</a>
			</li>
		</ul>
	</div>
	</div>
</aside>
