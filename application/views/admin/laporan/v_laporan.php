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
							<h3 class="mb-2">Laporan Kegiatan</h3>

							<div class="row mt-3">
								<h6>Filter Berdasarkan</h6>
								<div class="col-md-3">
									<select class="form-select" name="filter_options" id="filter_options">
										<div class="form-control ">
											<option selected disabled>-- Filter --</option>
											<option value="Bulan realisasi">Bulan realisasi</option>
											<option value="Klasifikasi proposal">Klasifikasi pemohon bantuan</option>
											<option value="Klasifikasi program">Klasifikasi program</option>
											<option value="Loket proposal">Loket proposal</option>

									</select>
								</div>
							</div>


						</div>




						<!-- Div flash data -->
						<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('message'); ?>"></div>

						<!-- 
							 Search bar -->
						<div class="container">
							<form action="" method="GET" class=" mt-3">
								<div class="row" id="filter_bulan_kegiatan">
									<div class="col-md-2">

										<input type="text" placeholder="Pilih bulan dan tahun" class="form-control" name="bulan" id="datepicker" />
										<select class="form-select" name="query_klasifikasi" id="query_klasifikasi">
											<option selected disabled>-- Pilih Kategori --</option>

											<?php foreach ($klasifikasi_bantuan as $kb) : ?>
												<option value="<?php echo $kb->nama_pihak; ?>"><?php echo $kb->nama_pihak; ?></option>
											<?php endforeach; ?>
										</select>
										<select class="form-select" name="query_loket" id="query_loket">
											<option selected disabled>-- Pilih Kategori --</option>

											<?php foreach ($nama_loket as $nl) : ?>
												<option value="<?php echo $nl->nama_loket; ?>"><?php echo $nl->nama_loket; ?></option>
											<?php endforeach; ?>
										</select>

										<input class="form-control" name="klasifikasi_program" id="klasifikasi_program" readonly />




									</div>
									<div class="col-md-1">
										<button type="submit" value="Cari" id="search" class="btn btn-primary" ">
										<i class=" fas fa-search"></i>
										</button>
									</div>


								</div>

							</form>


						</div>

						<div class="container">

							<div class="card-body px-0 pt-0 pb-2 mt-5 container mb-4">
								<div class="table-responsive p-0">
									<table class="table table-bordered align-items-center table-hover mb-0 ">
										<thead class="table table-primary">
											<tr>
												<th class="text-uppercase text-xs font-weight-bolder text-center " rowspan="2">No</th>
												<th class="text-uppercase text-xs font-weight-bolder text-center " rowspan="2">No Proposal</th>
												<th class="text-uppercase text-xs font-weight-bolder text-center  ps-2" colspan="2">Asal Proposal</th>
												<th class="text-uppercase text-xs font-weight-bolder text-center  ps-2" rowspan="2">Bantuan yang diajukan</th>
												<th class="text-uppercase text-xs font-weight-bolder text-center text-center " rowspan="2">Loket PJ Proposal</th>
												<th class="text-uppercase text-xs font-weight-bolder text-center " rowspan="2">PJ Proposal</th>
												<th class="text-uppercase text-xs font-weight-bolder text-center " colspan="3">Bantuan yang disetujui</th>
												<th class="text-uppercase text-xs font-weight-bolder text-center " colspan="3">Manfaat Eksternal</th>
												<th class="text-uppercase text-xs font-weight-bolder text-center " colspan="2">Manfaat Internal</th>
												<th class="text-uppercase text-xs font-weight-bolder text-center " rowspan="2">Klasifikasi Program</th>

											</tr>

											<tr>
												<td class="text-uppercase text-xs font-weight-bolder text-center">
													Nama
												</td>

												<td class="text-uppercase text-xs font-weight-bolder text-center">
													Klasifikasi
												</td>

												<td class="text-uppercase text-xs font-weight-bolder text-center">
													Tgl Realisasi
												</td>

												<td class="text-uppercase text-xs font-weight-bolder text-center">
													Nominal
												</td>

												<td class="text-uppercase text-xs font-weight-bolder text-center">
													Bentuk
												</td>



												<td class="text-uppercase text-xs font-weight-bolder text-center">
													Pilar
												</td>

												<td class="text-uppercase text-xs font-weight-bolder text-center">
													TPB
												</td>

												<td class="text-uppercase text-xs font-weight-bolder text-center">
													Kode RAN
												</td>


												<td class="text-uppercase text-xs font-weight-bolder text-center">
													Bidang
												</td>

												<td class="text-uppercase text-xs font-weight-bolder text-center">
													Indikator
												</td>


											</tr>


										</thead>

										<tbody>
											<?php
											if ($proposal == null || $proposal == '') {
												echo '<tr><td class="text-center" colspan="10"><div class="d-flex justify-content-center"><lottie-player src="https://assets6.lottiefiles.com/packages/lf20_agnejizn.json" mode="bounce" background="transparent"  speed="1"  style="width: 250px; height: 200px;"  loop  autoplay></lottie-player></div></td></tr>';
												echo "<tr><td class='text-center' colspan='10'>Tidak ada data.</td></tr>";
											} else {
												$no = 1;
												foreach ($proposal as $p) : ?>
													<tr>
														<td class="text-center"><?= $no++; ?></td>
														<td><?= $p->no_proposal; ?></td>
														<td><?= $p->asal_proposal; ?></td>
														<td><?= $p->pihak_penerima_bantuan; ?></td>
														<td><?= $p->bantuan_diajukan; ?></td>
														<td><?= $p->nama_loket; ?></td>
														<td><?= $p->jabatan_pic; ?></td>
														<td><?= $p->tanggal_kegiatan; ?></td>
														<td>
															<?php
															$formatRupiah = number_format($p->nominal_bantuan, 0, ',', '.');
															echo "Rp. " . $formatRupiah;
															?>
														</td>
														<td><?= $p->jenis_bantuan; ?></td>
														<td><?= $p->pilar; ?></td>
														<td><?= $p->tpb; ?></td>
														<td><?= $p->ran; ?></td>
														<td><?= $p->bidang_manfaat_perusahaan; ?></td>
														<td><?= $p->indikator_manfaat_perusahaan; ?></td>
														<?php
														$skor_tertinggi = max($p->p, $p->r, $p->s, $p->v);
														?>
														<td class="text-center"><?php
																				if ($skor_tertinggi == $p->p) {
																					echo "P";
																				} elseif ($skor_tertinggi == $p->r) {
																					echo "R";
																				} elseif ($skor_tertinggi == $p->s) {
																					echo "S";
																				} elseif ($skor_tertinggi == $p->v) {
																					echo "V";
																				}

																				?></td>


													</tr>
											<?php endforeach;
											} ?>

										</tbody>
									</table>


								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id=" footer">
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

	<!-- Script date adminker jquery -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>



	<script>
		$(function() {
			$("#datepicker").datepicker({
				format: "mm/yyyy",
				startView: "months",
				minViewMode: "months"
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			$("#query_klasifikasi").change(function() {
				// Get the value of the selected option
				var option = $(this).val();
				// Send an AJAX request to the server with the selected option
				$.post("<?php echo base_url('admin/laporan/'); ?>", {
					option: option
				}, function(data) {});
			});
		});
	</script>




	<script>
		$(document).ready(function() {
			$("#query_klasifikasi").change(function() {
				// Get the value of the selected option
				var option = $(this).val();

				// Send an AJAX request to the server with the selected option
				$.post("<?php echo base_url('admin/laporan/'); ?>", {
					option: option
				}, function(data) {});
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			$("#query_loket").change(function() {
				// Get the value of the selected option
				var option = $(this).val();

				// Send an AJAX request to the server with the selected option
				$.post("<?php echo base_url('admin/laporan/'); ?>", {
					option: option
				}, function(data) {});
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			$("#datepicker").hide();
			$("#query_klasifikasi").hide();
			$("#query_loket").hide();
			$("#search").hide();
			$("#klasifikasi_program").hide();

		});
	</script>

	<script>
		$(document).ready(function() {
			$("#filter_options").change(function() {
				// Get the value of the selected option
				var option = $(this).val();

				if (option == "Bulan realisasi") {
					$("#datepicker").show();
					$("#query_klasifikasi").hide();
					$("#klasifikasi_program").hide();
					$("#query_loket").hide();
					$("#search").show();

				} else if (option == "Klasifikasi proposal") {
					$("#datepicker").hide();
					$("#query_klasifikasi").show();
					$("#klasifikasi_program").hide();
					$("#query_loket").hide();
					$("#search").show();

				} else if (option == "Loket proposal") {
					$("#datepicker").hide();
					$("#query_klasifikasi").hide();
					$("#klasifikasi_program").hide();
					$("#query_loket").show();
					$("#search").show();

				} else if (option == "Klasifikasi program") {
					$("#datepicker").hide();
					$("#query_klasifikasi").hide();
					$("#query_loket").hide();
					$("#klasifikasi_program").show();
					$("#klasifikasi_program").val("Semua");
					$("#search").show();

				} else {
					$("#datepicker").hide();
					$("#query_klasifikasi").hide();
					$("#query_loket").hide();
					$("#search").hide();
					$("#klasifikasi_program").hide();


				}
			});
		});
	</script>










</body>

</html>
