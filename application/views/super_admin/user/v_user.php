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
	<?php $this->load->view('super_admin/_partials/header') ?>
</head>


<body class="g-sidenav-show   bg-gray-100">
	<div class="min-height-300 bg-primary position-absolute w-100"></div>

	<?php $this->load->view('super_admin/_partials/sidebar') ?>

	<main class="main-content position-relative border-radius-lg ">

		<!-- Navbar -->
		<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
			<div class="container-fluid py-1 px-3">

				<!-- Load breadcumb -->

				<?php $this->load->view('super_admin/_partials/breadcumb') ?>

				<!-- Load navbar -->
				<?php $this->load->view('super_admin/_partials/navbar') ?>

			</div>

		</nav>

		<!-- Isi content -->
		<div class="card shadow-lg mx-4 mb-4 ">
			<div class="row">
				<div class="col-12">
					<div class="card mb-4">
						<div class="card-header pb-0">
							<h4 class="mb-2">Daftar User</h4>
							<!-- Div flash data -->
							<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('message'); ?>"></div>
							<!--  Tombol tambah proposal -->
							<!-- <a href="<?php echo base_url('super_admin/survey/getKajianManfaat') ?>" class="btn btn-icon mt-3 btn-3 btn-primary" role="button">
								<span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
								<span class="btn-inner--text">Tambah User</span>
							</a> -->


						</div>

						<div class="container mt-5">

							<!-- // Validasi jika data kosong -->
							<?php
							if ($user == null) {
								echo '<tr><td class="text-center" colspan="8"><div class="d-flex justify-content-center"><lottie-player src="https://assets6.lottiefiles.com/packages/lf20_agnejizn.json" mode="bounce" background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player></div></td></tr>';
								echo "<tr><td class='text-center' colspan='8'>Tidak ada data.</td></tr>";
							} else {

								echo '<div class="row">';


								foreach ($user as $u) : ?>

									<div class="col-md-3 mt-3">
										<div class="card card-profile" style="width: 15rem;">
											<img src="<?php echo base_url('uploads/photo_profile/') . $u->photo_profile; ?>" class="card-img-top" alt="Image placeholder" class="card-img-top">

											<div class="card-body pt-0">

												<div class="text-center mt-4">
													<h5>
														<?= $u->nama; ?>
													</h5>


													<?php if ($u->user_status == 1) { ?>
														<a href="<?php echo base_url('super_admin/user/disableuser/' . $u->user_id) ?>" class="btn btn-sm btn-danger  me-4 " onclick="return confirm('Apakah anda yakin ingin menonaktifkan user ini?')">Nonaktifkan</a>
													<?php } else { ?>
														<a href="<?php echo base_url('super_admin/user/enableuser/' . $u->user_id) ?>" class="btn btn-sm btn-success  me-4 " onclick="return confirm('Apakah anda yakin ingin mengaktifkan user ini?')">Aktifkan</a>
													<?php } ?>

													<button class="btn btn-sm btn-info  me-4 btnUpdate" data-bs-toggle="modal" data-bs-target="#updatePassword" data-id="<?= $u->user_id; ?>">Update Password</button>

												</div>
											</div>
										</div>
									</div>





							<?php endforeach;
							} ?>

						</div>


					</div>
				</div>

				<?= $this->pagination->create_links(); ?>

			</div>
		</div>
		</div>
		</div>
		</div>

		</div>

		<!-- Modal entry detail user -->
		<?php echo form_open_multipart('super_admin/sendemail'); ?>
		<div class="modal fade" id="updatePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group" hidden>
							<input class="form-control user_id" id="user_id" name="user_id" value="" readonly>
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


		<!-- Form alert email -->

		<div class=" modal fade" id="alertEmail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Pemberitahuan</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-body">

						<div class="form-group  d-flex justify-content-center">
							<div class="row">
								<div class="col">

									<lottie-player src="https://assets2.lottiefiles.com/private_files/lf30_nsqfzxxx.json" id="anim_email_success" background="transparent" speed="1" style="width: 200px; height: 200px;" loop autoplay></lottie-player>

									<lottie-player src=" https://assets10.lottiefiles.com/packages/lf20_tl52xzvn.json" id="anim_email_failed" background="transparent" speed="1" style="width: 150px; height: 150px;" loop autoplay></lottie-player>

									<h5><?= $this->session->flashdata('send_email'); ?></h5>
								</div>
							</div>
						</div>
						<div class="modal-body">
						</div>

					</div>
					<div class="modal-footer">

						<?php
						$user_id_email = $this->session->flashdata('email_user_id');
						if ($user_id_email == '') { ?>
							<button type="button" class="btn btn-primary" data-bs-dismiss="modal" disabled><i class="fas fa-redo"> Kirim Lagi</i> </button>

						<?php } else { ?>
							<a href="<?= base_url('super_admin/sendemail/index/' . $this->session->flashdata('email_user_id')) ?>" class="btn btn-primary"><i class="fas fa-redo "></i> Kirim Lagi</a>
							<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>

						<?php } ?>
					</div>
				</div>
			</div>

		</div>

		<div id="footer">
			<?php $this->load->view('super_admin/_partials/footer') ?>
		</div>


	</main>

	<div class="fixed-plugin">
		<?php $this->load->view('super_admin/_partials/settingbar') ?>
	</div>
	<!--   Core JS Files   -->
	<?php $this->load->view('super_admin/_partials/js') ?>

	<!-- Load file javascript untuk sweet alert -->
	<?php $this->load->view('super_admin/_partials/myjs') ?>


	<script>
		$(document).ready(function() {
			$('.btnUpdate').on('click', function() {
				const user_id = $(this).data('id');

				$('.user_id').val(user_id);


			});
		});
	</script>


	<!-- Function alert show jika kirim email -->
	<!-- Fungsi memunculkan allert success saat berhasil merubah data -->
	<?php
	$status_failed =  $this->session->flashdata('send_email');
	$status_success =  $this->session->flashdata('send_email');

	if (isset($status_success)) {

	?>
		<script>
			$(document).ready(function() {
				$('#alertEmail').modal('show');
				$('#anim_email_success').show();
				$('#anim_email_failed').hide();

			});
		</script>
	<?php
	} else if (isset($status_failed)) {
	?>
		<script>
			$(document).ready(function() {
				$('#alertEmail').modal('show');
				$('#anim_email_success').hide();
				$('#anim_email_failed').show();
			});
		</script>
	<?php
	}
	?>





</body>

</html>
