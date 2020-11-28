<?php
  $this->load->view('pages/recap/header');
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">

				<!-- /.card-header -->
				<div class="card-body table-responsive">
					<table id="tbl_operator" class="w-100 table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>NIM</th>
								<th>Nama Pemilih</th>
								<th>Kelas</th>
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