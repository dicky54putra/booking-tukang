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
            <?= $this->session->flashdata('message'); ?>
            <div class="datatable table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Fee</th>
                            <th>Lokasi</th>
                            <th>Tukang</th>
                            <th>Pemesan</th>
                            <!-- <th>Skor</th> -->
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
                                <td><?= tanggal_indo($val->tanggal_awal) ?></td>
                                <td><?= tanggal_indo($val->tanggal_akhir) ?></td>
                                <td><?= rp($val->fee) ?></td>
                                <td><?= $val->lokasi ?></td>
                                <td><?= $val->nama_tukang ?></td>
                                <td><?= $val->nama_pemesan ?></td>
                                <!-- <td><?= $val->skor ?></td> -->
                                <td>
                                    <?php
                                        if ($val->status == 1) {
                                            $color = '#ffc107';
                                            echo 'Order';
                                        } else if ($val->status == 2) {
                                            $color = '#0d6efd';
                                            echo 'On Progress';
                                        } else if ($val->status == 3) {
                                            $color = '#198754';
                                            echo 'Lunas';
                                        } else {
                                            echo "Canceled";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">

                                        <?php if ($val->status == 3) { ?>
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Update Status
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <!-- <a class="dropdown-item" href="<?php// base_url(__ADMIN . 'proyek/update_selesai/') . $val->id_proyek ?>">Selesai</a> -->
                                            <a class="dropdown-item" href="<?= base_url(__ADMIN . 'proyek/update_proses/') . $val->id_proyek ?>">On Progress</a>
                                            <a class="dropdown-item" href="<?= base_url(__ADMIN . 'proyek/update_canceled/') . $val->id_proyek ?>">Canceled</a>
                                        </div>
                                        <?php } else { ?>
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Update Status
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <!-- <a class="dropdown-item" href="<?php// base_url(__ADMIN . 'proyek/update_selesai/') . $val->id_proyek ?>">Selesai</a> -->
                                            <a class="dropdown-item" href="<?= base_url(__ADMIN . 'proyek/update_proses/') . $val->id_proyek ?>">On Progress</a>
                                            <a class="dropdown-item" href="<?= base_url(__ADMIN . 'proyek/update_canceled/') . $val->id_proyek ?>">Canceled</a>
                                        </div>
                                        <a class="btn btn-danger" href="<?= base_url(__ADMIN . 'proyek/update_selesai/') . $val->id_proyek ?>">Bayar <i class="fas fa-hand-holding-usd"></i></a>
                                        <?php } ?>
                                        
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>