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
							<h4 class="mb-2">Daftar Pendapat & Tanggapan</h4>
							<!-- Div flash data -->
							<div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('message'); ?>"></div>


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
																foreach ($pendapat as $km) : ?>
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

														<?php foreach ($hasil_survey as $hs) : ?>

															<!-- Mengambil data pendapat tanggapan dari database dan menampilkannya dalam modal -->
															<?php
															if ($p->proposal_id == $hs->proposal_id) { ?>

																<?php foreach ($pendapat  as $pd) : ?>
																	<?php
																	if ($p->proposal_id == $pd->proposal_id) {
																		// Validasi jika telah menginput sebelumnya maka muncul button edit

																		echo '<button type="button" class="btn btn-warning btn btnDetail btn btn-icon mr-5 " data-bs-toggle="modal" data-bs-target="#detailPendapat" data-proposal_id="' . $p->proposal_id . '" data-no_urut_proposal="' . $p->no_urut_proposal . '" data-nama_petugas_survey="' . $hs->nama_petugas_survey . '" data-jabatan="' . $hs->jabatan . '" data-kelayakan="' . $hs->kelayakan . '" data-bentuk_bantuan="' . $hs->bentuk_bantuan . '" data-nilai_pengajuan="' . $hs->nilai_pengajuan . '" data-barang_diajukan="' . $hs->barang_diajukan . '" data-pendapat_kasubag="' . $pd->pendapat_kasubag . '" data-nilai_kasubag="' . $pd->nilai_pengajuan_kasubag . '" data-pendapat_kabag ="' . $pd->pendapat_kabag .  '" data-nilai_kabag ="' . $pd->nilai_pengajuan_kabag . '" data-pendapat_kacab="' . $pd->pendapat_kacab . '" data-tanggapan_kacab ="' . $pd->tanggapan_kacab . '" data-nilai_kacab ="' . $pd->nilai_pengajuan_kacab . '" ><i class="fas fa-eye"></i></button>';
																	} else {
																	}
																	?>

																	<?php
																	if ($p->proposal_id == $pd->proposal_id) {
																		// Validasi jika telah menginput sebelumnya maka muncul button edit
																		echo '<a href="' . base_url('admin/realisasi/create/' . $p->proposal_id) . '" class="btn btn-primary btn btn-icon mr-5">Pilih</i></a>';
																	} else {
																	}
																	?>

																<?php endforeach; ?>



															<?php } else { ?>

															<?php } ?>



														<?php endforeach; ?>

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



		<!-- Modal detail -->
		<div class=" modal fade" id="detailPendapat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Detail Pendapat & Tanggapan</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">

						<div class="form-group  d-flex justify-content-center">
							<div class="row">
								<div class="col">
									<lottie-player src="https://assets9.lottiefiles.com/packages/lf20_s2lryxtd.json" id="animDiterima" background="transparent" speed="1" style="width: 150px; height: 150px;" loop autoplay></lottie-player>

									<lottie-player src="https://assets10.lottiefiles.com/packages/lf20_tl52xzvn.json" id="animDitolak" background="transparent" speed="1" style="width: 120px; height: 120px;" loop autoplay></lottie-player>

									<div class="col">
										<h6 class="text-center text-success" id="txtDiterima">Diterima</h6>
										<h6 class="text-center text-danger" id="txtDitolak">Ditolak</h6>
									</div>

								</div>
							</div>
						</div>


						<div class="modal-body">

							<h6>A. Petugas Survey</h6>
							<div class="form-group" hidden>
								<input class="form-control proposal_id" id="proposal_id" name="proposal_id" value="" readonly>
							</div>

							<div class="form-group" hidden>
								<input class="form-control no_urut_proposal" id="no_urut_proposal" name="no_urut_proposal" value="" readonly>
							</div>

							<label for="nama_petugas_survey">Nama Petugas Survey <span class="text-danger">*</span></label>
							<div class="form-group">
								<input class="form-control nama_petugas_survey" id="nama_petugas_survey" name="nama_petugas_survey" value="" readonly>
							</div>

							<label for="jabatan">Jabatan <span class="text-danger">*</span></label>
							<div class="form-group">
								<input class="form-control jabatan" id="jabatan" name="jabatan" value="" readonly>
							</div>

							<label for="kelayakan">Kelayakan <span class="text-danger">*</span></label>
							<div class="form-group">
								<input class="form-control kelayakan" id="kelayakan" name="kelayakan" value="" readonly>
							</div>

							<label for="bentuk_bantuan">Bentuk Bantuan <span class="text-danger">*</span></label>
							<div class="form-group">
								<input class="form-control bentuk_bantuan" id="bentuk_bantuan" name="bentuk_bantuan" value="" readonly>
							</div>



							<label for="nilai_pengajuan">Nilai Pengajuan <span class="text-danger">*</span></label>
							<div class="form-group">
								<input class="form-control nilai_pengajuan" type="number" id="nilai_pengajuan" name="nilai_pengajuan" value="" readonly>
							</div>


							<div class="form-group">
								<label for="exampleFormControlTextarea1">Barang yang diajukan <span class="text-danger">*</span></label>
								<textarea class="form-control barang_yang_diajukan" name="barang_yang_diajukan" id="barang_yang_diajukan" rows="3" readonly></textarea>
							</div>

							<h6>B. Pendapat dan Tanggapan</h6>

							<div class="form-group mt-2">
								<h6>1. Kasubag TJSL</h6>
								<p></p>

							</div>

							<div class="row">
								<div class="col-md-9">
									<label for="nama_kasubag_tjsl">Nama Kasubag TJSL <span class="text-danger">*</span></label>
									<div class="form-group">

										<?php
										$nama_kasubag = isset($kasubag['nama_lengkap']) ? $kasubag['nama_lengkap'] : null;
										if ($nama_kasubag == null) {
											echo '<input class="form-control nama_kasubag_tjsl2" id="nama_kasubag_tjsl" name="nama_kasubag_tjsl" value="Belum Ada Kasubag TJSL" readonly>';
										} else {
											echo '<input class="form-control nama_kasubag_tjsl2" id="nama_kasubag_tjsl" name="nama_kasubag_tjsl" value="' . $nama_kasubag . '" readonly>';
										}
										?>
									</div>
								</div>
								<div class="col-md-3 ms-auto">
									<?php $qrcode_kasubag = isset($kasubag['file_qrcode']) ? $kasubag['file_qrcode'] : null; ?>

									<?php

									if ($qrcode_kasubag == null) {
										echo '<lottie-player src="https://assets9.lottiefiles.com/temporary_files/b7BtQW.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>';
									} else {
										echo '<img src="' . base_url('uploads/qrcode/' . $qrcode_kasubag) . '" class="img-fluid qrcode_kasubag2" alt="QrCode">';
									}
									?>

								</div>

							</div>



							<label for="jabatan_kasubag">Jabatan<span class="text-danger">*</span></label>
							<div class="form-group">
								<?php
								$jabatan_kasubag = isset($kasubag['jabatan']) ? $kasubag['jabatan'] : '';
								if ($jabatan_kasubag == null) {
									echo '<input class="form-control jabatan_kasubag2" id="jabatan_kasubag" name="jabatan_kasubag" value="Belum Ada Kasubag TJSL" readonly>';
								} else {
									echo '<input class="form-control jabatan_kasubag2" id="jabatan_kasubag" name="jabatan_kasubag" value="' . $kasubag['jabatan'] . '" readonly>';
								}
								?>
							</div>

							<div class="form-group">

								<label for="exampleFormControlTextarea1">Pendapat <span class="text-danger">*</span></label>
								<textarea class="form-control pendapat_kasubag2" name="pendapat_kasubag" id="pendapat_kasubag" rows="3"></textarea>
							</div>

							<label for="nilai_pengajuan_kasubag">Nilai Pengajuan<span class="text-danger">*</span></label>
							<div class="form-group">
								<input type="number" class="form-control nilai_pengajuan_kasubag2" id="nilai_pengajuan_kasubag" name="nilai_pengajuan_kasubag" value="">
							</div>


							<!-- KABAG ADMIN -->

							<div class="form-group mt-2">
								<h6>2. Kabag Admin</h6>
								<p></p>

							</div>
							<div class="row">
								<div class="col-md-9">
									<label for="nama_kabag_admin">Nama Kabag Admin <span class="text-danger">*</span></label>
									<div class="form-group">
										<?php
										$nama_kabag = isset($kabag['nama_lengkap']) ? $kabag['nama_lengkap'] : '';
										if ($nama_kabag == null) {
											echo '<input class="form-control nama_kabag_admin2" id="nama_kabag_admin" name="nama_kabag_admin" value="Belum Ada Kabag Admin" readonly>';
										} else {
											echo '<input class="form-control nama_kabag_admin2" id="nama_kabag_admin" name="nama_kabag_admin" value="' . $kabag['nama_lengkap'] . '" readonly>';
										}
										?>

									</div>
								</div>
								<div class="col-md-3 ms-auto">
									<?php
									$qrcode_kabag = isset($kabag['file_qrcode']) ? $kabag['file_qrcode'] : '';
									if ($qrcode_kabag == null) {
										echo '<lottie-player src="https://assets9.lottiefiles.com/temporary_files/b7BtQW.json"  background="transparent"  speed="1"  style="width: 90px; height: 90px;"  loop  autoplay></lottie-player>';
									} else {
										echo '<img src="' . base_url('uploads/qrcode/' . $qrcode_kabag) . '" class="img-fluid qrcode_kabag2" alt="QrCode">';
										// echo '<img src="' . base_url('uploads/qrcode/' . $qrcode_kasubag) . '" class="img-fluid qrcode_kasubag" alt="QrCode">';
									}
									?>
								</div>
							</div>



							<label for="jabatan_kabag_admin">Jabatan<span class="text-danger">*</span></label>
							<div class="form-group">
								<?php
								$jabatan_kabag = isset($kabag['jabatan']) ? $kabag['jabatan'] : '';
								if ($jabatan_kabag == null) {
									echo '<input class="form-control jabatan_kabag_admin2" id="jabatan_kabag_admin" name="jabatan_kabag_admin" value="Belum Ada Kabag Admin" readonly>';
								} else {
									echo '<input class="form-control jabatan_kabag_admin2" id="jabatan_kabag_admin" name="jabatan_kabag_admin" value="' . $jabatan_kabag . '" readonly>';
								}
								?>

							</div>

							<div class="form-group">
								<label for="exampleFormControlTextarea1">Pendapat <span class="text-danger">*</span></label>
								<textarea class="form-control pendapat_kabag_admin2" name="pendapat_kabag_admin" id="pendapat_kabag_admin" rows="3"></textarea>
							</div>

							<label for="nilai_pengajuan_kabag_admin">Nilai Pengajuan<span class="text-danger">*</span></label>
							<div class="form-group">
								<input type="number" class="form-control nilai_pengajuan_kabag_admin2" id="nilai_pengajuan_kabag_admin" name="nilai_pengajuan_kabag_admin" value="">
							</div>

							<!-- KACAB -->

							<div class="form-group mt-2">
								<h6>3. Kepala Cabang</h6>
								<p></p>

							</div>
							<div class="row">
								<div class="col-md-9">
									<label for="nama_kacab">Nama Kepala Cabang <span class="text-danger">*</span></label>
									<div class="form-group">
										<?php
										$nama_kacab = isset($kacab['nama_lengkap']) ? $kacab['nama_lengkap'] : '';
										if ($nama_kacab == null) {
											echo '<input class="form-control nama_kacab2" id="nama_kacab" name="nama_kacab" value="Belum Ada Kacab" readonly>';
										} else {
											echo '<input class="form-control nama_kacab2" id="nama_kacab" name="nama_kacab" value="' . $nama_kacab . '" readonly>';
										}
										?>
									</div>
								</div>
								<div class="col-md-3 ms-auto">

									<?php
									$qrcode_kacab = isset($kacab['file_qrcode']) ? $kacab['file_qrcode'] : '';
									if ($qrcode_kacab == null) {
										echo '<lottie-player src="https://assets9.lottiefiles.com/datafiles/dCoEZJcl8sFV0r4/data.json"  background="transparent"  speed="1"  style="width: 90px; height: 90px;"  loop  autoplay></lottie-player>';
									} else {
										echo '<img src="' . base_url('uploads/qrcode/' . $qrcode_kacab) . '" class="img-fluid qrcode_kacab2" alt="QrCode">';
									}
									?>

								</div>
							</div>


							<label for="jabatan_kacab">Jabatan<span class="text-danger">*</span></label>
							<div class="form-group">
								<?php
								$jabatan_kacab = isset($kacab['jabatan']) ? $kacab['jabatan'] : '';
								if ($jabatan_kacab == null) {
									echo '<input class="form-control jabatan_kacab2" id="jabatan_kacab" name="jabatan_kacab" value="Belum Ada kacab TJSL" readonly>';
								} else {
									echo '<input class="form-control jabatan_kacab2" id="jabatan_kacab" name="jabatan_kacab" value="' . $nama_kacab . '" readonly>';
								}
								?>

							</div>

							<div class="form-group">
								<label for="exampleFormControlTextarea1">Pendapat <span class="text-danger">*</span></label>
								<textarea class="form-control pendapat_kacab2" name="pendapat_kacab" id="pendapat_kacab" rows="3"></textarea>
							</div>

							<div class="form-group">
								<label for="example-search-input" class="form-control-label">
									Tanggapan <span class="text-danger">*</span>
								</label>
								<select class="form-select tanggapan2" id="tanggapan" name="tanggapan" aria-label="Default select example">
									<option selected disabled value="">Pilih Tanggapan</option>
									<option value="Diterima">Diterima</option>
									<option value="Ditolak">Ditolak</option>
								</select>
							</div>

							<label for="nilai_pengajuan_kacab">Nilai Pengajuan<span class="text-danger">*</span></label>
							<div class="form-group">
								<input type="number" class="form-control nilai_pengajuan_kacab2" id="nilai_pengajuan_kacab" name="nilai_pengajuan_kacab" value="">
							</div>

						</div>

					</div>
					<div class="modal-footer">

						<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>

					</div>
				</div>
			</div>
		</div>

		<!-- Modal entry Realisasi Bantuan -->
		<?php echo form_open_multipart('admin/realisasi/insert/'); ?>
		<div class=" modal fade" id="insertRealisasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Entry Realisasi Bantuan</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="modal-body">

							<div class="form-group" hidden>
								<input class="form-control proposal_id" id="proposal_id" name="proposal_id" value="" readonly>
							</div>

							<div class="form-group">
								<label for="example-date-input" class="form-control-label">No Urut Proposal</label>
								<input class="form-control no_urut_proposal" id="no_urut_proposal" name="no_urut_proposal" value="" readonly>
							</div>

							<div class="form-group">
								<label for="example-date-input" class="form-control-label">Tanggal Kegiatan</label>
								<input class="form-control" name="tgl_kegiatan" type="date" value="" id="example-date-input" required>
							</div>

							<div class="form-group">
								<label for="example-date-input" class="form-control-label">Tempat Kegiatan</label>
								<input class="form-control tempat_kegiatan" id="tempat_kegiatan" name="tempat_kegiatan" value="">
							</div>

							<label for="nominal_bantuan" class="form-control-label">Nominal Bantuan</label>
							<div class="input-group form-group ">

								<span class="input-group-text">Rp</span>
								<input class="form-control uang" id="nominal_bantuan" aria-label="Amount (to the nearest dollar)" name="nominal_bantuan" value="" required>
							</div>

							<div class="form-group ">
								<label for="jenis_bantuan" class="form-control-label">Jenis Bantuan</label>
								<select class="form-select" id="jenis_bantuan" name="jenis_bantuan" aria-label="Default select example" required>
									<option disabled selected>-- Jenis --</option>
									<option value="Uang Tunai">Uang Tunai</option>
									<option value="Barang">Barang</option>
								</select>
							</div>

							<div class="form-group" id="barang">
								<label for="jenis_bantuan" class="form-control-label">Barang Berupa</label>
								<input class="form-control barang_berupa" id="barang_berupa" name="barang_berupa" value="">
							</div>

							<div class="form-group">
								<label for="example-search-input" class="form-control-label mt-3">
									Foto Kegiatan <span class="text-danger">File harus berformat .jpg, png, jpeg *</span>
								</label>
								<input class="form-control" name="foto_kegiatan" type="file" id="foto_kegiatan" required>
							</div>

							<div class="form-group">
								<label for="example-search-input" class="form-control-label mt-3">
									Link Berita <span class="text-danger">File harus berformat .jpg, png, jpeg, pdf *</span>
								</label>
								<input class="form-control" name="link_berita" type="file" id="link_berita" required>
							</div>

							<div class="form-group">
								<label for="example-search-input" class="form-control-label mt-3">
									Kuitansi <span class="text-danger">File harus berformat .jpg, png, jpeg, pdf *</span>
								</label>
								<input class="form-control" name="kuitansi" type="file" id="kuitansi" required>
							</div>


							<div class="form-group">
								<label for="example-search-input" class="form-control-label mt-3">
									BAST <span class="text-danger">File harus berformat .jpg, png, jpeg, pdf *</span>
								</label>
								<input class="form-control" name="bast" type="file" id="bast" required>
							</div>

							<div class="form-group">
								<label for="example-search-input" class="form-control-label mt-3">
									SPT <span class="text-danger">File harus berformat .jpg, png, jpeg, pdf *</span>
								</label>
								<input class="form-control" name="spt" type="file" id="spt" required>
							</div>

							<div class="form-group">
								<label for="example-search-input" class="form-control-label mt-3">
									Bukti Pembayaran (ERP)<span class="text-danger"> File harus berformat .jpg, png, jpeg, pdf *</span>
								</label>
								<input class="form-control" name="spt" type="file" id="spt" required>
							</div>



						</div>

					</div>
					<div class="modal-footer">

						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
						<button type="submit" id="button_simpan" class="btn btn-primary btnSimpan" data-bs-dismiss="modal">Simpan</button>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>




		<!-- Modal qrcode kasubag2 -->
		<div class="modal fade" id="qrcode_kasubag2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">QR Code Preview</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<img src="<?= base_url('uploads/qrcode/' . $qrcode_kasubag) ?>" class="img-fluid" alt="QrCode">

						<div class="d-flex justify-content-center">
							<h6><?= $nama_kasubag; ?></h6>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailPendapat">Kembali</button>
						<a href="<?php echo base_url('admin/pendapat/downloadQrcode/' . $qrcode_kasubag) ?>" class="btn btn-icon btn-2 btn-primary" role="button">
							<span class="btn-inner--icon"><i class="fas fa-download"></i></span>
						</a>

					</div>
				</div>
			</div>
		</div>



		<!-- Modal qrcode kabag2 -->
		<div class="modal fade" id="qrcode_kabag2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">QR Code Preview</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<img src="<?= base_url('uploads/qrcode/' . $qrcode_kabag) ?>" class="img-fluid" alt="QrCode">
						<div class="d-flex justify-content-center">
							<h6><?= $nama_kabag; ?></h6>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailPendapat">Kembali</button>
						<a href="<?php echo base_url('admin/pendapat/downloadQrcode/' . $qrcode_kabag) ?>" class="btn btn-icon btn-2 btn-primary" role="button">
							<span class="btn-inner--icon"><i class="fas fa-download"></i></span>
						</a>

					</div>
				</div>
			</div>
		</div>



		<!-- Modal qrcode kacab2 -->
		<div class="modal fade" id="qrcode_kacab2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">QR Code Preview</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<img src="<?= base_url('uploads/qrcode/' . $qrcode_kacab) ?>" class="img-fluid" alt="QrCode">

						<div class="d-flex justify-content-center">
							<h6><?= $nama_kacab; ?></h6>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailPendapat">Kembali</button>
						<a href="<?php echo base_url('admin/pendapat/downloadQrcode/' . $qrcode_kacab) ?>" class="btn btn-icon btn-2 btn-primary" role="button">
							<span class="btn-inner--icon"><i class="fas fa-download"></i></span>
						</a>

					</div>
				</div>
			</div>
		</div>


		<!-- Modal Alert-->
		<div class="modal fade" id="alertDialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Pemberitahuan</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="div center d-flex align-items-center justify-content-center">
						<lottie-player src="https://assets9.lottiefiles.com/packages/lf20_p7ki6kij.json" background="transparent" speed="1" style="width: 130px; height: 130px;" loop autoplay></lottie-player>
					</div>

					<div class="modal-body center d-flex align-items-center justify-content-center">


						<div class="div">
							Silahkan lengkapi data-data pendukung anda terlebih dahulu sebelum mengakses fitur ini.
						</div>


					</div>
					<div class="modal-footer">

						<button class="btn btn-primary" data-bs-target="#entryData" data-bs-toggle="modal" data-bs-dismiss="modal">Lanjutkan</button>
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



	<!-- Script button detail -->
	<script>
		$(document).ready(function() {
			$('.btnDetail').on('click', function() {
				const proposal_id = $(this).data('proposal_id');
				const no_urut_proposal = $(this).data('no_urut_proposal');
				const nama_petugas_survey = $(this).data('nama_petugas_survey');
				const jabatan = $(this).data('jabatan');
				const kelayakan = $(this).data('kelayakan');
				const bentuk_bantuan = $(this).data('bentuk_bantuan');
				const nilai_pengajuan = $(this).data('nilai_pengajuan');
				const barang_yang_diajukan = $(this).data('barang_diajukan');
				const pendapat_kasubag = $(this).data('pendapat_kasubag');
				const nilai_kasubag = $(this).data('nilai_kasubag');
				const pendapat_kabag = $(this).data('pendapat_kabag');
				const nilai_kabag = $(this).data('nilai_kabag');
				const pendapat_kacab = $(this).data('pendapat_kacab');
				const tanggapan_kacab = $(this).data('tanggapan_kacab');
				const nilai_kacab = $(this).data('nilai_kacab');



				if (tanggapan_kacab == 'Ditolak') {
					$('#animDiterima').attr('hidden', true);
					$('#txtDiterima').attr('hidden', true);
					$('#animDitolak').attr('hidden', false);
					$('#txtDitolak').attr('hidden', false);

				} else if (tanggapan_kacab == 'Diterima') {
					$('#animDitolak').attr('hidden', true);
					$('#txtDitolak').attr('hidden', true);
					$('#animDiterima').attr('hidden', false);
					$('#txtDiterima').attr('hidden', false);
				} else {
					$('#animDitolak').attr('hidden', true);
					$('#txtDitolak').attr('hidden', true);
					$('#animDiterima').attr('hidden', true);
					$('#txtDiterima').attr('hidden', true);
				}




				$('.proposal_id').val(proposal_id);
				$('.no_urut_proposal').val(no_urut_proposal);
				$('.nama_petugas_survey').val(nama_petugas_survey);
				$('.jabatan').val(jabatan);
				$('.kelayakan').val(kelayakan);
				$('.bentuk_bantuan').val(bentuk_bantuan);
				$('.nilai_pengajuan').val(nilai_pengajuan);
				$('.barang_yang_diajukan').val(barang_yang_diajukan);
				$('.pendapat_kasubag2').val(pendapat_kasubag);
				$('.nilai_pengajuan_kasubag2').val(nilai_kasubag);
				$('.pendapat_kabag_admin2').val(pendapat_kabag);
				$('.nilai_pengajuan_kabag_admin2').val(nilai_kabag);
				$('.pendapat_kacab2').val(pendapat_kacab);
				$('.tanggapan2').val(tanggapan_kacab);
				$('.nilai_pengajuan_kacab2').val(nilai_kacab);


				$('.pendapat_kasubag2').attr('readonly', true);
				$('.nilai_pengajuan_kasubag2').attr('readonly', true);
				$('.pendapat_kabag_admin2').attr('readonly', true);
				$('.nilai_pengajuan_kabag_admin2').attr('readonly', true);
				$('.pendapat_kacab2').attr('readonly', true);
				$('.nilai_pengajuan_kacab2').attr('readonly', true);
				$('.tanggapan2').attr('disabled', true);


			});



		});
	</script>

	<!-- If qrcode kasubag is clicked -->
	<script>
		$(document).ready(function() {
			$('.qrcode_kasubag').on('click', function() {
				$('#qrcode_kasubag').modal('show');
				$('#editHasilSurvey').modal('hide');
			});

		});
	</script>

	<!-- If qrcode kasubag2 is clicked -->
	<script>
		$(document).ready(function() {
			$('.qrcode_kasubag2').on('click', function() {
				$('#qrcode_kasubag2').modal('show');
				$('#detailPendapat').modal('hide');
			});

		});
	</script>

	<!-- Script button detail -->
	<script>
		$(document).ready(function() {
			$('#btnPilih').on('click', function() {
				const proposal_id = $(this).data('proposal_id');
				const no_urut_proposal = $(this).data('no_urut_proposal');

				$('.proposal_id').val(proposal_id);
				$('.no_urut_proposal').val(no_urut_proposal);


			});



		});
	</script>

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




	<!-- If qrcode kabag2 is clicked -->
	<script>
		$(document).ready(function() {
			$('.qrcode_kabag2').on('click', function() {
				$('#qrcode_kabag2').modal('show');
				$('#detailPendapat').modal('hide');
			});

		});
	</script>

	<!-- If qrcode kacab2 is clicked -->
	<script>
		$(document).ready(function() {
			$('.qrcode_kacab2').on('click', function() {
				$('#qrcode_kacab2').modal('show');
				$('#detailPendapat').modal('hide');
			});

		});
	</script>






</body>

</html>
