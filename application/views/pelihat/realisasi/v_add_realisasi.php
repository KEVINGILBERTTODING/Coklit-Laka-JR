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
							<h2>Entry Realisasi Bantuan</h2>

							<!-- Tampilkan pesan error saat gagal upload file -->
							<?php
							if (isset($error)) {
								echo "<div class='alert alert-danger' role='alert'>";

								echo '<h5 class="text-white">' . $error . '</h5>';

								echo "</div>";
							}
							?>
						</div>
						<div class="container-md">

							<?php echo form_open_multipart('admin/realisasi/insert'); ?>



							<div class="form-group" hidden>
								<input class="form-control proposal_id" id="proposal_id" name="proposal_id" value="<?= $proposal['proposal_id']; ?>">
							</div>

							<div class="form-group w-40">
								<label for="example-date-input" class="form-control-label">No Urut Proposal</label>
								<input class="form-control no_urut_proposal" id="no_urut_proposal" name="no_urut_proposal" value="<?= $proposal['no_urut_proposal']; ?>" readonly>
							</div>

							<div class="form-group w-20">
								<label for="example-date-input" class="form-control-label">Tanggal Kegiatan</label>
								<input class="form-control" name="tgl_kegiatan" type="date" value="" id="example-date-input" required>
							</div>

							<div class="form-group w-70">
								<label for="example-date-input" class="form-control-label">Tempat Kegiatan</label>
								<input class="form-control tempat_kegiatan" id="tempat_kegiatan" name="tempat_kegiatan" value="">
							</div>

							<label for="nominal_bantuan" class="form-control-label">Nominal Bantuan</label>
							<div class="input-group form-group ">

								<span class="input-group-text">Rp</span>
								<input class="form-control uang" id="nominal_bantuan" aria-label="Amount (to the nearest dollar)" name="nominal_bantuan" value="" required>
							</div>

							<div class="form-group  ">
								<label for="jenis_bantuan" class="form-control-label">Jenis Bantuan</label>
								<select class="form-select" id="jenis_bantuan" name="jenis_bantuan" aria-label="Default select example" required>
									<option disabled selected>-- Jenis --</option>
									<option value="Uang Tunai">Uang Tunai</option>
									<option value="Barang">Barang</option>
								</select>
							</div>

							<div class="form-group w-50" id="barang">
								<label for="jenis_bantuan" class="form-control-label">Barang Berupa</label>
								<input class="form-control barang_berupa" id="barang_berupa" name="barang_berupa" value="">
							</div>

							<div class="form-group ">
								<label for="example-search-input" class="form-control-label">
									Link Berita
								</label>
								<input class="form-control" name="link_berita" type="text" id="link_berita" required>
							</div>


							<div class="row g-3 mt-5">
								<div class="col-8 col-lg-4">
									<div class="form-group ">
										<label for="example-search-input" class="form-control-label mt-3">
											Foto Kegiatan <span class="text-danger">(.jpg, png, jpeg), (maks. 5 mb) *</span>
										</label>
										<input class="form-control" name="foto_kegiatan" type="file" id="foto_kegiatan" required>
									</div>

								</div>

								<div class="col-8-mt-2 col-lg-mt-2 col-lg-4">

									<div class="form-group">
										<label for="example-search-input" class="form-control-label mt-3">
											Kuitansi <span class="text-danger">(.jpg, png, jpeg), (maks. 5 mb) *</span>
										</label>
										<input class="form-control" name="kuitansi" type="file" id="kuitansi" required>
									</div>
								</div>
							</div>

							<div class="row g-3">
								<div class="col-8 col-lg-4">
									<div class="form-group ">
										<label for="example-search-input" class="form-control-label mt-3">
											BAST <span class="text-danger">(.jpg, png, jpeg), (maks. 5 mb) *</span>
										</label>
										<input class="form-control" name="bast" type="file" id="bast" required>
									</div>

								</div>
								<div class="col-8 col-lg-4">

									<div class="form-group ">
										<label for="example-search-input" class="form-control-label mt-3">
											SPT <span class="text-danger">(.jpg, png, jpeg), (maks. 5 mb) *</span>
										</label>
										<input class="form-control" name="spt" type="file" id="spt" required>
									</div>
								</div>

								<div class="col-8-mt-2 col-lg-mt-2 col-lg-4">
									<div class="form-group">
										<label for="example-search-input" class="form-control-label mt-3">
											Bukti Pembayaran (ERP)<span class="text-danger"> (.jpg, png, jpeg), (maks. 5 mb) *</span>
										</label>
										<input class="form-control" name="erp" type="file" id="erp" required>
									</div>

								</div>
							</div>





							<!-- Button submit proposal -->
							<div class="d-grid gap-2 mt-4">
								<button class="btn btn-primary" type="submit" onclick="return confirm('Apakah anda yakin ingin menyimpan data ini?')">Simpan</button>
							</div>
							<!-- Button submit proposal -->
							<div class="d-grid gap-2">
								<a href="<?= base_url('admin/realisasi/getpendapat') ?>" class="btn btn-danger btn-lg">Kembali</a>

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
