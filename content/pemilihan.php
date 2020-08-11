<!DOCTYPE html>
<?php
  include_once "cek-pemilih.php";
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>eVoting | Pemilihan</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="../build/css/custom.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 float-sm-center">
            <h1 class="text-center"> Selamat Datang <strong><?php echo $_SESSION['nama']; ?></strong>!</h1>
            <h4 class="text-center"> Silahkan pilih calon pasangan dengan bijak</h4>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
            <div class="card-body">
            <div class="row">
              <?php
                include_once "../api/read-calon.php";
                foreach ($data['records'] as $calon){
              ?>    
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch container2">
                      <div class="card bg-light ">
                        <a class="swal" href="#" onClick="reply_click(this.id)" id="<?php echo($calon['nomor_urut']);?>">
                          <div class="card-header text-muted border-bottom-0 text-center">
                            <h2><?php echo($calon['nomor_urut']);?></h2>
                            <h1><?php echo($calon['nama1']." - ".$calon['nama2']);?></h1>
                          </div>
                          <div class="card-body pt-0">
                            <div class="row">
                              <!-- <div class="col-7">
                                <h1 class="lead"><b>Visi Misi: </b> <?php echo($calon['visi_misi']);?></h1>
                              </div> -->
                              <div class="col-12 text-center ">
                                <img src="http://localhost:8081/eVoting/build/img/upload/<?php echo($calon['foto']); ?>" alt="" class="img-circle img-fluid image">
                              </div>
                            </div>
                          </div>
                          <div class="middle">
                            <div class="pilih">Pilih</div>
                          </div>
                        </a>
                      </div>
                    </div>
                  
              <?php
                }
              ?>
            </div>
                </div>
          

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
function reply_click(clicked_id) {
    var norut = clicked_id;
    const Toast = Swal.mixin({
      toast: true,
      position: 'center',
      showConfirmButton: true,
    });
    $('.swal').click(function() {
          Swal.fire({
          icon: 'question',
          title: 'Yakin memilih nomor '+ norut+' ini?',
          confirmButtonText: 'Ya, saya yakin!'
        }).then((result) => {
              if (result.value == true) {
                window.location = "proses-pilih.php?nomor="+norut;
              }
            })
      });
  };

</script>
</body>
</html>