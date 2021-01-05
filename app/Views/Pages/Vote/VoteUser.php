<?php $this->load->view('pages/vote/Header'); ?>
<?php $this->load->view('pages/vote/VoteStepper'); ?>

<?php

if ($error) {
?>

    <div class="alert alert-danger" style="margin-left: 10%; margin-right: 10%" role="alert">
        <h4 class="alert-heading">Error!</h4>
        <p class="mt-3"><?= $error; ?></p>
        <hr>
        <p class="mb-0">Untuk mengubungi operator, tekan button yang ada di bawah sebelah kanan layar.</p>
    </div>

<?php
}

?>

<div class="card mx-auto mb-3 mt-3 pt-2 pb-4" style="max-width: 480px;">
    <h4 class="card-title text-center">Masukan User dan Password</h4>
    <div class="row no-gutters">
        <div class="col-12">
            <div style="max-width: 360px; max-height: 360px;" class="card-img rounded mx-auto d-block">
            </div>
        </div>
        <div class="col-12">
            <div class="card-body">
                <form action="<?= base_url('voter/vote'); ?>" method="post" id="form">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" name="nim" id="nim" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">No. WA</label>
                        <input type="tel" class="form-control" name="phone" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div>
                        <button class="btn btn-primary px-4 py-2" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('pages/vote/Footer'); ?>