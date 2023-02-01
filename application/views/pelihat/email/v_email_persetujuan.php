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
							<h2>Template Email Persetujuan</h2>

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


							<?php echo form_open_multipart('admin/email/editemailpersetujuan'); ?>
							<div class="form-group ">
								<label for="example-date-input" class="form-control-label">Subject Email</label>
								<input class="form-control" name="subject_email" type="text" value="<?= $email['subject']; ?>" required>
							</div>

							<div class=" form-group w-50">
								<label for="exampleFormControlTextarea1">Salam Pembuka</label>
								<textarea class="form-control" name="salam_pembuka_email" id="exampleFormControlTextarea1" rows="3" required><?= $email['salam_pembuka']; ?></textarea>
							</div>

							<div class=" form-group w-50">
								<label for="exampleFormControlTextarea1">Isi Email</label>
								<textarea class="form-control" name="isi_email" id="exampleFormControlTextarea1" rows="4" required><?= $email['isi_email']; ?></textarea>
							</div>


							<div class=" form-group w-50">
								<label for="exampleFormControlTextarea1">Penutup</label>
								<textarea class="form-control" name="penutup_email" id="exampleFormControlTextarea1" rows="3" required><?= $email['penutup']; ?></textarea>
							</div>


						</div>


						<div class="d-grid gap-2 mt-4">
							<button class="btn btn-primary" type="submit" onclick="return confirm('Apakah anda yakin ingin menyimpan data ini?')">Simpan</button>
						</div>

						<div class="d-grid gap-2">
							<a href="<?= base_url('admin/email') ?>" class="btn btn-danger btn-lg">Kembali</a>

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
