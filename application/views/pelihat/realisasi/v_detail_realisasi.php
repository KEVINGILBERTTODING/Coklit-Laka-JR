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
							<h2>Detail Realisasi Bantuan</h2>
						</div>
						<div class="container-md">

							<div class="form-group" hidden>
								<input class="form-control proposal_id" id="proposal_id" name="proposal_id" value="<?= $proposal['proposal_id']; ?>">
							</div>

							<div class="form-group w-40">
								<label for="example-date-input" class="form-control-label">No Urut Proposal</label>
								<input class="form-control no_urut_proposal" id="no_urut_proposal" name="no_urut_proposal" value="<?= $proposal['no_urut_proposal']; ?>" readonly>
							</div>

							<div class="form-group w-20">
								<label for="example-date-input" class="form-control-label">Tanggal Kegiatan</label>
								<input class="form-control" name="tgl_kegiatan" type="date" value="<?= $realisasi['tanggal_kegiatan']; ?>" id="example-date-input" readonly>
							</div>

							<div class="form-group w-70">
								<label for="example-date-input" class="form-control-label">Tempat Kegiatan</label>
								<input class="form-control tempat_kegiatan" id="tempat_kegiatan" name="tempat_kegiatan" value="<?= $realisasi['tempat_kegiatan']; ?> " readonly>
							</div>

							<label for="nominal_bantuan" class="form-control-label">Nominal Bantuan</label>
							<div class="input-group form-group ">

								<?php
								$formatRupiah = number_format($realisasi['nominal_bantuan'], 0, ',', '.');
								?>

								<input class="form-control" name="jenis_bantuan" value="Rp. <?= $formatRupiah; ?>" readonly>
							</div>


							<div class="form-group">
								<label for="jenis_bantuan" class="form-control-label">Jenis Bantuan</label>
								<input class="form-control" name="jenis_bantuan" value="<?= $realisasi['jenis_bantuan']; ?>" readonly>
							</div>

							<?php
							if ($realisasi['jenis_bantuan'] == 'Barang') { ?>
								<div class="form-group w-50" id="barang">
									<label for="jenis_bantuan" class="form-control-label">Barang Berupa</label>
									<input class="form-control barang_berupa" id="barang_berupa" name="barang_berupa" value="<?= $realisasi['barang_berupa']; ?>" readonly>
								</div>

							<?php } else { ?>


							<?php } ?>

							<div class="form-control">
								<label for="link_berita" class="form-control-label">Link Berita</label>
								<a href="<?= $realisasi['link_berita']; ?>" class="btn btn-info form-control" target="_blank">Lihat berita</a>
							</div>


							<div class="row g-3 mt-5">
								<div class="col-8 col-lg-4">
									<div class="form-group ">
										<label for="example-search-input" class="form-control-label mt-3">
											Foto Kegiatan
										</label>
										<?php
										if ($realisasi['foto_kegiatan'] == '') {
											echo '<div class="col-md-4">';
											echo '<span class="badge bg-danger">' . 'Tidak ada file' . '</span>';
											echo '</div>';
										} else {
											echo '<div class="col-md-4">';
											echo '<div class="card-body">';

											// Kondisi saat format file adalah pdf
											if ($realisasi['format_foto'] == 'application/pdf') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
											} else if ($realisasi['format_foto'] == 'image/png') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/png.png') . '" alt="Card image cap">';
											} else if ($realisasi['format_foto'] == 'image/jpg') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/jpg.png') . '" alt="Card image cap">';
											} else {
												echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
											}
											echo '</img>';
											echo '</div>';
											echo '<span class="badge bg-success">' . $realisasi['foto_kegiatan'] . '</span>';
											echo '</div>';
										}
										?>
										<!-- Button trigger modal -->
										<div>
											<div class="row mt-3">

												<?php
												if ($realisasi['foto_kegiatan'] != null || $realisasi['foto_kegiatan'] != '') {

													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/realisasi/download/' . $realisasi['proposal_id'] . '/foto_kegiatan') . '" class="btn btn-primary btn-sm" >';
													echo ' Download';
													echo '</a>';
													echo '</div>';
												} else {
													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/realisasi/download/' . $realisasi['proposal_id'] . '/foto_kegiatan') . '" class="btn btn-primary btn-sm" disabled >';
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
											Kuitansi
										</label>
										<?php
										if ($realisasi['kuitansi'] == '') {
											echo '<div class="col-md-4">';
											echo '<span class="badge bg-danger">' . 'Tidak ada file' . '</span>';
											echo '</div>';
										} else {
											echo '<div class="col-md-4">';
											echo '<div class="card-body">';

											// Kondisi saat format file adalah pdf
											if ($realisasi['format_kuitansi'] == 'application/pdf') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
											} else if ($realisasi['format_kuitansi'] == 'image/png') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/png.png') . '" alt="Card image cap">';
											} else if ($realisasi['format_kuitansi'] == 'image/jpg') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/jpg.png') . '" alt="Card image cap">';
											} else {
												echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
											}
											echo '</img>';
											echo '</div>';
											echo '<span class="badge bg-success">' . $realisasi['kuitansi'] . '</span>';
											echo '</div>';
										}
										?>
										<!-- Button trigger modal -->
										<div>
											<div class="row mt-3">

												<?php
												if ($realisasi['kuitansi'] != null || $realisasi['kuitansi'] != '') {

													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/realisasi/download/' . $realisasi['proposal_id'] . '/kuitansi') . '" class="btn btn-primary btn-sm" >';
													echo ' Download';
													echo '</a>';
													echo '</div>';
												} else {
													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/realisasi/download/' . $realisasi['proposal_id'] . '/kuitansi') . '" class="btn btn-primary btn-sm" disabled >';
													echo '<i class="fas fa-download"> Download</i>';
													echo '</a>';
													echo '</div>';
												}
												?>


											</div>
										</div>
									</div>

								</div>

							</div>

							<div class="row g-3 mt-5">
								<div class="col-8 col-lg-4">
									<div class="form-group ">
										<label for="example-search-input" class="form-control-label mt-3">
											Bast
										</label>
										<?php
										if ($realisasi['bast'] == '') {
											echo '<div class="col-md-4">';
											echo '<span class="badge bg-danger">' . 'Tidak ada file' . '</span>';
											echo '</div>';
										} else {
											echo '<div class="col-md-4">';
											echo '<div class="card-body">';

											// Kondisi saat format file adalah pdf
											if ($realisasi['format_bast'] == 'application/pdf') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
											} else if ($realisasi['format_bast'] == 'image/png') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/png.png') . '" alt="Card image cap">';
											} else if ($realisasi['format_bast'] == 'image/jpg') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/jpg.png') . '" alt="Card image cap">';
											} else {
												echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
											}
											echo '</img>';
											echo '</div>';
											echo '<span class="badge bg-success">' . $realisasi['bast'] . '</span>';
											echo '</div>';
										}
										?>
										<!-- Button trigger modal -->
										<div>
											<div class="row mt-3">

												<?php
												if ($realisasi['bast'] != null || $realisasi['bast'] != '') {

													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/realisasi/download/' . $realisasi['proposal_id'] . '/bast') . '" class="btn btn-primary btn-sm" >';
													echo ' Download';
													echo '</a>';
													echo '</div>';
												} else {
													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/realisasi/download/' . $realisasi['proposal_id'] . '/bast') . '" class="btn btn-primary btn-sm" disabled >';
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
											Spt
										</label>
										<?php
										if ($realisasi['spt'] == '') {
											echo '<div class="col-md-4">';
											echo '<span class="badge bg-danger">' . 'Tidak ada file' . '</span>';
											echo '</div>';
										} else {
											echo '<div class="col-md-4">';
											echo '<div class="card-body">';

											// Kondisi saat format file adalah pdf
											if ($realisasi['format_spt'] == 'application/pdf') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
											} else if ($realisasi['format_spt'] == 'image/png') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/png.png') . '" alt="Card image cap">';
											} else if ($realisasi['format_spt'] == 'image/jpg') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/jpg.png') . '" alt="Card image cap">';
											} else {
												echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
											}
											echo '</img>';
											echo '</div>';
											echo '<span class="badge bg-success">' . $realisasi['spt'] . '</span>';
											echo '</div>';
										}
										?>
										<!-- Button trigger modal -->
										<div>
											<div class="row mt-3">

												<?php
												if ($realisasi['spt'] != null || $realisasi['spt'] != '') {

													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/realisasi/download/' . $realisasi['proposal_id'] . '/spt') . '" class="btn btn-primary btn-sm" >';
													echo ' Download';
													echo '</a>';
													echo '</div>';
												} else {
													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/realisasi/download/' . $realisasi['proposal_id'] . '/spt') . '" class="btn btn-primary btn-sm" disabled >';
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
											Erp
										</label>
										<?php
										if ($realisasi['erp'] == '') {
											echo '<div class="col-md-4">';
											echo '<span class="badge bg-danger">' . 'Tidak ada file' . '</span>';
											echo '</div>';
										} else {
											echo '<div class="col-md-4">';
											echo '<div class="card-body">';

											// Kondisi saat format file adalah pdf
											if ($realisasi['format_erp'] == 'application/pdf') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
											} else if ($realisasi['format_erp'] == 'image/png') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/png.png') . '" alt="Card image cap">';
											} else if ($realisasi['format_erp'] == 'image/jpg') {
												echo '<img class="img-fluid" src="' . base_url('assets/img/jpg.png') . '" alt="Card image cap">';
											} else {
												echo '<img class="img-fluid" src="' . base_url('assets/img/pdf.png') . '" alt="Card image cap">';
											}
											echo '</img>';
											echo '</div>';
											echo '<span class="badge bg-success">' . $realisasi['erp'] . '</span>';
											echo '</div>';
										}
										?>
										<!-- Button trigger modal -->
										<div>
											<div class="row mt-3">

												<?php
												if ($realisasi['erp'] != null || $realisasi['erp'] != '') {

													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/realisasi/download/' . $realisasi['proposal_id'] . '/erp') . '" class="btn btn-primary btn-sm" >';
													echo ' Download';
													echo '</a>';
													echo '</div>';
												} else {
													echo '<div class="col-md-3">';
													echo '<a href="' . base_url('admin/realisasi/download/' . $realisasi['proposal_id'] . '/erp') . '" class="btn btn-primary btn-sm" disabled >';
													echo '<i class="fas fa-download"> Download</i>';
													echo '</a>';
													echo '</div>';
												}
												?>


											</div>
										</div>
									</div>

								</div>

							</div>

							<div class="d-grid gap-2">
								<a href="<?= base_url('admin/realisasi') ?>" class="btn btn-primary btn-lg">Kembali</a>

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