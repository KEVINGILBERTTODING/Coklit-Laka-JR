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
							<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('message'); ?>"></div>
							<h2>Template Surat Penolakan</h2>

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
							<div class="form-group ">
								<div class="row">
									<label for="example-search-input" class="form-control-label mt-3">
										Logo Kepala Surat <span class="text-danger">(.jpg, png, jpeg), (maks. 5 mb) *</span>
									</label>

									<div class="row">
										<img src="<?= base_url('assets/img/' . $surat['logo_kop_surat']); ?>" alt="profile_image" class="w-20">

									</div>

									<button class="btn btn-warning btn-sm  mt-2 w-10" data-bs-toggle="modal" data-bs-target="#editphotoProfile"><i class="fa fa-edit"></i></button>


								</div>


							</div>



							<?php echo form_open_multipart('admin/surat/editsuratpenolakan'); ?>
							<div class="form-group w-20">
								<label for="example-date-input" class="form-control-label">Nomor Surat</label>
								<input class="form-control" name="no_surat" type="text" value="<?= $surat['no_surat']; ?>" required>
							</div>

							<div class="form-group w-50">
								<label for="example-date-input" class="form-control-label">Sifat</label>
								<input class="form-control" name="sifat" type="text" value="<?= $surat['sifat']; ?>" required>
							</div>
							<div class=" form-group w-50">
								<label for="exampleFormControlTextarea1">Hal</label>
								<textarea class="form-control" name="hal" id="exampleFormControlTextarea1" rows="2" required><?= $surat['hal']; ?></textarea>
							</div>
							<div class=" form-group w-50">
								<label for="exampleFormControlTextarea1">Salam Pembuka</label>
								<textarea class="form-control" name="salam_pembuka" id="exampleFormControlTextarea1" rows="3" required><?= $surat['salam_pembuka']; ?></textarea>
							</div>
							<div class=" form-group w-50">
								<label for="exampleFormControlTextarea1">Penutup</label>
								<textarea class="form-control" name="penutup1" id="exampleFormControlTextarea1" rows="3" required><?= $surat['penutup1']; ?></textarea>
								<textarea class="form-control mt-3" name="penutup2" id="exampleFormControlTextarea1" rows="3" required><?= $surat['penutup2']; ?></textarea>
							</div>

							<div class=" form-group w-50">
								<label for="exampleFormControlTextarea1">Catatan Kaki</label>
								<textarea class="form-control" name="catatan_kaki" id="exampleFormControlTextarea1" rows="5" required><?= $surat['catatan_kaki']; ?></textarea>
							</div>

						</div>


						<div class="d-grid gap-2 mt-4">
							<button class="btn btn-primary" type="submit" onclick="return confirm('Apakah anda yakin ingin menyimpan data ini?')">Simpan</button>
						</div>

						<div class="d-grid gap-2">
							<a href="<?= base_url('admin/surat') ?>" class="btn btn-danger btn-lg">Kembali</a>

						</div>
						</form>
					</div>
				</div>


			</div>

		</div>
		</div>
		</div>
		</div>

		<?php echo form_open_multipart('admin/surat/updateLogoKopSurat'); ?>
		<div class="modal fade" id="editphotoProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog ">
				<div class="modal-content ">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ubah Logo Kop Surat</h5>

						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">


						<div class="modal-body">

							<div class="form-group ">


								<img src="<?= base_url('assets/img/' . $surat['logo_kop_surat']); ?>" class="img-fluid w-50" alt="Logo kop surat">
								<h5 class="mt-3">Upload Logo Kop Surat</h5>

								<input class="form-control" name="logo_kop_surat" type="file" required>

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
