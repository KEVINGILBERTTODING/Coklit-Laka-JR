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
<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('admin/_partials/header') ?>
</head>


<body class="g-sidenav-show   bg-gray-100">
	<div class="min-height-300 bg-primary position-absolute w-100"></div>

	<?php $this->load->view('admin/_partials/sidebar') ?>

	<main class="main-content position-relative border-radius-lg ">

		<!-- Navbar -->
		<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
			<div class="container-fluid py-1 px-3">

				<!-- Load breadcumb -->

				<?php $this->load->view('admin/_partials/breadcumb') ?>

				<!-- Load navbar -->
				<?php $this->load->view('admin/_partials/navbar') ?>


			</div>

		</nav>

		<!-- MENU PROPOSAL -->
		<div class="container-fluid py-4">
			<div class="row">
				<h5 class="font-weight-bolder text-white greeting mb-4">
				</h5>

				<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('message'); ?>"></div>

				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<a class="" href="<?php echo base_url() ?>admin/realisasi">
							<div class="card-body p-3">
								<div class="row">
									<div class="col-8">
										<div class="numbers">
											<p class="text-sm mb-0 text-uppercase font-weight-bold">Realisasi Bantuan</p>
											<h5 class="font-weight-bolder">
												<?php
												if ($hs > 0) {
													echo '<span class=" mr-2"> ' . $hs . ' Proposal Baru</span>';
												} else {
													echo '<span class=" mr-2"> ' . $hs . ' Proposal Baru</span>';
												}
												?>


											</h5>

										</div>
									</div>
									<div class="col-4 text-end">
										<div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
											<i class="fa fa-handshake text-lg opacity-10" aria-hidden="true"></i>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>

				<!-- MENU LPJ -->


				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<a class="card-block stretched-link text-decoration-none" href="<?php echo base_url() ?>admin/lpj">
							<div class="card-body p-3">
								<div class="row">
									<div class="col-8">
										<div class="numbers">
											<p class="text-sm mb-0 text-uppercase font-weight-bold">Lpj</p>
											<h5 class="font-weight-bolder">
												<?php
												if ($hk > 0) {
													echo '<span class=" mr-2"> ' . $hk . ' Proposal Baru</span>';
												} else {
													echo '<span class=" mr-2"> ' . $hk . ' Proposal Baru</span>';
												}
												?>
											</h5>
											<p class="mb-0">


											</p>
										</div>
									</div>
									<div class="col-4 text-end">
										<div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
											<i class="ni ni-book-bookmark text-lg opacity-10" aria-hidden="true"></i>
										</div>
									</div>
								</div>

							</div>
						</a>
					</div>
				</div>


				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<a class="card-block stretched-link text-decoration-none" href="<?php echo base_url() ?>admin/laporan">
							<div class="card-body p-3">
								<div class="row">
									<div class="col-8">
										<div class="numbers">
											<p class="text-sm mb-0 text-uppercase font-weight-bold">Laporan</p>
											<h5 class="font-weight-bolder">
												Lihat Laporan

											</h5>
											<p class="mb-0">


											</p>
										</div>
									</div>
									<div class="col-4 text-end">
										<div class="icon icon-shape bg-gradient-success shadow-danger text-center rounded-circle">
											<i class="fa fa-file text-lg opacity-10" aria-hidden="true"></i>
										</div>
									</div>
								</div>

							</div>
						</a>
					</div>
				</div>


				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
					<div class="card">
						<a class="card-block stretched-link text-decoration-none" href="<?php echo base_url() ?>admin/surat">
							<div class="card-body p-3">
								<div class="row">
									<div class="col-8">
										<div class="numbers">
											<p class="text-sm mb-0 text-uppercase font-weight-bold">Template Surat</p>
											<h5 class="font-weight-bolder">
												Surat
											</h5>

										</div>
									</div>
									<div class="col-4 text-end">
										<div class="icon icon-shape bg-gradient-info shadow-danger text-center rounded-circle">
											<i class="fa fa-envelope text-lg opacity-10" aria-hidden="true"></i>
										</div>
									</div>
								</div>

							</div>
						</a>
					</div>
				</div>

				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
					<div class="card">
						<a class="" href="<?php echo base_url() ?>admin/loket">
							<div class="card-body p-3">
								<div class="row">
									<div class="col-8">
										<div class="numbers">
											<p class="text-sm mb-0 text-uppercase font-weight-bold">Loket</p>
											<h5 class="font-weight-bolder">
												<?php
												if ($loket > 0) {
													echo '<span class=" mr-2"> ' . $loket . ' Loket</span>';
												} else {
													echo '<span class=" mr-2"> ' . $loket . ' Loket</span>';
												}
												?>


											</h5>

										</div>
									</div>
									<div class="col-4 text-end">
										<div class="icon icon-shape bg-gradient-warning	 shadow-success text-center rounded-circle">
											<i class="fas fa-location-arrow text-lg opacity-10" aria-hidden="true"></i>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
					<div class="card">
						<a class="card-block stretched-link text-decoration-none" href="<?php echo base_url() ?>admin/email">
							<div class="card-body p-3">
								<div class="row">
									<div class="col-8">
										<div class="numbers">
											<p class="text-sm mb-0 text-uppercase font-weight-bold">Template Email</p>
											<h5 class="font-weight-bolder">
												Email
											</h5>

										</div>
									</div>
									<div class="col-4 text-end">
										<div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
											<i class="fa fa-envelope text-lg opacity-10" aria-hidden="true"></i>
										</div>
									</div>
								</div>

							</div>
						</a>
					</div>
				</div>


				<!-- Modal -->
				<div class="modal fade" id="alertDialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Pemberitahuan</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="div center d-flex align-items-center justify-content-center">
								<lottie-player src="https://assets9.lottiefiles.com/packages/lf20_p7ki6kij.json" background="transparent" speed="1" style="width: 130px; height: 130px;" loop autoplay></lottie-player>
							</div>

							<div class="modal-body center d-flex align-items-center justify-content-center">


								<div class="div">
									Silahkan lengkapi data-data pendukung anda terlebih dahulu sebelum mengakses fitur ini.
								</div>


							</div>
							<div class="modal-footer">

								<button class="btn btn-primary" data-bs-target="#entryData" data-bs-toggle="modal" data-bs-dismiss="modal">Lanjutkan</button>
							</div>
						</div>
					</div>
				</div>

				<div class="d-flex justify-content-end fixed-bottom">
					<lottie-player src="https://assets8.lottiefiles.com/packages/lf20_5i5k8eh3.json" id="siang" background="transparent" speed="1" style="width: 160px; height: 160px;" loop autoplay></lottie-player>
					<lottie-player src="https://assets10.lottiefiles.com/packages/lf20_qxv9rb7w.json" id="malam" background="transparent" speed="0.5" style="width: 160px; height: 160px;" loop autoplay></lottie-player>
					<lottie-player src="https://assets10.lottiefiles.com/packages/lf20_xcvaucib.json" id="pagi" background="transparent" speed="0.5" style="width: 160px; height: 160px;" loop autoplay></lottie-player>
				</div>



			</div>




			<!-- Modal entry detail user -->
			<?php echo form_open_multipart('admin/dashboard/insert'); ?>
			<div class="modal fade" id="entryData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Lengkapi Data Pendukung</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="form-group" hidden>
								<input class="form-control user_id" id="user_id" name="user_id" value="" readonly>
							</div>


							<div class="div d-flex justify-content-center">
								<lottie-player class="text-center" src="https://assets10.lottiefiles.com/packages/lf20_nUTP5Vd52q.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
							</div>
							<label for="nama_lengkap">Nama Lengkap<span class="text-danger">*</span></label>
							<div class="form-group">
								<input class="form-control nama_lengkap" id="nama_lengkap" name="nama_lengkap" value="">
							</div>

							<label for="jabatan">Email <span class="text-danger">*</span></label>
							<div class="form-group">
								<input class="form-control jabatan" id="email" name="email" value="">
							</div>

							<label for="jabatan">Jabatan <span class="text-danger">*</span></label>
							<div class="form-group">
								<input class="form-control jabatan" id="jabatan" name="jabatan" value="">
							</div>

						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
						</div>
					</div>
				</div>

			</div>
			<?php echo form_close(); ?>



		</div>


		</div>

		<div id="footer" class="fixed-bottom">
			<?php $this->load->view('admin/_partials/footer') ?>
		</div>

	</main>

	<div class="fixed-plugin">
		<?php $this->load->view('admin/_partials/settingbar') ?>
	</div>
	<!--   Core JS Files   -->
	<?php $this->load->view('admin/_partials/js') ?>
	<!-- Load file javascript untuk sweet alert dan jquery -->
	<?php $this->load->view('admin/_partials/myjs') ?>

	<!-- Cek if user is exist or not -->
	<script>
		$(document).ready(function() {
			$.ajax({
				url: "<?php echo base_url('admin/dashboard/cekUser') ?>",
				type: "POST",
				dataType: "JSON",
				success: function(data) {
					if (data.status == 'success') {
						$('.sidenav').removeClass('d-none');
					} else {
						$('#alertDialog').modal('show');
						$('.sidenav').addClass('d-none');

						$('#pagi').hide();
						$('#siang').hide();
						$('#malam').hide();


					}
				},

			});
		});
	</script>




	<script type="text/javascript">
		$(document).ready(function() {
			var date = new Date();
			var jam = date.getHours();
			if (jam >= 0 && jam <= 10) {
				$('.greeting').html('Selamat Pagi,  <?php echo $nama_lengkap; ?>');
				$('#pagi').show();
				$('#siang').hide();
				$('#malam').hide();

			} else if (jam >= 11 && jam <= 14) {
				$('.greeting').html('Selamat Siang,  <?php echo $nama_lengkap; ?>');
				$('#pagi').hide();
				$('#siang').show();
				$('#malam').hide();
			} else if (jam >= 15 && jam <= 18) {
				$('.greeting').html('Selamat Sore,  <?php echo $nama_lengkap; ?>');
				$('#pagi').hide();
				$('#siang').show();
				$('#malam').hide();
			} else {
				$('.greeting').html('Selamat Malam, <?php echo $nama_lengkap; ?> ');
				$('#pagi').hide();
				$('#siang').hide();
				$('#malam').show();


			}

		});
	</script>

</body>

</html>
