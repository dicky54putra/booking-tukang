<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary" style="margin-top: -2rem;">
    <div class="container-fluid">
        <div class="page-header-content">
            <h1 class="page-header-title">
                <div class="page-header-icon"><i data-feather="file"></i></div>
                <span><?= $title ?></span>
            </h1>
            <ol class="breadcrumb mt-4 mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url() . __ADMIN ?>">Dashboard</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-top: -8rem;">
    <div class="card">
        <div class="card-body">
            <a href="<?= base_url(__ADMIN . 'tukang/create') ?>" class="btn btn-primary btn-sm mb-3">
                <i class="fa fa-plus"></i>&nbsp;Tambah
            </a>
            <?= $this->session->flashdata('message'); ?>
            <div class="datatable table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>jenis kelamin</th>
                            <th>no HP</th>
                            <th>fee /day</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data as $key => $val) {
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $val->nama ?></td>
                                <td><?= ($val->jk == 1) ? 'Laki-Laki' : 'Perempuan';  ?></td>
                                <td><?= $val->no_hp ?></td>
                                <td><?= rp($val->fee_per_day) ?></td>
                                <td>
                                    <a href="<?= base_url(__ADMIN . 'tukang/update/') . $val->id_tukang ?>" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fa fa-edit"></i></a>
                                    <a href="<?= base_url(__ADMIN . 'tukang/delete/') . $val->id_tukang ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>