<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PEMIRA 2020</title>
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/modif.css">
</head>

<body class="hold-transition" id="formpemilihan">
	<div class="content">
		<div class="card">
			<div class="card-body login-card-body">
				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card card-danger">
									<div class="card-header">
										<div class="row">
											<div class="col text-center">
												<H3>Selamat Datang <?php echo $this->session->userdata('nama'); ?>!
												</H3>Silahkan pilih calon pasangan Presiden dan Wakil Presiden BEM dengan
												bijak
											</div>
										</div>
									</div>
									<div class="content">
										<div class="card">
											<div class="card-body login-card-body">

												<div class="row">
													<?php $no = 1;
													foreach ($data->result_array() as $i) :
														$id = $i['id'];
														$visi = $i['visi'];
														$misi = $i['misi'];
														$nama1 = $i['nama1'];
														$nama2 = $i['nama2'];
														$foto = $i['foto'];
														$vote = $i['vote'];
													?>
														<div class="col-md-4">
															<aside class="profile-nav alt">
																<section class="card">
																	<form action="<?php echo base_url('index.php/form/pilih/' . $id . ''); ?>">
																		<div class="card-header bg-gray">
																			<div class="media">
																				<h1 class="text-light display-6">
																					<?php echo $no . '. ' . $nama1; ?> &</h1>
																				&nbsp
																				<h1 class="text-light display-6">
																					<?php echo $nama2; ?></h1>
																			</div>
																		</div>


																		<ul class="list-group list-group-flush">
																			<li class="list-group-item">
																				<center>
																					<h1>
																						<img class="align-self-center" style="width:240px; height:300px;" alt="" src="<?php echo base_url('upload/' . $foto) ?>">
																					</h1>
																				</center><br>
																				<div>
																					<a class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#pilih<?php echo $id; ?>" href="">Visi Misi</a>
																				</div>
																				</center>
																			</li>
																		</ul>
																	</form>
																</section>
															</aside>
														</div>
													<?php $no++;
													endforeach; ?>
												</div>
											</div>
										</div>

										<!--Modal VISIMISI-->
										<?php
										$no = 1;
										foreach ($data->result_array() as $i) :
											$id = $i['id'];
											$visi = $i['visi'];
											$misi = $i['misi'];
											$nama1 = $i['nama1'];
											$nama2 = $i['nama2'];
											$foto = $i['foto'];
											$vote = $i['vote'];  ?>

											<div class="modal fade" id="pilih<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="largemodalLabel" style="display: none;" aria-hidden="true">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<form>
															<div class="modal-body">

																<div class="card-header user-header alt bg-gray">
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">×</span>
																	</button>
																	<div class="media">
																		<h1 class="text-light display-6">
																			<?php echo $no . '. ' . $nama1; ?> &</h1>&nbsp
																		<h1 class="text-light display-6">
																			<?php echo $nama2; ?></h1>
																	</div>

																</div>


																<ul class="list-group list-group-flush">
																	<li class="list-group-item">

																		<div class="row">
																			<div class="col-4">
																				<img class="align-self-center" style="width:240px; height:300px;" alt="" src="<?php echo base_url('upload/' . $foto) ?>">
																			</div>
																			<div class="col">
																				</h1>
																				<div class="box">
																					<h3>Visi :</h3>
																					<hr>
																					<p><?php echo $visi; ?></p>
																				</div>
																				<hr>
																				<div class="box">
																					<h3>Misi :</h3>
																					<hr>
																					<p><?php echo $misi; ?></p>
																				</div>
																			</div>
																		</div>

																	</li>
																</ul>

															</div>

															<div class="modal-footer">
																<button type="button" id="btn-pilih" class="btn btn-primary btn-lg w-100" data-toggle="modal" data-target="#pilih-suara" data-id="<?= base_url("form/pilih/" . $id); ?>" data-nomor="<?= $no; ?>">
																	Pilih suara
																</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										<?php $no++;
										endforeach; ?>
									</div>
								</div>
							</div>

						</div>
						<!-- /.container-fluid -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->

			<div class="modal fade" id="pilih-suara" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>Apakah anda yakin ingin memilih nomor <label id="suara-nomor"></label></p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
							<button type="button" class="btn btn-primary" id="btn-suara">Iya</button>
						</div>
					</div>
				</div>
			</div>

			<!-- jQuery -->
			<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
			<!-- Bootstrap 4 -->
			<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
			<!-- AdminLTE App -->
			<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
			<script src="<?= base_url("assets/dist/js/custom.js"); ?>"></script>

</body>

</html>