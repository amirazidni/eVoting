<?php $this->load->view('pages/vote/Header'); ?>
<?php $this->load->view('pages/vote/VoteStepper'); ?>

<style>
    .scale {
        transition: 0.2s;
    }

    .hidden {
        display: none;
    }

    .scale:hover {
        transform: scale(1.1);
        border: 3px solid rgba(100, 100, 200, .75);
        z-index: 100;
    }

    .selected {
        transform: scale(1.05);
        border: 3px solid rgba(100, 100, 200, .5);
        z-index: 90;
    }

    .full-width {
        width: 100%;
    }

    pre {
        white-space: pre-wrap;
        /* css-3 */
        white-space: -moz-pre-wrap;
        /* Mozilla, since 1999 */
        white-space: -pre-wrap;
        /* Opera 4-6 */
        white-space: -o-pre-wrap;
        /* Opera 7 */
        word-wrap: break-word;
        /* Internet Explorer 5.5+ */
    }
</style>

<div style="margin-left: 7.5%; margin-right: 7.5%;">
    <h4 class="card-title text-center mb-5">Pilihlah Salah Satu Calon</h4>

    <div class="row" id="row">
        <?php
        foreach ($candidates as $key => $item) {
        ?>

            <!-- Candidate -->
            <div class="px-3 py-3 col-xl-3 col-md-6 col-sm-6 col-12">
                <div class="card pointer scale" onclick="onHello(this, <?= $key; ?>)">
                    <img src="<?= base_url('upload/' . $item['foto']); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= '#' . $item['nomorurut'] . ' ' . $item['nama1'] . ' - ' . $item['nama2']; ?></h5>
                        <button class="float-right btn btn-primary" data-toggle="modal" data-target="<?= "#modal-candidate-$key"; ?>">VISI & MISI</button>
                    </div>
                    <form class="mx-2 hidden choose" action="<?= base_url('voter/vote'); ?>" method="post">
                        <input name="voteId" value="<?= $item['id']; ?>" type="text" hidden>
                        <button class="btn full-width btn-success">Pilih</button>
                    </form>
                </div>
            </div>

            <!-- Modal for Candidate -->
            <div class="modal fade" id="<?= "modal-candidate-$key"; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><?= 'Paslon ' . ' ' . $item['nama1'] . ' - ' . $item['nama2']; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <h6>VISI</h6>
                                <pre class="ml-3"><?= $item['visi']; ?></pre>
                            </div>
                            <div>
                                <h6>MISI</h6>
                                <pre class="ml-3"><?= $item['misi']; ?></pre>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
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

        cards.children('.choose').addClass('hidden')
        e.querySelector('.choose').classList.remove('hidden')
    }
</script>


<?php $this->load->view('pages/vote/Footer'); ?>