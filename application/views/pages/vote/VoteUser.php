<div class="card mx-auto mb-3 mt-3 pt-2 pb-4" style="max-width: 480px;">
    <h4 class="card-title text-center">Masukan User dan Password</h4>
    <div class="row no-gutters">
        <div class="col-12">
            <div style="max-width: 360px; max-height: 360px;" class="card-img rounded mx-auto d-block">
            </div>
        </div>
        <div class="col-12">
            <div class="card-body">
                <form action="<?= base_url('voter/vote/3'); ?>" method="post" id="form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="phone">No. WA</label>
                        <input type="tel" class="form-control" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <div>
                        <button class="btn btn-primary px-4 py-2" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>