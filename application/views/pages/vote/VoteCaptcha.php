<?php $this->load->view('pages/vote/Header'); ?>
<?php $this->load->view('pages/vote/VoteStepper'); ?>

<div style="margin-left: 24px; margin-right: 24px;">
    <div class="card mb-3 mt-3 pt-2 pb-4">
        <h4 class="card-title text-center">Masukan Captcha</h4>
        <div class="row no-gutters">
            <div class="col-12">
                <div style="max-width: 360px; max-height: 360px;" class="card-img rounded mx-auto d-block">
                    <?= $captcha['image']; ?>
                </div>
            </div>
            <div class="col-12">
                <div class="card-body">
                    <form action="<?= base_url('voter/vote'); ?>" method="post" id="form">
                        <div class="mx-auto form-group" style="width: 320px;">
                            <input class="form-control" name="captcha" required>
                        </div>
                        <?php
                        if ($error) {
                        ?>
                            <div class="alert alert-danger mx-auto" role="alert" style="width: 320px;">
                                <?= $error; ?>
                            </div>
                        <?php
                        }
                        ?>
                        <div style="text-align: center;">
                            <button class="btn btn-primary px-4 py-2" type="submit">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('pages/vote/Footer'); ?>