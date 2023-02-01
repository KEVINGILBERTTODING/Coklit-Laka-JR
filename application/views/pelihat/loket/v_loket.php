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
							<h2>Daftar Loket</h2>
						</div>

						<div class="card-body px-0 pt-0 pb-2">
							<div class="table-responsive p-0">
								<table class="table align-items-center mb-0" id="tableLoket">
									<thead>
										<tr>
											<th class="text-uppercase text-xxs font-weight-bolder">No</th>
											<th class="text-uppercase text-xxs font-weight-bolder ">Kode Loket</th>
											<th class="text-uppercase text-xxs font-weight-bolder  ps-2">Nama Loket</th>
											<th class="text-uppercase text-xxs font-weight-bolder  ps-2">Alamat</th>
											<th class="text-uppercase text-xxs font-weight-bolder ">Aksi</th>
											<th class=""></th>
										</tr>
									</thead>
									<?php $no = 1; ?>
									<?php foreach ($loket as $loket) : ?>
										<tr>
											<td>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm"><?= $no++; ?></h6>
												</div>
											</td>
											<td>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm"><?= $loket->loket_id; ?></h6>
												</div>
											</td>
											<td>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm"><?= $loket->nama_loket; ?></h6>
												</div>
											</td>
											<td>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm"><?= $loket->alamat_loket; ?></h6>
												</div>
											</td>
											<td>

												<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editLoket<?= $loket->loket_id; ?>">
													<i class="fas fa-edit"></i>
												</button>
											</td>

										</tr>


										<?php echo form_open_multipart('admin/loket/updateLoket/' . $loket->loket_id); ?>
										<div class="modal fade" id="editLoket<?= $loket->loket_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog ">
												<div class="modal-content ">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Ubah Detail Loket</h5>

														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<div class="form-group">
															<label for="kode_loket">Kode Loket</label>
															<input class="form-control kode_loket" id="kode_loket" name="kode_loket" value="<?= $loket->loket_id; ?>" readonly>
														</div>

														<div class="form-group">
															<label for="nama_loket">Nama Loket</label>
															<input class="form-control nama_loket" id="nama_loket" name="nama_loket" value="<?= $loket->nama_loket; ?>">
														</div>

														<div class=" form-group ">
															<label for="exampleFormControlTextarea1">Alamat</label>
															<textarea class="form-control" name="alamat_loket" id="exampleFormControlTextarea1" rows="3" required><?= $loket->alamat_loket; ?></textarea>
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


									<?php endforeach; ?>

									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		</div>

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
		$(document).ready(function() {
			console.log("ready!");
		});
	</script>



</body>

</html>
