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
	<?php $this->load->view('pengentry/_partials/header') ?>
</head>


<body class="g-sidenav-show   bg-gray-100">



	<div class="min-height-300 bg-primary position-absolute w-100"></div>

	<?php $this->load->view('pengentry/_partials/sidebar') ?>

	<main class="main-content position-relative border-radius-lg ">

		<!-- Navbar -->
		<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
			<div class="container-fluid py-1 px-3">


				<!-- Load breadcumb -->

				<?php $this->load->view('pengentry/_partials/breadcumb') ?>

				<!-- Load navbar -->
				<?php $this->load->view('pengentry/_partials/navbar') ?>


			</div>

		</nav>

		<!-- Isi content -->
		<div class="container-fluid py-4">
			<div class="row">
				<div class="col-12">
					<div class="card mb-4 ">
						<div class="card-header ">
							<h3 id="h1">Import data</h3>
							<div class="row mt-3 d-flex flex-row-reverse">

								<div class="col col-md-2">
									<button class="btn btn-info  btn-sm" data-bs-toggle="modal" data-bs-target="#setting_iwkl">
										Pengaturan Excel Dasi
								</div>
								<div class="col col-md-2">
									<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#setting_iwkbu">
										Pengaturan Excel IRMS
								</div>


							</div>

							<!-- Div flash data -->
							<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('message'); ?>"></div>

						</div>
						<div class="container-md containerku">
							<form action="<?= base_url('pengentry/iw/import_excel'); ?>" method="post" enctype="multipart/form-data">

								<div class="form-group" id="form_input_file">
									<label>Pilih File Excel</label>
									<input class="form-control w-50" type="file" id="input_file" name="fileExcel" accept=".xls, .xlsx" required>
								</div>
								<div>
									<button class='btn btn-success' id="btn_submit" type="submit">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										Import
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>


			<!-- Modal entry detail user -->
			<?php echo form_open_multipart('pengentry/iw/update_batch_setting_iwkbu'); ?>
			<div class="modal fade" id="setting_iwkbu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h6 class="modal-title" id="exampleModalLabel">Pengaturan Data Excel IWKBU</h6>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
						</div>
						<div class="modal-body">
							<div class="form-group" hidden>
								<input class="form-control user_id" id="user_id" name="user_id" value="" readonly>
							</div>


							<div class="div d-flex justify-content-center">
								<lottie-player class="text-center" src="https://assets10.lottiefiles.com/packages/lf20_nUTP5Vd52q.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
							</div>
							<?php foreach ($setting_iwkbu as $setting_iwkbu) : ?>
								<h6><?= $setting_iwkbu->name; ?></h6>
								<label for="Col">Col<span class="text-danger">*</span></label>
								<div class="form-group">
									<input class="form-control nama_lengkap" id="col" name="id_<?= $setting_iwkbu->id; ?>" value="<?= $setting_iwkbu->id; ?>" hidden>
									<input class="form-control nama_lengkap" type="number" id="col" name="col_<?= $setting_iwkbu->id; ?>" value="<?= $setting_iwkbu->col; ?>" required>
								</div>

								<label for="Col">Row start<span class="text-danger">*</span></label>
								<div class="form-group">
									<input class="form-control nama_lengkap" type="number" id="col" name="row_start_<?= $setting_iwkbu->id; ?>" value="<?= $setting_iwkbu->row_start; ?>" required>
								</div>

								<label for="Col">Row end<span class="text-danger">*</span></label>
								<div class="form-group">
									<input class="form-control nama_lengkap" type="number" id="col" name="row_end_<?= $setting_iwkbu->id; ?>" value="<?= $setting_iwkbu->row_end; ?>" required>
								</div>


							<?php endforeach; ?>


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
						</div>
					</div>
				</div>

			</div>
			<?php echo form_close(); ?>


			<!-- Modal entry detail user -->
			<?php echo form_open_multipart('pengentry/iw/update_batch_setting_iwkl'); ?>
			<div class="modal fade" id="setting_iwkl" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h6 class="modal-title" id="exampleModalLabel">Pengaturan Data Excel IWKL</h6>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
						</div>
						<div class="modal-body">
							<div class="form-group" hidden>
								<input class="form-control user_id" id="user_id" name="user_id" value="" readonly>
							</div>


							<div class="div d-flex justify-content-center">
								<lottie-player class="text-center" src="https://assets10.lottiefiles.com/packages/lf20_nUTP5Vd52q.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
							</div>
							<?php foreach ($setting_iwkl as $setting_iwkl) : ?>
								<h6><?= $setting_iwkl->name; ?></h6>
								<label for="Col">Col<span class="text-danger">*</span></label>
								<div class="form-group">
									<input class="form-control nama_lengkap" id="col" name="id_<?= $setting_iwkl->id; ?>" value="<?= $setting_iwkl->id; ?>" hidden>
									<input class="form-control nama_lengkap" type="number" id="col" name="col_<?= $setting_iwkl->id; ?>" value="<?= $setting_iwkl->col; ?>" required>
								</div>

								<label for="Col">Row start<span class="text-danger">*</span></label>
								<div class="form-group">
									<input class="form-control nama_lengkap" type="number" id="col" name="row_start_<?= $setting_iwkl->id; ?>" value="<?= $setting_iwkl->row_start; ?>" required>
								</div>

								<label for="Col">Row end<span class="text-danger">*</span></label>
								<div class="form-group">
									<input class="form-control nama_lengkap" type="number" id="col" name="row_end_<?= $setting_iwkl->id; ?>" value="<?= $setting_iwkl->row_end; ?>" required>
								</div>


							<?php endforeach; ?>


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
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
				<?php $this->load->view('pengentry/_partials/footer') ?>
			</div>

	</main>





	<div class="fixed-plugin">
		<?php $this->load->view('pengentry/_partials/settingbar') ?>
	</div>

	<!-- Load file javascript untuk sweet alert dan jquery -->
	<?php $this->load->view('pengentry/_partials/myjs') ?>
	<!--   Core JS Files   -->
	<?php $this->load->view('pengentry/_partials/js') ?>
	<!-- Bootstrap 3.3.2 JS -->
	<script src="<?php echo base_url(); ?>assets/assets/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- pengentryLTE App -->
	<script src="<?php echo base_url(); ?>assets/assets/js/app.min.js" type="text/javascript"></script>






	<!-- Fungsi memunculkan allert gagal -->
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
