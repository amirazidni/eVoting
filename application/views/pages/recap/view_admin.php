<?php
  $this->load->view('pages/recap/header');
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">

				<!-- /.card-header -->
				<div class="card-body table-responsive">
					<table id="tbl_admin" class="w-100 table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Ip Address</th>
								<th>NIM</th>
								<th>Nama Pemilih</th>
								<th>Kelas</th>
								<th>ID Suara</th>
								<th>Activasi</th>
								<th>No. Telp</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container-fluid -->
<?php
  $this->load->view('pages/recap/footer');
?>
