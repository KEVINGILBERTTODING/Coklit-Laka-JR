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

		<!-- Isi content -->
		<div class="container-fluid py-4">
			<div class="row">
				<div class="col-12">
					<div class="card mb-4">
						<div class="card-header ">
							<h2>Edit Lpj kegiatan</h2>

							<!-- Div flash data -->
							<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('message'); ?>"></div>


						</div>
						<div class="container-md">

							<?php echo form_open_multipart('admin/realisasi/update'); ?>
							<div class="form-group" hidden>
								<input class="form-control proposal_id" id="proposal_id" name="proposal_id" value="<?= $proposal['proposal_id']; ?>">
							</div>




							<div class="row g-3">
								<div class="col-8 col-lg-4">
									<label for="example-search-input" class="form-control-label">

										<div class="mb-5">
											<label for="example-search-input" class="form-control-label mt-3">
												Foto Kegiatan <span class="text-danger">(.jpg, png, jpeg), (maks. 5 mb) *</span>
											</label>
											<?php
											if ($lpj['foto_kegiatan'] == '') {
												echo '<div class="col-md-4">';
												echo '<span class="badge bg-danger">' . 'Tidak ada file' . '</span>';
												echo '</div>';
											} else {
												echo '<div class="col-md-4">';
												echo '<div class="card-body">';

												// Kondisi saat format file adalah pdf
												if ($lpj['format_foto_kegiatan'] == 'application/pdf') {
													echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
												} else if ($lpj['format_foto_kegiatan'] == 'image/png') {
													echo '<img class="img-fluid" src="' . base_url('assets/img/png.png') . '" alt="Card image cap">';
												} else if ($lpj['format_foto_kegiatan'] == 'image/jpg') {
													echo '<img class="img-fluid" src="' . base_url('assets/img/jpg.png') . '" alt="Card image cap">';
												} else {
													echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
												}
												echo '</img>';
												echo '</div>';
												echo '<span class="badge bg-success">' . $lpj['foto_kegiatan'] . '</span>';
												echo '</div>';
											}
											?>

											<!-- Button trigger modal -->
											<div>
												<div class="row mt-3">

													<?php
													if ($lpj['foto_kegiatan'] != null) {


														echo '<div class="col-md-3">';
														echo '<a href="' . base_url('admin/lpj/download/' . $lpj['proposal_id'] . '/foto_kegiatan') . '" class="btn btn-primary btn-sm" >';
														echo '<i class="fas fa-download"></i>';
														echo '</a>';
														echo '</div>';

														echo '<div class="col-md-3">';
														echo '<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editFotoKegiatan" >';
														echo '<i class="fas fa-edit"></i>';
														echo '</button>';
														echo '</div>';
													} else {
														echo '<div class="col-md-3">';
														echo '<a href="' . base_url('admin/lpj/download/' . $lpj['proposal_id'] . '/foto_kegiatan') . '" class="btn btn-primary btn-sm" disabled >';

														echo '<i class="fas fa-download"></i>';
														echo '</a>';
														echo '</div>';

														echo '<div class="col-md-3">';
														echo '<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editFotoKegiatan" >';
														echo '<i class="fas fa-edit"></i>';
														echo '</button>';
														echo '</div>';
													}
													?>


												</div>
											</div>

										</div>
									</label>
								</div>


								<div class="col-8 col-lg-4">
									<label for="example-search-input" class="form-control-label">

										<div class="mb-5">
											<label for="example-search-input" class="form-control-label mt-3">
												File Lpj <span class="text-danger">(.pdf), (maks. 5 mb) *</span>
											</label>
											<?php
											if ($lpj['lpj'] == '') {
												echo '<div class="col-md-4">';
												echo '<span class="badge bg-danger">' . 'Tidak ada file' . '</span>';
												echo '</div>';
											} else {
												echo '<div class="col-md-4">';
												echo '<div class="card-body">';

												// Kondisi saat format file adalah pdf
												if ($lpj['format_lpj'] == 'application/pdf') {
													echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
												} else if ($lpj['format_lpj'] == 'image/png') {
													echo '<img class="img-fluid" src="' . base_url('assets/img/png.png') . '" alt="Card image cap">';
												} else if ($lpj['format_lpj'] == 'image/jpg') {
													echo '<img class="img-fluid" src="' . base_url('assets/img/jpg.png') . '" alt="Card image cap">';
												} else {
													echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
												}
												echo '</img>';
												echo '</div>';
												echo '<span class="badge bg-success">' . $lpj['lpj'] . '</span>';
												echo '</div>';
											}
											?>

											<!-- Button trigger modal -->
											<div>
												<div class="row mt-3">

													<?php
													if ($lpj['lpj'] != null) {


														echo '<div class="col-md-3">';
														echo '<a href="' . base_url('admin/lpj/download/' . $lpj['proposal_id'] . '/lpj') . '" class="btn btn-primary btn-sm" >';
														echo '<i class="fas fa-download"></i>';
														echo '</a>';
														echo '</div>';

														echo '<div class="col-md-3">';
														echo '<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editLpj" >';
														echo '<i class="fas fa-edit"></i>';
														echo '</button>';
														echo '</div>';
													} else {
														echo '<div class="col-md-3">';
														echo '<a href="' . base_url('admin/lpj/download/' . $lpj['proposal_id'] . '/lpj') . '" class="btn btn-primary btn-sm" disabled >';

														echo '<i class="fas fa-download"></i>';
														echo '</a>';
														echo '</div>';

														echo '<div class="col-md-3">';
														echo '<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editLpj" >';
														echo '<i class="fas fa-edit"></i>';
														echo '</button>';
														echo '</div>';
													}
													?>


												</div>
											</div>

										</div>
									</label>
								</div>

								<!-- Button submit proposal -->
								<div class="d-grid gap-2">
									<a href="<?= base_url('admin/lpj/') ?>" class="btn btn-primary btn-lg">Kembali</a>
								</div>
								</form>


							</div>
						</div>


					</div>

				</div>
			</div>
		</div>
		</div>

		<!-- Modal upload data lpj -->

		<?php echo form_open_multipart('admin/lpj/updateLpj'); ?>
		<div class="modal fade" id="editLpj" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Entry Lpj Kegiatan</h5>

						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group" hidden>
							<input class="form-control" name="proposal_id" value="" type="text" readonly>
						</div>
						<div class="modal-body">

							<div class="form-group ">

								<div>
									<div class="div d-flex justify-content-center">
										<lottie-player class="text-center" src="https://assets7.lottiefiles.com/packages/lf20_komemhfl.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
									</div>

									<h5>Upload File Lpj Kegiatan</h5>

									<div class="form-group">
										<input class="form-control proposal_id" id="proposal_id" name="proposal_id" value="<?= $lpj['proposal_id']; ?>" hidden>
									</div>


									<div class="form-group">
										<label class="form-label" for="customFile">
											File Lpj <span class="text-danger">*</span>
										</label>
										<input class="form-control" name="lpj" type="file" required>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" onclick="return confirm('Apakah anda yakin ingin mengubah data ini?')">Simpan</button>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>


		<!-- Modal upload Foto Kegiatan -->

		<?php echo form_open_multipart('admin/lpj/updatefotokegiatan'); ?>
		<div class="modal fade" id="editFotoKegiatan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Foto Kegiatan</h5>

						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group" hidden>
							<input class="form-control" name="proposal_id" value="" type="text" readonly>
						</div>
						<div class="modal-body">

							<div class="form-group ">

								<div>
									<div class="div d-flex justify-content-center">
										<lottie-player class="text-center" src="https://assets7.lottiefiles.com/packages/lf20_komemhfl.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
									</div>

									<h5>Upload Foto Kegiatan</h5>

									<div class="form-group">
										<input class="form-control proposal_id" id="proposal_id" name="proposal_id" value="<?= $lpj['proposal_id'] ?>" hidden>
									</div>

									<div class="form-group">
										<label class="form-label" for="customFile">
											Foto Kegiatan <span class="text-danger">File harus berformat jpg, jpeg, png, dan ukuran maksimal 5 MB</span>
										</label>
										<input class="form-control" name="foto_kegiatan" type="file" required>
									</div>


								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
						<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" onclick="return confirm('Apakah anda yakin ingin mengubah data ini?')">Simpan</button>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>


		</div>
		</div>


		</div>


		<div class=" modal fade" id="alertError" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Pemberitahuan</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">

						<div class="form-group  d-flex justify-content-center">
							<div class="row">
								<lottie-player class="text-center" src=" https://assets10.lottiefiles.com/packages/lf20_tl52xzvn.json" id="anim_email_failed" background="transparent" speed="1" style="width: 120px; height: 120px;" loop autoplay></lottie-player>
								<div class="col">

									<br>
									<h5>Harap periksa kembali file yang anda upload</h5>
									<p>Seperti format file dan ukuran file</p>

								</div>
							</div>

						</div>



					</div>
					<div class="modal-footer">

						<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>

					</div>
				</div>
			</div>
		</div>

		<div id="footer">
			<?php $this->load->view('admin/_partials/footer') ?>
		</div>

	</main>



	<!-- Bootstrap 3.3.2 JS -->
	<script src="<?php echo base_url(); ?>assets/assets/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url(); ?>assets/assets/js/app.min.js" type="text/javascript"></script>

	<div class="fixed-plugin">
		<?php $this->load->view('admin/_partials/settingbar') ?>
	</div>
	<!--   Core JS Files   -->
	<?php $this->load->view('admin/_partials/js') ?>

	<!-- Load file javascript untuk sweet alert dan jquery -->
	<?php $this->load->view('admin/_partials/myjs') ?>


	<!-- Fungsi memunculkan allert success saat berhasil merubah data -->
	<?php
	$upload_error =  $this->session->flashdata('upload_error');
	if (isset($upload_error)) {

	?>
		<script>
			$(document).ready(function() {
				$('#alertError').modal('show');

			});
		</script>
	<?php
	} else {
	?>

	<?php
	}
	?>


</body>

</html>
