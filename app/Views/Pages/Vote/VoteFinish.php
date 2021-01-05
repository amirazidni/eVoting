<?php $this->load->view('pages/vote/Header'); ?>

<div class="px-5">
    <div class="card mx-auto mt-5 px-2 pt-3 pb-5">
        <h3 class="card-title text-center mb-5">Voting Selesai</h3>
        <div class="row no-gutters">
            <div class="col-md-5 col-12">
                <img style="max-width: 360px; max-height: 360px;" class="card-img rounded mx-auto d-block" src="<?= base_url('assets/images/finish.svg') ?>" alt="Image Guide">
            </div>
            <div class="col-md-7 col-12">
                <div class="card-body">
                    <p class="card-text">Kamu sudah melakukan voting pada waktu <?= $device['createdAt']; ?> dan berakhir pada <?= $device['updatedAt']; ?></p>
                    <p class="card-text">Dan jika itu bukan anda WA Operator kami untuk melakukan verifikasi!.</p>
                    <button onclick="callOperator()" class="btn btn-primary">WA Operator</button>
                    <a href="<?= base_url('voter/newVote'); ?>" class="btn btn-warning mt-2">Lakukan Voting Lain</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function callOperator() {
        window.open('<?= base_url('voter/comitteeMessage'); ?>', '_blank')
    }
</script>

</body>

</html>