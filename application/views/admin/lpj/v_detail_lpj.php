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
							<h2>Detail Lpj Kegiatan</h2>
						</div>
						<div class="container-md">

							<div class="form-group" hidden>
								<input class="form-control proposal_id" id="proposal_id" name="proposal_id" value="<?= $proposal['proposal_id']; ?>">
							</div>
							<div class="row g-3 ">
								<div class="col-8 col-lg-4">
									<div class="form-group ">
										<label for="example-search-input" class="form-control-label mt-3">
											Foto Kegiatan
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
												if ($lpj['foto_kegiatan'] != null || $lpj['foto_kegiatan'] != '') {

													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/lpj/download/' . $lpj['proposal_id'] . '/foto_kegiatan') . '" class="btn btn-primary btn-sm" >';
													echo ' Download';
													echo '</a>';
													echo '</div>';
												} else {
													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/lpj/download/' . $lpj['proposal_id'] . '/foto_kegiatan') . '" class="btn btn-primary btn-sm" disabled >';
													echo '<i class="fas fa-download"> Download</i>';
													echo '</a>';
													echo '</div>';
												}
												?>


											</div>
										</div>
									</div>

								</div>
								<div class="col-8 col-lg-4">
									<div class="form-group ">
										<label for="example-search-input" class="form-control-label mt-3">
											File Lpj
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
												if ($lpj['lpj'] != null || $lpj['lpj'] != '') {

													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/lpj/download/' . $lpj['proposal_id'] . '/lpj') . '" class="btn btn-primary btn-sm" >';
													echo ' Download';
													echo '</a>';
													echo '</div>';
												} else {
													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/lpj/download/' . $lpj['proposal_id'] . '/lpj') . '" class="btn btn-primary btn-sm" disabled >';
													echo '<i class="fas fa-download"> Download</i>';
													echo '</a>';
													echo '</div>';
												}
												?>


											</div>
										</div>
									</div>

								</div>




								<div class="d-grid gap-2">
									<a href="<?= base_url('admin/lpj') ?>" class="btn btn-primary btn-lg">Kembali</a>

								</div>
								</form>
							</div>
						</div>


					</div>

				</div>
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


		<!-- END CONTENT -->


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


	<script>
		$('#jenis_bantuan').change(function() {
			const jenis_bantuan = $(this).val();
			if (jenis_bantuan == 'Barang') {
				$('#barang').attr('hidden', false);
			} else if (jenis_bantuan == 'Uang Tunai') {

				$('#barang').attr('hidden', true);
			} else {
				$('#barang').attr('hidden', true);
			}


		});
	</script>

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
