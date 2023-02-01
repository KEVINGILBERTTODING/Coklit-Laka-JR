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
	<?php $this->load->view('pelihat/_partials/header') ?>
</head>


<body class="g-sidenav-show   bg-gray-100">
	<div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
		<span class="mask bg-primary opacity-6"></span>
	</div>



	<?php $this->load->view('pelihat/_partials/sidebar') ?>

	<div class="main-content position-relative max-height-vh-100 h-100">

		<!-- Navbar -->
		<nav class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2 mt-n11">
			<div class="container-fluid py-1">

				<!-- Load breadcumb -->

				<?php $this->load->view('pelihat/_partials/breadcumb') ?>

				<!-- Load navbar -->
				<?php $this->load->view('pelihat/_partials/navbar') ?>


			</div>

		</nav>

		<!-- Isi content -->
		<div class="card shadow-lg mx-4 card-profile-bottom">
			<div class="card-body p-3 ">
				<div class="row gx-4">
					<div class="col-auto">
						<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('message'); ?>"></div>
						<div class="avatar avatar-xl position-relative">
							<img src="<?php echo base_url('uploads/photo_profile/') . $detail_user['photo_profile']; ?>" alt="profile_image" class="w-200 border-radius-lg shadow-sm img-fluid">
						</div>
					</div>
					<div class="col-auto my-auto">
						<div class="h-100">
							<h5 class="mb-1">
								<?= $detail_user['nama_lengkap']; ?>
							</h5>


							<button class="btn btn-primary btn-sm ms-auto mt-2" data-bs-toggle="modal" data-bs-target="#editphotoProfile">Ganti profile</button>

						</div>
					</div>
					<div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
						<div class="nav-wrapper position-relative end-0">
							<ul class="nav p-1">
								<button class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#updatePassword">Ubah Kata Sandi</button>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="container-fluid py-4">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header pb-0">
							<div class="d-flex align-items-center">
								<p class="mb-0">Ubah Profil</p>
							</div>
						</div>
						<div class="card-body">
							<p class="text-uppercase text-sm">Informasi Pengguna</p>
							<?php echo form_open_multipart('pelihat/profile/update_profile'); ?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="example-text-input" class="form-control-label">Username</label>
										<input class="form-control" name="username" type="text" value="<?= $detail_user['username']; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="example-text-input" class="form-control-label">Alamat Email</label>
										<input class="form-control" name="email" type="email" value="<?= $detail_user['email']; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="example-text-input" class="form-control-label">Nama Lengkap</label>
										<input class="form-control" name="nama_lengkap" type="text" value="<?= $detail_user['nama_lengkap']; ?>">
									</div>
								</div>
								<button type="submit" class="btn btn-primary btn-sm ms-auto" onclick="return confirm('Apakah anda yakin ingin mengubah data ini?');">Simpan</button>

							</div>
							<?php echo form_close(); ?>
							<hr class="horizontal dark">

						</div>

						<div class="col-md-4">
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
				</div>

				<div class="col-md-3">
					<div class="card card-profile">
						<img src="<?php echo base_url('uploads/qrcode/') . $detail_user['file_qrcode']; ?>" alt="Image placeholder" class="card-img-top">
						<div class="row justify-content-center">
							<div class="col-4 col-lg-4 order-lg-2">
								<div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
									<a href="javascript:;">
										<img src="<?php echo base_url('uploads/photo_profile/') . $detail_user['photo_profile']; ?>" class="rounded-circle border border-2 border-white mt-3" width="80" height="80" alt="Image placeholder">
									</a>
								</div>
							</div>
						</div>
						<div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
							<div class="d-flex justify-content-between">
								<a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#updateqrcode">Upload</a>
								<a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i class="ni ni-collection"></i></a>
								<a href="<?php echo base_url('pelihat/profile/download_qrcode/') . $this->session->userdata('id') ?>" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block">Download</a>
								<a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i class="ni ni-email-83"></i></a>
							</div>
						</div>
						<div class="card-body pt-0">

							<div class="text-center mt-4">
								<h5>
									<?= $detail_user['nama_lengkap']; ?>
								</h5>
								<div class="h6 font-weight-300">
									<i class="ni location_pin mr-2"></i><?= $detail_user['email']; ?>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- END CONTENT -->

		<?php echo form_open_multipart('pelihat/profile/update_photo_profile'); ?>
		<div class="modal fade" id="editphotoProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog ">
				<div class="modal-content ">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Foto Profil</h5>

						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group" hidden>
							<input class="form-control" name="user_id" value="<?= $detail_user['user_id']; ?>" type="text" readonly>
						</div>

						<div class="modal-body">

							<div class="form-group ">


								<img src="<?= base_url('uploads/photo_profile/' . $detail_user['photo_profile']); ?>" class="img-fluid w-50" alt="QrCode">
								<h5 class="mt-3">Upload Foto Profil</h5>

								<input class="form-control" name="foto_profil" type="file" required>

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

	<!-- Modal entry detail user -->
	<?php echo form_open_multipart('pelihat/SendEmail'); ?>
	<div class="modal fade" id="updatePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="form-group" hidden>
						<input class="form-control user_id" id="user_id" name="user_id" value="<?= $this->session->userdata('id'); ?>" readonly>
					</div>

					<div class="div d-flex justify-content-center">
						<lottie-player class="text-center" src="https://assets6.lottiefiles.com/packages/lf20_msdmfngy.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
					</div>

					<h5>Masukkan Kata Sandi Baru</h5>

					<label for="jabatan">Kata Sandi <span class="text-danger">*</span></label>
					<div class="form-group">
						<input class="form-control password" type="password" id="password" name="password" value="">
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
					<button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
				</div>
			</div>
		</div>

	</div>
	<?php echo form_close(); ?>


	<!-- Modal entry detail user -->
	<?php echo form_open_multipart('pelihat/profile/update_qr_code'); ?>
	<div class="modal fade" id="updateqrcode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Qr code</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="form-group" hidden>
						<input class="form-control user_id" id="user_id" name="user_id" value="<?= $this->session->userdata('id'); ?>" readonly>
					</div>

					<div class="div d-flex justify-content-center">
						<lottie-player class="text-center" src="https://assets2.lottiefiles.com/temp/lf20_PFb8HA.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
					</div>

					<h5>Unggah file qrcode</h5>

					<label for="jabatan">File qrcode<span class="text-danger">*</span></label>
					<div class="form-group">
						<input class="form-control qrcode" type="file" id="qrcode" name="qrcode" value="">
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
					<button type="submit" class="btn btn-primary" data-bs-dismiss="modal" onclick="return confirm('Apakah anda yakin ingin mengupdate data ini?')">Update</button>
				</div>
			</div>
		</div>

	</div>
	<?php echo form_close(); ?>


	</div>

	</div>

	<div id="footer" class="mt-5">
		<?php $this->load->view('pelihat/_partials/footer') ?>
	</div>

	</main>



	<!-- Bootstrap 3.3.2 JS -->
	<script src="<?php echo base_url(); ?>assets/assets/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- pelihatLTE App -->
	<script src="<?php echo base_url(); ?>assets/assets/js/app.min.js" type="text/javascript"></script>


	<div class="fixed-plugin">
		<?php $this->load->view('pelihat/_partials/settingbar') ?>
	</div>
	<!--   Core JS Files   -->
	<?php $this->load->view('pelihat/_partials/js') ?>

	<!-- Load file javascript untuk sweet alert dan jquery -->
	<?php $this->load->view('pelihat/_partials/myjs') ?>


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
