<?php $this->load->view('pages/vote/Header'); ?>
<?php $this->load->view('pages/vote/VoteStepper'); ?>

<div style="margin-left: 24px; margin-right: 24px;">
    <div class="card mb-3 mt-3 pt-2">
        <h4 class="card-title text-center">Panduan E-Voting</h4>
        <div class="row no-gutters">
            <div class="col-md-5 col-12">
                <img style="max-width: 360px; max-height: 360px;" class="card-img rounded mx-auto d-block" src="<?= base_url('assets/images/step.png') ?>" alt="Image Guide">
            </div>
            <div class="col-md-7 col-12">
                <div class="card-body">
                    <p class="card-text">1. Silahkan pilih calon pasangan Presiden dan Wakil Presiden BEM dengan bijak!</p>
                    <p class="card-text">2. E-Voting dapat dilakukan dengan 5 step mudah</p>
                    <p class="card-text">3. Siapkan KTM untuk di foto nantinya</p>
                    <p class="card-text">4. Jika bingung langsung tanyakan ke operator kami</p>
                    <p class="card-text">5. Jika akun milikmu sudah terpakai oleh orang lain segera hubungi Tim Operator</p>
                    <p class="card-text"><b>6. Ikuti aturan yang berlaku dan jangan merugikan orang lain!</b></p>
                    <form class="d-inline" action="<?= base_url('voter/vote'); ?>" method="post">
                        <input type="text" name="guided" value="true" hidden>
                        <button class="btn btn-primary px-4 py-2">Selanjutnya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('pages/vote/Footer'); ?>