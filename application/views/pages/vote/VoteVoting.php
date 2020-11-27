<style>
    .scale {
        transition: 0.2s;
    }

    .scale:hover {
        transform: scale(1.1);
        border: 3px solid rgba(100, 100, 200, .75);
        z-index: 100;
    }

    .selected {
        transform: scale(1.09);
        border: 3px solid rgba(100, 100, 200, .5);
        z-index: 90;
    }
</style>

<div style="margin-left: 5%; margin-right: 5%;">
    <h4 class="card-title text-center mb-5">Pilihlah Salah Satu Calon</h4>

    <div class="row" id="row">
        <?php
        foreach ($candidates as $key => $item) {
        ?>
            <div class="px-3 py-3 col-xl-3 col-md-4 col-sm-6 col-12">
                <div class="card pointer scale" onclick="onHello(this, <?= $key; ?>)">
                    <img src="<?= base_url('upload/' . $item['foto']); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= '#' . $item['nomorurut'] . ' ' . $item['nama1'] . ' - ' . $item['nama2']; ?></h5>
                        <button class="float-right btn btn-primary">VISI & MISI</button>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<script>
    let cards = $('.card')

    function onHello(e, index) {
        cards.removeClass('selected')
        e.classList.add('selected')
    }
</script>