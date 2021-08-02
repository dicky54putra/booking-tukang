<?php
$parent = $this->db->get_where('menu_navigasi', ['id_menu_navigasi' => $data->id_parent])->row();
?>
<div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary" style="margin-top: -2rem;">
    <div class="container-fluid">
        <div class="page-header-content">
            <h1 class="page-header-title">
                <div class="page-header-icon"><i data-feather="file"></i></div>
                <span><?= $title ?></span>
            </h1>
            <ol class="breadcrumb mt-4 mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url(__ADMIN) ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url(__ADMIN . 'menu_navigasi') ?>">Menu Navigasi</a></li>
                <?php if ($data->id_parent > 0) { ?>
                    <li class="breadcrumb-item"><a href="<?= base_url(__ADMIN . 'menu_navigasi/view/' . $data->id_parent) ?>"><?= $parent->nama ?></a></li>
                <?php } ?>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-top: -8rem;">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-striped table-inverse" width="100%">
                        <tbody>
                            <tr>
                                <td style="width: 50%;">Nama Menu</td>
                                <td><?= $data->nama ?></td>
                            </tr>
                            <tr>
                                <td>Url</td>
                                <td><a href="<?= base_url(__ADMIN . $data->url) ?>"><?= $data->url ?></a></td>
                            </tr>
                            <tr>
                                <td>Icon</td>
                                <td><?= $data->icon ?></td>
                            </tr>
                            <tr>
                                <td>Parent</td>
                                <td>
                                    <?php
                                    echo ($data->id_parent == 0) ? 'Root' : $parent->nama;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>No Urut</td>
                                <td><?= $data->no_urut ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <?= ($data->status == 1) ? '<a href="' . base_url(__ADMIN . 'menu_navigasi/status/' . $data->id_menu_navigasi . '/' . $func) . '" class="badge badge-success">Aktif</a>' : '<a href="' . base_url(__ADMIN . 'menu_navigasi/status/' . $data->id_menu_navigasi . '/' . $func) . '"class="badge badge-warning">Tidak Aktif</a>'; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <a href="<?= base_url(__ADMIN . 'menu_navigasi/create') ?>" class="btn btn-primary btn-sm mb-3">
                        <i class="fa fa-plus"></i>&nbsp;Tambah
                    </a>
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            Hak Akses
                        </div>
                        <div class="card-body">
                            <?php
                            $role = [
                                [
                                    'role' => 1,
                                    'nama' => 'Admin'
                                ],
                                // [
                                //     'role' => 2,
                                //     'nama' => 'Guru'
                                // ],
                                // [
                                //     'role' => 3,
                                //     'nama' => 'Siswa'
                                // ],
                            ];
                            ?>
                            <form action="<?= base_url(__ADMIN . 'menu_navigasi/role/' . $data->id_menu_navigasi) ?>" method="post">

                                <input class="form-control form-control-solid" id="id_menu_navigasi" name="id_menu_navigasi" type="hidden" value="<?= $data->id_menu_navigasi ?>">
                                <?php foreach ($role as $key => $val) : ?>
                                    <?php $tr = $this->db->where(['id_role' => $val['role']])->where(['id_menu_navigasi' => $data->id_menu_navigasi])->get('tr_menu_navigasi')->row(); ?>
                                    <div class="custom-control custom-checkbox custom-control-solid">
                                        <input class="custom-control-input" id="<?= $val['role'] ?>" type="checkbox" <?= (!empty($tr->id_role)) ? ($tr->id_role == $val['role']) ? 'checked' : '' : ''; ?> name="role[<?= $val['role'] ?>]" value="<?= $val['role'] ?>">
                                        <label class="custom-control-label" for="<?= $val['role'] ?>"><?= $val['nama'] ?></label>
                                    </div>
                                <?php endforeach; ?>
                                <div class="form-group">
                                    <button class="btn btn-primary mt-2" style="margin-bottom: -10px;" type="submit"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <?php
            if ($data->id_parent == 0) {
            ?>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-white">Sub Menu</h2>
                    </div>
                    <div class="card-body">
                        <div class="datatable table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Url</th>
                                        <th>Parent</th>
                                        <th>No Urut</th>
                                        <th>Icon</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    foreach ($data_loop as $key => $val) {
                                        $no++;
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $val->nama ?></td>
                                            <td><a href="<?= base_url(__ADMIN . $val->url) ?>"><?= $val->url ?></a></td>
                                            <td>
                                                <?php
                                                $parent = $this->db->get_where('menu_navigasi', ['id_menu_navigasi' => $val->id_parent])->row();
                                                echo ($val->id_parent == 0) ? 'Root' : $parent->nama;
                                                ?>
                                            </td>
                                            <td><?= $val->no_urut ?></td>
                                            <td><?= $val->icon ?></td>
                                            <td><?= ($val->status == 1) ? '<a href="' . base_url('menu_navigasi/status/' . $val->id_menu_navigasi) . '" class="badge badge-success">Aktif</a>' : '<a href="' . base_url(__ADMIN . 'menu_navigasi/status/' . $val->id_menu_navigasi) . '"class="badge badge-warning">Tidak Aktif</a>'; ?></td>
                                            <td>
                                                <a href="<?= base_url(__ADMIN . 'menu_navigasi/view/') . $val->id_menu_navigasi ?>" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fa fa-eye"></i></a>
                                                <a href="<?= base_url(__ADMIN . 'menu_navigasi/update/') . $val->id_menu_navigasi ?>" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fa fa-edit"></i></a>
                                                <a href="<?= base_url(__ADMIN . 'menu_navigasi/delete/') . $val->id_menu_navigasi ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>