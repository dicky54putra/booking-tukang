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
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <a href="<?= base_url(__ADMIN . 'menu_navigasi/create') ?>" class="btn btn-primary btn-sm mb-3">
                        <i class="fa fa-plus"></i>&nbsp;Tambah
                    </a>
                </div>
                <div class="col-sm-4">
                    <form id="form_search" action="" method="get">
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-search"></i></div>
                            </div>
                            <input type="text" class="form-control" name="q" value="<?= ($_GET['q']) ?? "" ?>" id="search" autocomplete="false" placeholder="Search.....">
                        </div>
                    </form>
                </div>
            </div>
            <?= $this->session->flashdata('message'); ?>
            <div class="datatable table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
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
                        foreach ($data as $key => $val) {
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
                                <td><?= ($val->status == 1) ? '<a href="' . base_url(__ADMIN . 'menu_navigasi/status/' . $val->id_menu_navigasi) . '" class="badge badge-success">Aktif</a>' : '<a href="' . base_url(__ADMIN . 'menu_navigasi/status/' . $val->id_menu_navigasi) . '"class="badge badge-warning">Tidak Aktif</a>'; ?></td>
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
</div>