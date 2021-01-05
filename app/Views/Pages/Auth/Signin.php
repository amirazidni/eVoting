<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pemilihan Online</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/fa-all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pace.min.css') ?>">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Signin</b>
        </div>

        <?php if (isset($error)) { ?>
            <div class='alert alert-danger'><?= $error ?></div>
        <?php } ?>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masukan Username dan Password</p>

                <?= form_open(base_url('auth/signinAction')); ?>
                <div class="form-group">
                    <select class="form-control" id="role" name="role" required>
                        <option disabled selected value> -- Pilih Role -- </option>
                        <option value="admin">Admin</option>
                        <option value="operator">Operator</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
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
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
                <?= form_close(); ?>

            </div>
        </div>
    </div>
</body>

<script src="<?= base_url('assets/js/pace.min.js') ?>"></script>

</html>