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
							<h3 id="h1">Result</h3>

							<!-- Div flash data -->
							<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('message'); ?>"></div>

						</div>
						<div class="container-md containerku">
							<?php

							if ($result == null) { ?>

								<div class="text-center">
									<div class="d-flex justify-content-center"><lottie-player src="https://assets6.lottiefiles.com/packages/lf20_agnejizn.json" mode="bounce" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player></div>
								</div>

								<div class='text-warning text-center mt-3'>
									<h5>Data tidak ditemukan!</h5>
									<p>Maaf, data yang anda cari tidak ditemukan. Silahkan coba lagi.</p>
								</div>
								<div class="text-center ">
									<a class="btn btn-primary d-flex justify-content-center w-100" href="<?= base_url('pengentry/Coklit/insert_data') ?>">Kembali</a>

								</div>
							<?php } else { ?>
								<div class="table-responsive  tb-iwkl p-0">
									<table class="table table-striped align-items-center mt-3 mb-0" id="tbl_result">
										<thead>
											<tr>
												<th class="text-uppercase text-xxs font-weight-bolder ">No</th>
												<th class="text-uppercase text-xxs font-weight-bolder ">Tanggal Irms</th>
												<th class="text-uppercase text-xxs font-weight-bolder  ps-2">Korban Irms</th>
												<th class="text-uppercase text-xxs font-weight-bolder  ps-2">Cidera</th>
												<th class="text-uppercase text-xxs font-weight-bolder  ps-2">No LP</th>
												<th></th>

												<th class="text-uppercase text-xxs font-weight-bolder ">No</th>
												<th class="text-uppercase text-xxs font-weight-bolder ">Tanggal Dasi</th>
												<th class="text-uppercase text-xxs font-weight-bolder  ps-2">Korban Dasi</th>
												<th class="text-uppercase text-xxs font-weight-bolder  ps-2">Cidera</th>
												<th class="text-uppercase text-xxs font-weight-bolder  ps-2">No LP</th>

											</tr>
										</thead>

										<tbody>

											<?php $no = 1; ?>
											<?php $no_dasi = 1; ?>


											<?php

											$unique_names = array();
											$duplicate_names = array();
											$counter = 1;
											$unqiue_no_lp = array();
											$duplicate_no_lp = array();
											$counter_no_lp = 1;



											foreach ($result  as $r) { ?>
												<tr>

													<?php if ($r->irms_tanggal == null) { ?>
														<td class="bg-danger text-white "><?= $no++; ?></td>
													<?php } else { ?>
														<td><?= $no++; ?></td>
													<?php } ?>
													<?php if ($r->irms_tanggal == null) { ?>
														<td class="bg-warning "></td>
													<?php } else { ?>
														<td><?= $r->irms_tanggal; ?></td>
													<?php } ?>

													<?php if ($r->irms_nama_korban == null) { ?>
														<td class="bg-warning text-white ">Tidak ada data</td>
													<?php } else { ?>
														<td><?= $r->irms_nama_korban; ?></td>
													<?php } ?>

													<?php if ($r->irms_cidera == null) { ?>
														<td class="bg-warning "></td>
													<?php } else { ?>
														<td><?= $r->irms_cidera; ?></td>
													<?php } ?>

													<?php if ($r->irms_no_lp == null) { ?>
														<td class="bg-warning "></td>
													<?php } else { ?>
														<td><?= $r->irms_no_lp; ?></td>
													<?php } ?>

													<?php if ($r->irms_no_lp == null) { ?>
														<td class="bg-danger "></td>
													<?php } else { ?>
														<td></td>
													<?php } ?>

													<!-- Dasi -->

													<?php if ($r->dasi_no_lp == null) { ?>
														<td class="bg-danger text-white "><?= $no_dasi++; ?></td>
													<?php } else { ?>
														<td><?= $no_dasi++; ?></td>
													<?php } ?>

													<?php if ($r->dasi_tanggal == null) { ?>
														<td class="bg-warning "></td>
													<?php } else { ?>
														<td><?= $r->dasi_tanggal; ?></td>
													<?php } ?>

													<?php if ($r->dasi_nama_korban == null) { ?>
														<td class="bg-warning text-white ">Tidak ada data</td>
													<?php } else { ?>
														<td><?= $r->dasi_nama_korban; ?></td>
													<?php } ?>

													<!-- <?php
															$name = trim(preg_replace("/\([^)]+\)/", "", $r->dasi_nama_korban));
															$soundex = soundex($name);

															if (in_array($soundex, $unique_names)) {
																$duplicate_names[] = $name;
															} else {
																$unique_names[] = $soundex;
															}
															?>
													<?php if (in_array($name, $duplicate_names)) {
													?>
														<td class="bg-warning text-white "><?= $name . '(Duplikat)'; ?></td>
													<?php } else { ?>
														<td><?= $r->dasi_nama_korban; ?></td>
														}
													<?php } ?>

													<?php
													$counter++;


													?> -->






													<?php if ($r->dasi_cidera == null) { ?>
														<td class="bg-warning text-white "></td>
													<?php } else { ?>
														<td><?= $r->dasi_cidera; ?></td>
													<?php } ?>



													<?php if ($r->dasi_no_lp == null) { ?>
														<td class="bg-warning text-white "></td>
													<?php } else { ?>
														<td><?= $r->dasi_no_lp; ?></td>
													<?php } ?>


												</tr>



											<?php } ?>


										</tbody>
									</table>

									<div class="mt-4 w-100">
										<a class="btn  mt-2 btn-danger w-100" href="<?= base_url('pengentry/Coklit/delete/' . $irms_id . '/' . $dasi_id) ?>">Hapus</a>
									</div>

								</div>
							<?php }



							?>





							<!-- TABLE JUMLAH -->

							<div class="table-responsive mt-2 mb-2 tb-iwkl p-0">
								<h4 class="mt-2">Total Data</h4>
								<table class="table table-border-rounded align-items-center mt-3 mb-0" id="tbl_result2" style="border-radius: 20px;">
									<tbody>

										<tr>
											<td colspan="3" class="bg-warning text-white">
												<h6 class="text-white">Total IRMS MD : <?= $total_md_irms; ?></h6>
											</td>


											<td></td>
											<td></td>
											<td colspan="3" class="bg-warning text-white">
												<h6 class="text-white">Total DASI MD: <?= $total_md_dasi; ?></h6>
											</td>


										</tr>
										<tr>

											<td colspan="3" class="bg-primary text-white">
												<h6 class="text-white">Total IRMS LL: <?= $total_ll_irms; ?></h6>
											</td>

											<td></td>
											<td></td>
											<td colspan="3" class="bg-primary text-white">
												<h6 class="text-white">Total DASI LL: <?= $total_ll_dasi; ?></h6>
											</td>

										</tr>

									</tbody>
								</table>
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

	<script>
		$(document).ready(function() {
			$('#tbl_result').DataTable({
				lengthMenu: [
					[-1],
					["All"]
				]
			});


		});
	</script>


</body>

</html>