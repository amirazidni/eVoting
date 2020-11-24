<style>
    .pointer:hover {
        cursor: pointer;
    }

    .scale {
        transition: 0.2s;
    }

    .scale:hover {
        transform: scale(1.1);
        border: 3px solid rgba(100, 100, 200, .75);
    }
</style>

<div style="margin-left: 5%; margin-right: 5%;">
    <h4 class="card-title text-center mb-5">Pilihlah Salah Satu Calon</h4>

    <div class="row">
        <?php
        for ($i = 0; $i < 4; $i++) {
        ?>
            <div class="px-3 py-2 col-xl-3 col-md-4 col-sm-6 col-12">
                <div class="card pointer scale">
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