<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Pemilihan Online</title>
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Masuk Sebagai Pemilih</b></a>
    </div>

    <?php
    if (isset($_GET['pesan'])) {
      if ($_GET['pesan'] == "gagal") {
        echo "<div class='alert alert-danger'>Login gagal! Username dan password salah.</div>";
      } else if ($_GET['pesan'] == 'hapus') {
        echo "<div class='alert alert-danger'>Login gagal! Akun anda sepertinya tidak ada.</div>";
      } else if ($_GET['pesan'] == "logout") {
        echo "<div class='alert alert-danger'>Anda telah logout.</div>";
      } else if ($_GET['pesan'] == "salah") {
        echo "<div class='alert alert-danger'>Anda tidak punya hak.</div>";
      } else if ($_GET['pesan'] == "sudahmemilih") {
        echo "<div class='alert alert-danger'>Maaf anda tidak dapat login karena telah memilih.</div>";
      } else if ($_GET['pesan'] == "belumabsen") {
        echo "<div class='alert alert-danger'>Maaf anda tidak dapat login. Silahkan aktivasi terlebih dahulu.</div>";
      } else if ($_GET['pesan'] == "terimakasih") {
        echo "<div class='alert alert-success'>Terimakasih telah menggunakan hak pilih.</div>";
      } else {
        echo "<div class='alert alert-danger'>Silahkan login dulu.</div>";
      }
    }
    ?>

    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Masukan NIM dan Password</p>

        <?= form_open(base_url('Welcome/aksi_login')); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Input NIM" name="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <!-- <input type="hidden" name="<?//= $this->security->get_csrf_token_name(); ?>" value="<?//= $this->security->get_csrf_hash(); ?>"> -->
        </div>
        <div class="row">
          <div class="col">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
        </div>
        <?= form_close(); ?>

      </div><!-- /.login-card-body -->
    </div><!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>

</body>

</html>