<div class="container mt-5">
    <div class="row mt-3">
        <div class="col-12">
            <form action="<?= base_url('search') ?>" method="get">
                <input type="text" class="form-control mb-3" id="search" placeholder="Cari Tukang" name="q" value="<?= (!empty($_GET['q'])) ? $_GET['q'] : '' ?>">
            </form>
        </div>
    </div>
    <div class="row">
        <?php foreach ($tukangs as $tukang) { ?>
            <div class="col-6 col-md-4 col-lg-3 mb-2">
                <div class="card">
                    <figure class="d-flex align-items-center justify-content-center">
                        <img src="<?= base_url('upload/user/' . get_foto($tukang->foto)) ?>" class="img-cover" alt="" srcset="" width="100">
                    </figure>
                    <a href="<?= base_url('search/' . $tukang->id_tukang) ?>" class="h4 stretched-link"><?= $tukang->nama ?></a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
