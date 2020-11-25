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
        transform: scale(1.075);
        border: 3px solid rgba(100, 100, 200, .5);
        z-index: 90;
    }
</style>

<div style="margin-left: 5%; margin-right: 5%;">
    <h4 class="card-title text-center mb-5">Pilihlah Salah Satu Calon</h4>

    <div class="row" id="row">
        <?php
        for ($i = 0; $i < 4; $i++) {
        ?>
            <div class="px-3 py-3 col-xl-3 col-md-4 col-sm-6 col-12">
                <div class="card pointer scale" onclick="onHello(this, <?= $i; ?>)">
                    <img src="https://picsum.photos/id/237/200/200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title # <?= $i; ?></h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
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