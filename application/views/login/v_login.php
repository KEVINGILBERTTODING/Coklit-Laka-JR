<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->



<?php $this->load->view('login/_partials/header') ?>




<body class="">
	<div class="container position-sticky z-index-sticky top-0">
		<div class="row">
			<div class="col-12">
				<!-- Navbar -->
				<nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 w-40 start-0 end-0 mx-4">
					<div class="container-fluid">
						<div class="row">
							<div class="col">
								<img src="<?= base_url('assets/assets/img/logo_jr.png')  ?>" width="30px" alt="">

							</div>
							<div class="col">
								<a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.html">
									COKLIT-JR
								</a>
							</div>
						</div>



						<!-- <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon mt-2">
								<span class="navbar-toggler-bar bar1"></span>
								<span class="navbar-toggler-bar bar2"></span>
								<span class="navbar-toggler-bar bar3"></span>
							</span>
						</button>
						<div class="collapse navbar-collapse" id="navigation">
							<ul class="navbar-nav mx-auto">
								<li class="nav-item">
									<a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/dashboard.html">
										<i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
										Dashboard
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link me-2" href="../pages/profile.html">
										<i class="fa fa-user opacity-6 text-dark me-1"></i>
										Profile
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link me-2" href="../pages/sign-up.html">
										<i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
										Sign Up
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link me-2" href="../pages/sign-in.html">
										<i class="fas fa-key opacity-6 text-dark me-1"></i>
										Masuk
									</a>
								</li>
							</ul>
							<ul class="navbar-nav d-lg-block d-none">
								<li class="nav-item">
									<a href="https://www.creative-tim.com/product/argon-dashboard" class="btn btn-sm mb-0 me-1 btn-primary">Free Download</a>
								</li>
							</ul>
						</div> -->
					</div>
				</nav>
				<!-- End Navbar -->
			</div>
		</div>
	</div>
	<main class="main-content  mt-0" style="background-image: url('<?= base_url('assets/img/bg_login.png'); ?>');">
		<section>
			<div class="page-header min-vh-100">
				<div class="container">
					<div class="row">
						<div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">

							<div class="card-header pb-0 text-start">
								<h4 class="font-weight-bolder">Masuk</h4>
								<p class="mb-0">Masukkan username dan password</p>
							</div>
							<div class="card-body">
								<form class="w3-container" method="POST" action="<?php echo site_url('login/autentikasi'); ?>">
									<div class=" mb-3">
										<input name="username" class="form-control form-control-lg" placeholder="Username">
									</div>
									<div class="mb-3">
										<input type="password" name="pass" class="form-control form-control-lg" placeholder="Password" </div>
										<div class="text-center">
											<button class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Masuk</button>
										</div>
								</form>
							</div>

							<?php

							if ($this->session->flashdata('msg') != null) {
								// echo '<div class="alert alert-danger" role="alert">';

								echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
								echo '<h6 class="text-white text-sm">' . $this->session->flashdata('msg') . '</div>';
								echo '<div>';
								// echo '</div>';
							} else {
								echo "";
							}
							?>


						</div>
						<div class="w3-col" style="width:30%">
							<p></p>
						</div>

					</div>
				</div>
				<div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
					<div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('<?php echo base_url() ?>assets/img/bg.png');
          background-size: cover;">

						<span class="mask bg-gradient-primary opacity-6"></span>
						<H3 class="mt-5 text-white font-weight-bolder position-relative">"COKLIT-JR"</H3>
					</div>
				</div>
			</div>
			</div>
			</div>


		</section>
		<!-- Modal -->

	</main>

</body>
<?php $this->load->view('login/_partials/js'); ?>




</html>
