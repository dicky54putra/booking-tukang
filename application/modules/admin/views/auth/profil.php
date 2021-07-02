<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary" style="margin-top: -2rem;">
    <div class="container-fluid">
        <div class="page-header-content">
            <h1 class="page-header-title">
                <div class="page-header-icon"><i data-feather="file"></i></div>
                <span><?= $title ?></span>
            </h1>
            <ol class="breadcrumb mt-4 mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url(__ADMIN) ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-top: -8rem;">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <?php
                    if ($data->role != 1) {
                        $disabled = 'disabled';
                    } else {
                        $disabled = '';
                    }
                    ?>
                    <form method="POST" action="<?= base_url(__ADMIN . "profil/$data->id_user") ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input class="form-control form-control-solid" id="nama" name="nama" type="text" value="<?= (!empty($data->nama)) ? $data->nama : set_value('nama') ?>" <?= $disabled ?>>
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control form-control-solid" id="username" name="username" type="text" value="<?= (!empty($data->username)) ? $data->username : set_value('username') ?>" <?= $disabled ?>>
                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input class="form-control form-control-solid" id="foto" name="foto" type="file">
                            <?= form_error('foto', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <?= $this->session->flashdata('message_change_password'); ?>
                    <form method="POST" action="<?= base_url(__ADMIN . "change_password/$data->id_user") ?>">
                        <div class="form-group">
                            <label for="password_old">Password Lama</label>
                            <input class="form-control form-control-solid" id="password_old" name="password_old" type="password">
                            <?= form_error('password_old', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control form-control-solid" id="password" name="password" type="password">
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password_repeat">Password Repeat</label>
                            <input class="form-control form-control-solid" id="password_repeat" name="password_repeat" type="password">
                            <?= form_error('password_repeat', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>