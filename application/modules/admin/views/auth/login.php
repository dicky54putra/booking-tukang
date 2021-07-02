<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header justify-content-center">
                    <h3 class="font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <form action="<?= base_url(__ADMIN . 'login') ?>" method="post">
                        <input name="url" type="hidden" value="<?= (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : base_url(__ADMIN . 'index') ?>" />
                        <div class="form-group">
                            <label class="small mb-1" for="username">Username</label>
                            <input name="username" class="form-control py-4" id="username" type="text" placeholder="Enter username" />
                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="Password">Password</label>
                            <input name="password" class="form-control py-4" id="Password" type="password" placeholder="Enter password" />
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group mt-4 mb-0">
                            <button type="submit" class="btn btn-primary form-control">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>