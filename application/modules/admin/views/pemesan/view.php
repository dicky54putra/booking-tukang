<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary" style="margin-top: -2rem;">
    <div class="container-fluid">
        <div class="page-header-content">
            <h1 class="page-header-title">
                <div class="page-header-icon"><i data-feather="file"></i></div>
                <span><?= $title ?></span>
            </h1>
            <ol class="breadcrumb mt-4 mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url(__ADMIN) ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url(__ADMIN . 'pemesan') ?>">Pemesan</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-top: -8rem;">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-inverse" width="100%">
                        <tbody>
                            <tr>
                                <td style="width: 50%;">Nama Menu</td>
                                <td><?= $data->nama ?></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td><?= $user->username ?? '' ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td><?= ($data->jk == 1) ? 'Laki-laki' : 'Perempuan' ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><?= $data->alamat ?></td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>
                                    <?= $data->no_hp ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?= $data->email ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>