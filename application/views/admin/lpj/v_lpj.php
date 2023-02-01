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
						<div class="card-header pb-0">
							<h4 class="mb-2">Daftar LPJ Kegiatan</h4>
							<!-- Div flash data -->
							<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('message'); ?>"></div>

							<!--  Tombol tambah proposal -->
							<a href="<?php echo base_url('admin/lpj/realisasi') ?>" class="btn btn-icon mt-3 btn-3 btn-primary" role="button">
								<span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
								<span class="btn-inner--text">Entry Lpj Kegiatan</span>
							</a>
							<!-- Search bar -->
							<form action="" method="GET" class=" float-end mt-3">
								<div class="row ">
									<div class="col-md-9">
										<input type="search" class="form-control" name="keyword" placeholder="Cari proposal..." value="<?= html_escape($keyword) ?>">
									</div>
									<div class="col-md-1">
										<button type="submit" value="Cari" class="btn btn-primary" ">
										<i class=" fas fa-search"></i>
										</button>
									</div>
								</div>
							</form>


						</div>

						<div class="card-body px-0 pt-0 pb-2">
							<div class="table-responsive p-0">
								<table class="table align-items-center mb-0">
									<thead>
										<tr>
											<th class="text-uppercase text-xxs font-weight-bolder "></th>
											<th class="text-uppercase text-xxs font-weight-bolder ">No Urut Proposal</th>
											<th class="text-uppercase text-xxs font-weight-bolder  ps-2">Asal Proposal</th>
											<th class="text-uppercase text-xxs font-weight-bolder  ps-2">Bantuan yang diajukan</th>
											<th class="text-uppercase text-xxs font-weight-bolder ">Progress</th>
											<th class="text-uppercase text-xxs font-weight-bolder ">Status</th>
											<th class="text-uppercase text-xxs font-weight-bolder ">Aksi</th>
											<th class=""></th>
										</tr>
									</thead>

									<tbody>

										<?php

										// Validasi jika data kosong
										if ($proposal == null) {
											echo '<tr><td class="text-center" colspan="8"><div class="d-flex justify-content-center"><lottie-player src="https://assets6.lottiefiles.com/packages/lf20_agnejizn.json" mode="bounce" background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player></div></td></tr>';
											echo "<tr><td class='text-center' colspan='8'>Tidak ada data.</td></tr>";
										} else {

											foreach ($proposal as $p) : ?>
												<tr>

													<!-- Kolom nomor -->
													<td>
														<div class="d-flex px-2 py-1">
															<div class="d-flex flex-column justify-content">
																<!-- Menampilkan badge baru jika proposal baru di update -->
																<?php


																foreach ($lpj as $km) : ?>
																	<?php
																	if ($km->proposal_id == $p->proposal_id) {

																		$tgl = $km->date_created;
																		$jumlah = 7;
																		$format = 'day';
																		$currentDate = $tgl;
																		$manipulasiTanggal  = date('Y-m-d', strtotime($jumlah . ' ' . $format, strtotime($currentDate)));

																		if ($manipulasiTanggal >= date('Y-m-d')) {
																			echo '<span class="badge bg-gradient-success ms-2">Baru</span>';
																		} else {
																			echo '';
																		}
																	} else {
																		echo '';
																	}

																	?>
																<?php endforeach; ?>
															</div>
														</div>
													</td>

													<!-- Kolom no urut proposal -->
													<td>
														<div class="d-flex px-2 py-1">

															<div class="d-flex flex-column justify-content-center">
																<h6 class="mb-0 text-sm"><?php echo $p->no_urut_proposal ?></h6>
															</div>
														</div>
													</td>

													<!-- Kolom asal proposal -->
													<td>
														<div class="d-flex flex-column justify-content-center">
															<h6 class="mb-0 text-sm"><?php echo $p->asal_proposal ?></h6>
														</div>
													</td>

													<!-- Kolom bantuan yang diajukan -->
													<td>
														<div class="d-flex flex-column justify-content-center">
															<h6 class="mb-0 text-sm"><?php echo $p->bantuan_diajukan ?></h6>
														</div>
													</td>

													<!-- Kolom progress -->

													<td class="align-middle text-center">
														<div class="d-flex align-items-center justify-content-center">
															<span class="me-2 text-xs font-weight-bold"><?= $p->progress; ?>%</span>
															<div>
																<div class="progress">
																	<div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?= $p->progress; ?>%;"></div>
																</div>
															</div>
														</div>
													</td>

													<!-- Kolom status -->
													<td>
														<?php

														if ($p->status == 'Ditolak') {
															echo '<span class="badge badge-sm bg-gradient-danger">Ditolak</span>';
														} elseif ($p->status == 'Diterima') {
															echo '<span class="badge badge-sm bg-gradient-success">Diterima</span>';
														} else {
															echo '<span class="badge badge-sm bg-gradient-warning">Menunggu</span>';
														}
														?>
													</td>

													<!-- Kolom aksi -->
													<td>

														<a href="<?php echo base_url('admin/lpj/detail/' . $p->proposal_id) ?>" class="btn btn-icon btn-2 btn-primary" role="button">
															<span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
														</a>

														<a href="<?php echo base_url('admin/lpj/update/' . $p->proposal_id) ?>" class="btn btn-icon btn-2 btn-warning" role="button">
															<span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
														</a>

													</td>
												</tr>


										<?php endforeach;
										} ?>

									</tbody>
								</table>
								<?= $this->pagination->create_links(); ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="footer">
			<?php $this->load->view('admin/_partials/footer') ?>
		</div>


	</main>




	<div class="fixed-plugin">
		<?php $this->load->view('admin/_partials/settingbar') ?>
	</div>
	<!--   Core JS Files   -->
	<?php $this->load->view('admin/_partials/js') ?>

	<!-- Load file javascript untuk sweet alert -->
	<?php $this->load->view('admin/_partials/myjs') ?>



</body>

</html>
