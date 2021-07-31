<main>

    <section id="banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <figure class="d-flex align-items-center justify-content-center">
                        <img class="img-cover" src="<?= base_url('assets/img/banner.png') ?>" alt="" srcset="" width="100">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <div class="container justify-content-center">
        <div class="row">
            <?php foreach ($tukangs as $tukang) { ?>
                <?php
                $foto = empty($tukang->foto) ? '404.png' : $tukang->foto;
                ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card">
                        <figure class="d-flex align-items-center justify-content-center">
                            <img src="<?= base_url('upload/user/' . get_foto($foto)) ?>" alt="" class="img-cover" srcset="" width="100">
                        </figure>
                        <a href="<?= base_url('home/' . $tukang->id_tukang) ?>" class="h4 stretched-link"><?= $tukang->nama ?></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>